<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $table = 'tagihan';
    protected $guarded = 'id_tagihan';
    protected $primaryKey = 'id_tagihan';
    public $timestamps = false;
}
