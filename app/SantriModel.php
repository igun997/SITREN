<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 15 Apr 2019 03:10:55 +0000.
 */

namespace Sitren;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Santri
 *
 * @property string $id_santri
 * @property string $nama_lengkap
 * @property string $nama_panggilan
 * @property string $jenis_kelamin
 * @property string $tmpt_lhir
 * @property \Carbon\Carbon $tgl_lhr
 * @property int $anak_ke
 * @property int $total_anak
 * @property string $status_keluarga
 * @property string $bahasa_harian
 * @property string $nama_ayah
 * @property string $tmpt_lhir_ayah
 * @property \Carbon\Carbon $tgl_lhir_ayah
 * @property string $alamat_lengkap_ayah
 * @property string $desa_ayah
 * @property string $kec_ayah
 * @property string $kota_ayah
 * @property string $prop_ayah
 * @property string $notelp_ayah
 * @property string $penghasilan_ayah
 * @property string $pendidikan_ayah
 * @property string $pekerjaan_ayah
 * @property string $nama_ibu
 * @property string $tmpt_lhir_ibu
 * @property \Carbon\Carbon $tgl_lhir_ibu
 * @property string $alamat_lengkap_ibu
 * @property string $desa_ibu
 * @property string $kec_ibu
 * @property string $kota_ibu
 * @property string $prop_ibu
 * @property string $notelp_ibu
 * @property string $penghasilan_ibu
 * @property string $pendidikan_ibu
 * @property string $pekerjaan_ibu
 * @property string $nama_wali
 * @property string $tmpt_lhir_wali
 * @property \Carbon\Carbon $tgl_lhir_wali
 * @property string $alamat_lengkap_wali
 * @property string $status_hubungan_wali
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Sitren
 */
class SantriModel extends Eloquent
{
	protected $table = 'santri';
	protected $primaryKey = 'id_santri';
	public $incrementing = false;

	protected $casts = [
		'anak_ke' => 'int',
		'total_anak' => 'int'
	];

	protected $dates = [
		'tgl_lhr',
		'tgl_lhir_ayah',
		'tgl_lhir_ibu',
		'tgl_lhir_wali'
	];

	protected $fillable = [
		'id_santri',
		'nama_lengkap',
		'nama_panggilan',
		'jenis_kelamin',
		'tmpt_lhir',
		'tgl_lhr',
		'anak_ke',
		'total_anak',
		'status_keluarga',
		'bahasa_harian',
		'nama_ayah',
		'tmpt_lhir_ayah',
		'tgl_lhir_ayah',
		'alamat_lengkap_ayah',
		'desa_ayah',
		'kec_ayah',
		'kota_ayah',
		'prop_ayah',
		'notelp_ayah',
		'penghasilan_ayah',
		'pendidikan_ayah',
		'pekerjaan_ayah',
		'nama_ibu',
		'tmpt_lhir_ibu',
		'tgl_lhir_ibu',
		'alamat_lengkap_ibu',
		'desa_ibu',
		'kec_ibu',
		'kota_ibu',
		'prop_ibu',
		'notelp_ibu',
		'penghasilan_ibu',
		'pendidikan_ibu',
		'pekerjaan_ibu',
		'nama_wali',
		'tmpt_lhir_wali',
		'tgl_lhir_wali',
		'alamat_lengkap_wali',
		'status_hubungan_wali'
	];
}
