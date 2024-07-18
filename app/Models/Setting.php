<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 'id_setting';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "setting";
    protected $fillable=['id_setting','no_akun','nama_transaksi'];
}