<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasemen extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 't_klasemen';

    protected $fillable = [
        'id_club',
        'pertandingan_dimainkan',
        'pertandingan_menang',
        'pertandingan_seri',
        'pertandingan_kalah',
        'gol_memasukkan',
        'gol_kebobolan',
        'total_poin',
    ];

    public function klub()
    {
        return $this->belongsTo(Club::class, 'id_club');
    }
}
