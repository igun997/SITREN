<?php

namespace Sitren\Imports;
use Sitren\PegawaiModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsPegawai implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(Array $row)
    {
      return new PegawaiModel([
        'nama_pegawai'     => $row[0],
        'jk'     => $row[1],
        'alamat'     => $row[2],
        'email'     => $row[3],
        'notelp'     => $row[4],
      ]);
    }
}
