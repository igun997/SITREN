<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
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
class AssignKela extends Eloquent
{
	protected $primaryKey = 'id_aks';
	public $timestamps = false;

	protected $casts = [
		'id_kelas' => 'int'
	];

	protected $fillable = [
		'id_kelas',
		'id_santri'
	];

	public function kela()
	{
		return $this->belongsTo(\Sitren\Kela::class, 'id_kelas');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\Santri::class, 'id_santri');
	}
}
