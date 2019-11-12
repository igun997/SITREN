<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Katinfra
 * 
 * @property int $id_katinfra
 * @property string $nama_katinfra
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $infras
 *
 * @package Sitren
 */
class Katinfra extends Eloquent
{
	protected $table = 'katinfra';
	protected $primaryKey = 'id_katinfra';

	protected $fillable = [
		'nama_katinfra'
	];

	public function infras()
	{
		return $this->hasMany(\Sitren\Infra::class, 'id_katinfra');
	}
}
