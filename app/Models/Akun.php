<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    protected $primaryKey = 'no_akun';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "akun";
    protected $fillable=['no_akun','nm_akun'];
}
