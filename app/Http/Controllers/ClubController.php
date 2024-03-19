<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use App\Http\Requests\CreateClubRequest;

class ClubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Club::all();
        return view('Club.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Club.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateClubRequest $request)
    {
        $validate = $request->validated();

        Club::create($request->all());

        return redirect('/club')->with('create', 'Berhasil Ditambahkan !');
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
        $edit = Club::findorFail($id);
        return view('Club.edit', [
            'edit' => $edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $update = Club::findOrFail($id);
        $update->update($request->all());

        return redirect('/club')->with('update', 'Berhasil Diupdate !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Club::findOrFail($id);
        $delete->delete();

        return redirect('/club')->with('deled', 'Data berhasil dihapus');
    }
}
