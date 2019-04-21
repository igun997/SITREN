<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Apr 2019 11:21:29 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AssignKela
 *
 * @property int $id_aks
 * @property int $id_kelas
 * @property string $id_santri
 *
 * @property \Sitren\Kela $kela
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class AssignKelas extends Eloquent
{
	protected $primaryKey = 'id_aks';
	protected $table = 'assign_kelas';
	public $timestamps = false;

	protected $casts = [
		'id_kelas' => 'int'
	];

	protected $fillable = [
		'id_kelas',
		'id_santri'
	];

	public function kelas()
	{
		return $this->belongsTo(\Sitren\KelasModel::class, 'id_kelas');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\SantriModel::class, 'id_santri');
	}
}
