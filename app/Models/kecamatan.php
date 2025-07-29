<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'm_kecamatan';
    protected $primaryKey = 'id_kecamatan';
    protected $fillable = ['nama_kecamatan', 'id_kabupaten'];
    public $incrementing = true;

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class, 'id_kabupaten');
    }
}
