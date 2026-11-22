<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbRak
 * 
 * @property int $id_rak
 * @property string $nama_rak
 * @property string $lokasi_rak
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|TbArsip[] $tb_arsips
 *
 * @package App\Models
 */
class TbRak extends Model
{
	protected $table = 'tb_rak';
	protected $primaryKey = 'id_rak';

	protected $fillable = [
		'nama_rak',
		'lokasi_rak'
	];

	public function tb_arsips()
	{
		return $this->hasMany(TbArsip::class, 'id_rak');
	}
}
