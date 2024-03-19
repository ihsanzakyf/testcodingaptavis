<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 't_club';
    protected $fillable = [
        'nama',
        'kota'
    ];

    public function pertandingan()
    {
        return $this->hasMany(Pertandingan::class, 'id_club_1')->orWhere('id_club_2', $this->id);
    }

    public function klasemen()
    {
        return $this->hasOne(Klasemen::class, 'id_club');
    }
}
