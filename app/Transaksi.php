<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:05 +0000.
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
 * @property string $keterangan
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Sitren\Pengurus $pengurus
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class Transaksi extends Eloquent
{
	protected $table = 'transaksi';
	protected $primaryKey = 'id_transaksi';
	public $incrementing = false;

	protected $casts = [
		'jumlah' => 'float',
		'id_pengurus' => 'int'
	];

	protected $fillable = [
		'id_santri',
		'jenis',
		'jumlah',
		'id_pengurus',
		'keterangan'
	];

	public function pengurus()
	{
		return $this->belongsTo(\Sitren\Pengurus::class, 'id_pengurus');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\Santri::class, 'id_santri');
	}
}
