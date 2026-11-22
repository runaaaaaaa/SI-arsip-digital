<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbArsip
 *
 * @property int $id_arsip
 * @property string $nomor_arsip
 * @property int $id_user_pemilik
 * @property int $id_rak
 * @property int $id_kategori
 * @property int $id_kode_klasifikasi
 * @property string $jenis_arsip
 * @property string $kategori_surat
 * @property Carbon $tanggal_surat
 * @property string $pengirim
 * @property string $penerima
 * @property string $perihal
 * @property string $status_arsip
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbKategoriArsip $tb_kategori_arsip
 * @property TbKodeKlasifikasi $tb_kode_klasifikasi
 * @property TbRak $tb_rak
 * @property TbUser $tb_user
 * @property Collection|TbLampiran[] $tb_lampirans
 *
 * @package App\Models
 */
class TbArsip extends Model
{
	protected $table = 'tb_arsip';
	protected $primaryKey = 'id_arsip';

	protected $casts = [
		'id_user_pemilik' => 'int',
		'id_rak' => 'int',
		'id_kategori' => 'int',
		'id_kode_klasifikasi' => 'int',
		'tanggal_surat' => 'datetime'
	];

	protected $fillable = [
		'nomor_arsip',
		'id_user_pemilik',
		'id_rak',
		'id_kategori',
		'id_kode_klasifikasi',
		'jenis_arsip',
		'kategori_sifat',
		'tanggal_surat',
		'pengirim',
		'penerima',
		'perihal',
		'status_arsip'
	];

	public function tb_kategori_arsip()
	{
		return $this->belongsTo(TbKategoriArsip::class, 'id_kategori');
	}

	public function tb_kode_klasifikasi()
	{
		return $this->belongsTo(TbKodeKlasifikasi::class, 'id_kode_klasifikasi');
	}

	public function tb_rak()
	{
		return $this->belongsTo(TbRak::class, 'id_rak');
	}

	public function tb_user()
	{
		return $this->belongsTo(TbUser::class, 'id_user_pemilik');
	}

	public function tb_lampiran()
	{
		return $this->hasOne(TbLampiran::class, 'id_arsip', 'id_arsip');
	}
}
