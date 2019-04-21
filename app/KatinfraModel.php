<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Apr 2019 11:09:43 +0000.
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
 * @package Sitren
 */
class KatinfraModel extends Eloquent
{
	protected $table = 'katinfra';
	protected $primaryKey = 'id_katinfra';

	protected $fillable = [
		'nama_katinfra'
	];
}
