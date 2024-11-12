<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarif extends Model
{
    use HasFactory;

    protected $table = 'tarif';
    protected $guarded = 'id_tarif';
    protected $primaryKey = 'id_tarif';
    public $timestamps = false;
}
