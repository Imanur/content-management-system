<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_info',
        'isi_info',
        'status',

    ];
    public static $rules = [
        'judul_info'     => 'required',
        'isi_info'       => 'required',
        'status'         => 'required',
    ];
}
