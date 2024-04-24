<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class Data_User extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'user_id',
        'user_fullname',
        'user_username',
        'user_password',
        'user_email',
        'user_notelp',
        'user_alamat',
        'user_profil_url',
        'user_level',
        'user_status',
    ];
    protected $hidden = [
        'user_password',
    ];
    protected static function register ($data)
    {
        return self::create($data);
    }
    protected static function createData_User($data, UploadedFile $profil = null)
    {
        $user = $data;
        if ($profil) {
            $path = $profil->store('public/user/profile');
            $user['user_profil_url'] = $path;
        }
        $existingUser = DB::table('user')->where('user_username', $data['user_username'])->first();
        if ($existingUser) {
            throw new \Exception('Data user dengan username yang sama sudah ada');
        } else {
            DB::table('user')->insert($user);
        }
    }    
    protected static function readData_UserAll ()
    {
        $data = DB::table('user')->get();
        return $data;
    }
    protected static function readData_UserPaginate ()
    {
        $data = DB::table('user')->paginate(10);
        return $data;
    }
    protected static function readData_UserById ($id)
    {
        $data = DB::table('user')->where('user_id', $id)->first();
        return $data;
    }
    protected static function upload_profile ($id, $data)
    {
        $user = self::find($id);
        if ($user->user_profil_url) {
            Storage::delete($user->user_profil_url);
        }
        if ($data) {
            $path = $data->store('public/user/profile');
            $user->user_profil_url = $path;
        }
        $user->save();
    }
    protected static function updateData_User ($id, $data, UploadedFile $profil = null)
    {
        $user = DB::table('user')->where('user_id', $id)->first();
        if ($user) {
            if ($profil && $user->user_profil_url) {
                Storage::delete($user->user_profil_url);
                $path = $profil->store('public/user/profile');
                $data['user_profil_url'] = $path;
            }
            DB::table('user')->where('user_id', $id)->update($data);
            return $data;
        }
        return null;
    }
    protected static function deleteData_User ($id)
    {
        return DB::table('user')->where('user_id', $id)->delete();
    }
}
