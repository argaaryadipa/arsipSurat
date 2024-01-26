<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratModel extends Model
{
    use HasFactory;

    protected $table = 'table_surat';
    protected $primaryKey = 'id_surat';

    protected $fillable = [
        'id_keterangan',
        'jenis_surat',
        'name_file',
        'file',
        'extension',
        'size',
        'perihal',
        'kode_surat',
    ];
    
}
