<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftar';
    protected $fillable = [
        'nomor_register',
        'nama_lengkap',
        'jenis_kelamin',
        'no_hp',
        'email'
    ];

    public function deleteData($id)
    {
        return static::find($id)->delete();
    }
}
