<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggunaan extends Model
{
    use HasFactory;

    protected $table = 'penggunaan';
    protected $guarded = 'id_penggunaan';
    protected $primaryKey = 'id_penggunaan';
    public $timestamps = false;
}
