<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Kamar
 * 
 * @property int $id_kamar
 * @property string $nama_kamar
 * @property string $asrama
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $assign_kamars
 * @property \Illuminate\Database\Eloquent\Collection $assign_walikamars
 *
 * @package Sitren
 */
class Kamar extends Eloquent
{
	protected $table = 'kamar';
	protected $primaryKey = 'id_kamar';

	protected $fillable = [
		'nama_kamar',
		'asrama'
	];

	public function assign_kamars()
	{
		return $this->hasMany(\Sitren\AssignKamar::class, 'id_kamar');
	}

	public function assign_walikamars()
	{
		return $this->hasMany(\Sitren\AssignWalikamar::class, 'id_kamar');
	}
}
