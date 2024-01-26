<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstansiModel extends Model
{
    use HasFactory;

    protected $table = 'table_instansi';
    protected $primaryKey = 'id_instansi';

    protected $fillable = [
        'nama_instansi',
        'jenjang_instansi',
        'npsn',
        'alamat_instansi',
        'name_file',
        'file',
        'extension',
        'size',
    ];
}
