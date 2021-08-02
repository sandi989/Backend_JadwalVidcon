<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class JadwalVidcon extends Model
{
    public $table = "jadwalvidcon";
    protected $fillable = [
        'kondisi', 'hari', 'tanggal', 'jenis_bantuan', 'lokasi', 'waktu', 'acara', 'penyelenggara', 'petugas', 'no_surat',
    ];

    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
