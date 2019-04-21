<?php

namespace Sitren;

use Illuminate\Database\Eloquent\Model;

class KelasModel extends Model
{
  protected $table = 'kelas';
  protected $primaryKey = 'id_kelas';
  public $timestamps = true;
  protected $fillable = [
    'nama_kelas','jenis'
  ];
}
