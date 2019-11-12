<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Kela
 * 
 * @property int $id_kelas
 * @property string $nama_kelas
 * @property string $jenis
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $assign_kelas
 *
 * @package Sitren
 */
class Kela extends Eloquent
{
	protected $primaryKey = 'id_kelas';

	protected $fillable = [
		'nama_kelas',
		'jenis'
	];

	public function assign_kelas()
	{
		return $this->hasMany(\Sitren\AssignKela::class, 'id_kelas');
	}
}
