<?php

namespace Sitren\Imports;
use Sitren\KelasModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsKelas implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(Array $row)
    {
      return new KelasModel([
         'nama_kelas'     => $row[0],
         'jenis'    => $row[1]
      ]);
    }
}
