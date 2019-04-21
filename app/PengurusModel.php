<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 18 Apr 2019 02:59:32 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pengurus
 *
 * @property int $id_pengurus
 * @property int $id
 * @property int $id_pegawai
 * @property string $id_santri
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Sitren\User $user
 * @property \Sitren\Pegawai $pegawai
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class PengurusModel extends Eloquent
{
	protected $table = 'pengurus';
	protected $primaryKey = 'id_pengurus';

	protected $casts = [
		'id' => 'int',
		'id_pegawai' => 'int'
	];

	protected $fillable = [
		'id',
		'id_pegawai',
		'id_santri'
	];

	public function user()
	{
		return $this->belongsTo(\Sitren\User::class, 'id');
	}

	public function pegawai()
	{
		return $this->belongsTo(\Sitren\PegawaiModel::class, 'id_pegawai');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\SantriModel::class, 'id_santri');
	}
}
