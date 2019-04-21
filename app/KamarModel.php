<?php

namespace Sitren;

use Illuminate\Database\Eloquent\Model;

class KamarModel extends Model
{
  protected $table = 'kamar';
  protected $primaryKey = 'id_kamar';
  public $timestamps = true;
  protected $fillable = [
    'nama_kamar','asrama'
  ];
}
