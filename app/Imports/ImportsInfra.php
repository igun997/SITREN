<?php

namespace Sitren\Imports;
use Sitren\KatinfraModel;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportsInfra implements ToModel
{
    /**
    * @param Collection $collection
    */
    public function model(Array $row)
    {
      return new KatinfraModel([
         'nama_infra'     => $row[0],
      ]);
    }
}
