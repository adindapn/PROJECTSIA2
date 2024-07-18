<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $table = "jurnal";
    protected $fillable = ['no_jurnal','tgl_jurnal','no_akun','debit','kredit'];  
}
