<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Apr 2019 08:17:47 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Transaksi
 *
 * @property string $id_transaksi
 * @property string $id_santri
 * @property string $jenis
 * @property float $jumlah
 * @property int $id_pengurus
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Sitren\Pengurus $pengurus
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class TransaksiModel extends Eloquent
{
	protected $table = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	public $incrementing = false;

	protected $casts = [
		'jumlah' => 'float',
		'id_pengurus' => 'int'
	];

	protected $fillable = [
		'id_transaksi',
		'id_santri',
		'keterangan',
		'jenis',
		'jumlah',
		'id_pengurus'
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
