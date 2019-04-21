<?php

/**
 * Created by Reliese Model.
 * Date: Wed, 17 Apr 2019 05:18:46 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Pegawai
 *
 * @property int $id_pegawai
 * @property string $nama_pegawai
 * @property string $jk
 * @property string $alamat
 * @property string $notelp
 * @property string $email
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Sitren
 */
class PegawaiModel extends Eloquent
{
	protected $table = 'pegawai';
	protected $primaryKey = 'id_pegawai';

	protected $fillable = [
		'nama_pegawai',
		'jk',
		'alamat',
		'notelp',
		'email'
	];
}
