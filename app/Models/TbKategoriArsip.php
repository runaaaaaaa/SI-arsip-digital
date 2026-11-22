<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKategoriArsip
 * 
 * @property int $id_kategori
 * @property string $nama_kategori
 * @property string $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TbArsip[] $tb_arsips
 *
 * @package App\Models
 */
class TbKategoriArsip extends Model
{
	protected $table = 'tb_kategori_arsip';
	protected $primaryKey = 'id_kategori';

	protected $fillable = [
		'nama_kategori',
		'deskripsi'
	];

	public function tb_arsips()
	{
		return $this->hasMany(TbArsip::class, 'id_kategori');
	}
}
