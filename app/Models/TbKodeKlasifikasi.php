<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TbKodeKlasifikasi
 *
 * @property int $id_kode_klasifikasi
 * @property string $kode_klasifikasi
 * @property string $nama_klasifikasi
 * @property string $deskripsi
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|TbArsip[] $tb_arsips
 *
 * @package App\Models
 */
class TbKodeKlasifikasi extends Model
{
    protected $table = 'tb_kode_klasifikasi';
    protected $primaryKey = 'id_kode_klasifikasi';

    protected $fillable = [
        'kode_klasifikasi',
        'nama_klasifikasi',
        'deskripsi',
        'id_parent_klasifikasi'
    ];

    public function tb_arsips()
    {
        return $this->hasMany(TbArsip::class, 'id_kode_klasifikasi');
    }

    public function parent()
    {
        return $this->belongsTo(TbKodeKlasifikasi::class, 'id_parent_klasifikasi');
    }

    // Relasi ke anak
    public function children()
    {
        return $this->hasMany(TbKodeKlasifikasi::class, 'id_parent_klasifikasi');
    }
}
