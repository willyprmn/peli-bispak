<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $guarded = 'id_pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;
}
