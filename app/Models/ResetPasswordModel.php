<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordModel extends Model
{
    use HasFactory;

    protected $table = "reset_password";
    public $timestamps = false;

    protected $fillable = [
        'email',
        'verify_key',
        'created_at',
    ];
}
