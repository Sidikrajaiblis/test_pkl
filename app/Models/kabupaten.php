<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'm_kabupaten';
    protected $primaryKey = 'id_kabupaten';
    protected $fillable = ['nama_kabupaten'];
    public $incrementing = true;

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class, 'id_kabupaten');
    }
}
