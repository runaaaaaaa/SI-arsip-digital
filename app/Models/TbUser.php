<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TbUser
 *
 * @property int $id_user
 * @property string $nama_user
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $jabatan
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|TbNomorSurat[] $tb_nomor_surats
 *
 * @package App\Models
 */
class TbUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_user';
    protected $primaryKey = 'id_user';

    protected $hidden = [
        'password'
    ];

    protected $fillable = [
        'nama_user',
        'email',
        'username',
        'password',
        'role',
        'jabatan'
    ];

    public function tb_arsips()
    {
        return $this->hasMany(TbArsip::class, 'id_user_pemilik');
    }
}
