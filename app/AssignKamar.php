<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AssignKamar
 * 
 * @property int $id_akr
 * @property int $id_kamar
 * @property string $id_santri
 * 
 * @property \Sitren\Kamar $kamar
 * @property \Sitren\Santri $santri
 *
 * @package Sitren
 */
class AssignKamar extends Eloquent
{
	protected $table = 'assign_kamar';
	protected $primaryKey = 'id_akr';
	public $timestamps = false;

	protected $casts = [
		'id_kamar' => 'int'
	];

	protected $fillable = [
		'id_kamar',
		'id_santri'
	];

	public function kamar()
	{
		return $this->belongsTo(\Sitren\Kamar::class, 'id_kamar');
	}

	public function santri()
	{
		return $this->belongsTo(\Sitren\Santri::class, 'id_santri');
	}
}
