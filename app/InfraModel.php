<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Apr 2019 11:28:25 +0000.
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
class InfraModel extends Eloquent
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
		return $this->belongsTo(\Sitren\KatinfraModel::class, 'id_katinfra');
	}
}
