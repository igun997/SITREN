<?php

/**
 * Created by Reliese Model.
 * Date: Sun, 21 Apr 2019 08:18:57 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Setting
 *
 * @property int $id_setting
 * @property string $meta_key
 * @property string $meta_value
 *
 * @package Sitren
 */
class SettingModel extends Eloquent
{
	protected $table = 'setting';
	protected $primaryKey = 'id_setting';
	public $timestamps = false;

	protected $fillable = [
		'meta_key',
		'meta_value'
	];
}
