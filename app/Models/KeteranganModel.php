<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganModel extends Model
{
    use HasFactory;

    protected $table = 'table_keterangan';
    protected $primaryKey = 'id_keterangan';

    protected $fillable = [
        'keterangan',
        'kode_keterangan',
        
    ];

}
