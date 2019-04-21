<?php

namespace Sitren\Imports;
use Sitren\KamarModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsKamar implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(Array $row)
    {
      return new KamarModel([
         'nama_kamar'     => $row[0],
         'asrama'    => $row[1]
      ]);
    }
}
