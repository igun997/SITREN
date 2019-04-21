<?php

namespace Sitren\Imports;
use Sitren\KatinfraModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsKatinfra implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(Array $row)
    {
      return new KatinfraModel([
         'nama_katinfra'     => $row[0],
      ]);
    }
}
