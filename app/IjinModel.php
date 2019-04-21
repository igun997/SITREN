<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 19 Apr 2019 08:05:15 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Ijin
 *
 * @property string $id_ijin
 * @property string $id_santri
 * @property int $id_pengurus
 * @property string $tujuan_ijin
 * @property \Carbon\Carbon $waktu_start
 * @property \Carbon\Carbon $waktu_end
 * @property \Carbon\Carbon $waktu_keluar
 * @property \Carbon\Carbon $waktu_kembali
 * @property string $status_ijin
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Sitren\Pengurus $pengurus
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class IjinModel extends Eloquent
{
	protected $table = 'ijin';
	protected $primaryKey = 'id_ijin';
	public $incrementing = false;

	protected $casts = [
		'id_pengurus' => 'int'
	];

	protected $dates = [
		'waktu_start',
		'waktu_end',
		'waktu_keluar',
		'waktu_kembali'
	];

	protected $fillable = [
		'id_santri',
		'id_ijin',
		'id_pengurus',
		'tujuan_ijin',
		'waktu_start',
		'waktu_end',
		'waktu_keluar',
		'waktu_kembali',
		'status_ijin'
	];

	public function pengurus()
	{
		return $this->belongsTo(\Sitren\PengurusModel::class, 'id_pengurus');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\SantriModel::class, 'id_santri');
	}
}
