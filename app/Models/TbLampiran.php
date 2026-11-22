<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbLampiran
 *
 * @property int $id_lampiran
 * @property int $id_arsip
 * @property string $nama_file
 * @property string $url_file
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property TbArsip $tb_arsip
 *
 * @package App\Models
 */
class TbLampiran extends Model
{
	protected $table = 'tb_lampiran';
	protected $primaryKey = 'id_lampiran';

	protected $casts = [
		'id_arsip' => 'int'
	];

	protected $fillable = [
		'id_arsip',
		'nama_file',
		'url_file'
	];

	public function tb_arsip()
	{
		return $this->belongsTo(TbArsip::class, 'id_arsip', 'id_arsip');
	}
}
