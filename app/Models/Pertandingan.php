<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 't_pertandingan';

    protected $fillable = [
        'id_club_1',
        'id_club_2',
        'skor_club_1',
        'skor_club_2',
    ];

    public function klub1()
    {
        return $this->belongsTo(Club::class, 'id_club_1');
    }

    public function klub2()
    {
        return $this->belongsTo(Club::class, 'id_club_2');
    }
}
