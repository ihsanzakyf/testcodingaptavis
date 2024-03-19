<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Club;
use App\Models\Klasemen;
use App\Models\Pertandingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\CreatePertandinganRequest;
use App\Http\Requests\CreatePertandinganMultipleRequest;

class PertandinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedId = $request->input('klub1');
        $klubs = Club::whereNotIn('id', [$selectedId])->get();

        $data = Pertandingan::all();
        $club = Club::all();
        return view('Pertandingan.single', [
            'data' => $data,
            'club' => $club,
            'klubs' => $klubs,

        ]);
    }
    public function index_multiple(Request $request)
    {
        $selectedId = $request->input('klub1');
        $klubs = Club::whereNotIn('id', [$selectedId])->get();

        $data = Pertandingan::all();
        $club = Club::all();
        return view('Pertandingan.multiple', [
            'data' => $data,
            'club' => $club,
            'klubs' => $klubs,

        ]);
    }

    public function getAvailableClubs(Request $request)
    {
        $club1Id = $request->club1_id;
        $club2Options = Club::where('id', '!=', $club1Id)->pluck('nama', 'id');
        return response()->json($club2Options);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $club = Club::all();
        return view('Pertandingan.single', [
            'club' => $club
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePertandinganRequest $request)
    {
        // Validasi request
        $validated = $request->validated();

        // Memeriksa apakah pertandingan sudah ada sebelumnya
        $existingMatch = Pertandingan::where('id_club_1', $request->id_club_1)
            ->where('id_club_2', $request->id_club_2)
            ->orWhere(function ($query) use ($request) {
                $query->where('id_club_1', $request->id_club_2)
                    ->where('id_club_2', $request->id_club_1);
            })
            ->first();

        if ($existingMatch) {
            Session::flash('error', 'Pertandingan sudah ada sebelumnya.');
            return redirect('/pertandingan_single');
        }

        $pertandingan = Pertandingan::create([
            'id_club_1' => $request->id_club_1,
            'id_club_2' => $request->id_club_2,
            'skor_club_1' => $request->skor_club_1,
            'skor_club_2' => $request->skor_club_2,
        ]);

        // Memperbarui tabel klasemen
        $this->updateKlasemen($pertandingan);

        return redirect('/klasemen')->with('create', 'Berhasil Ditambahkan!');
    }

    private function updateKlasemen($pertandingan)
    {
        $pointKlub1 = 0;
        $pointKlub2 = 0;
        if ($pertandingan->skor_club_1 > $pertandingan->skor_club_2) {
            $pointKlub1 = 3;
        } elseif ($pertandingan->skor_club_1 < $pertandingan->skor_club_2) {
            $pointKlub2 = 3;
        } else {
            $pointKlub1 = 1;
            $pointKlub2 = 1;
        }

        $klub1 = Klasemen::where('id_club', $pertandingan->id_club_1)->first();
        if (!$klub1) {
            $klub1 = Klasemen::create(['id_club' => $pertandingan->id_club_1]);
        }
        $klub1->pertandingan_dimainkan += 1;
        $klub1->pertandingan_menang += ($pointKlub1 == 3) ? 1 : 0;
        $klub1->pertandingan_seri += ($pointKlub1 == 1) ? 1 : 0;
        $klub1->pertandingan_kalah += ($pointKlub1 == 0) ? 1 : 0;
        $klub1->gol_memasukkan += $pertandingan->skor_club_1;
        $klub1->gol_kebobolan += $pertandingan->skor_club_2;
        $klub1->total_poin += $pointKlub1;
        $klub1->save();

        $klub2 = Klasemen::where('id_club', $pertandingan->id_club_2)->first();
        if (!$klub2) {
            $klub2 = Klasemen::create(['id_club' => $pertandingan->id_club_2]);
        }
        $klub2->pertandingan_dimainkan += 1;
        $klub2->pertandingan_menang += ($pointKlub2 == 3) ? 1 : 0;
        $klub2->pertandingan_seri += ($pointKlub2 == 1) ? 1 : 0;
        $klub2->pertandingan_kalah += ($pointKlub2 == 0) ? 1 : 0;
        $klub2->gol_memasukkan += $pertandingan->skor_club_2;
        $klub2->gol_kebobolan += $pertandingan->skor_club_1;
        $klub2->total_poin += $pointKlub2;
        $klub2->save();
    }


    // Validasi request
    public function store_multiple(CreatePertandinganMultipleRequest $request)
    {
        // Validasi request
        $validated = $request->validated();

        foreach ($request->id_club_1 as $key => $value) {
            $existingMatch = Pertandingan::where(function ($query) use ($request, $key) {
                $query->where('id_club_1', $request->id_club_1[$key])
                    ->where('id_club_2', $request->id_club_2[$key]);
            })
                ->orWhere(function ($query) use ($request, $key) {
                    $query->where('id_club_1', $request->id_club_2[$key])
                        ->where('id_club_2', $request->id_club_1[$key]);
                })
                ->first();

            if ($existingMatch) {
                Session::flash('error', 'Pertandingan sudah ada sebelumnya.');
                return redirect('/pertandingan_single');
            }

            $pertandingan = Pertandingan::create([
                'id_club_1' => $request->id_club_1[$key],
                'id_club_2' => $request->id_club_2[$key],
                'skor_club_1' => $request->skor_club_1[$key],
                'skor_club_2' => $request->skor_club_2[$key],
            ]);

            // Panggil fungsi updateKlasemen di dalam loop
            $this->updateKlasemen($pertandingan);
        }

        // Redirect ke halaman klasemen
        return redirect('/klasemen')->with('create', 'Berhasil Ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
