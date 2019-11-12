<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 12 Nov 2019 19:19:20 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Infra
 * 
 * @property int $id_infra
 * @property string $nama_infra
 * @property int $id_katinfra
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Sitren\Katinfra $katinfra
 *
 * @package Sitren
 */
class Infra extends Eloquent
{
	protected $table = 'infra';
	protected $primaryKey = 'id_infra';

	protected $casts = [
		'id_katinfra' => 'int'
	];

	protected $fillable = [
		'nama_infra',
		'id_katinfra'
	];

	public function katinfra()
	{
		return $this->belongsTo(\Sitren\Katinfra::class, 'id_katinfra');
	}
}
