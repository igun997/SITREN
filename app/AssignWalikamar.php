<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AssignWalikamar
 * 
 * @property int $id_awr
 * @property int $id_kamar
 * @property int $id_pengurus
 * 
 * @property \Sitren\Kamar $kamar
 * @property \Sitren\Pengurus $pengurus
 *
 * @package Sitren
 */
class AssignWalikamar extends Eloquent
{
	protected $table = 'assign_walikamar';
	protected $primaryKey = 'id_awr';
	public $timestamps = false;

	protected $casts = [
		'id_kamar' => 'int',
		'id_pengurus' => 'int'
	];

	protected $fillable = [
		'id_kamar',
		'id_pengurus'
	];

	public function kamar()
	{
		return $this->belongsTo(\Sitren\Kamar::class, 'id_kamar');
	}

	public function pengurus()
	{
		return $this->belongsTo(\Sitren\Pengurus::class, 'id_pengurus');
	}
}
