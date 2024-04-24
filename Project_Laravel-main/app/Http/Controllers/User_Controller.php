<?php

namespace App\Http\Controllers;

use App\Models\Data_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class User_Controller extends Controller
{
    public function createData_User()
    {
        return view("web.create.data_user");
    }
    public function updateData_User($id)
    {
        $data = Data_User::readData_UserById($id);
        return view("web.update.data_user", ["data_user" => $data]);
    }
    public function login(Request $request)
    {
        $credentials = [
            "user_username" => $request->input("username"),
            "user_password" => $request->input("password"),
        ];
        $user = Data_User::where(
            "user_username",
            $credentials["user_username"]
        )->first();
        if (
            $user &&
            Hash::check($credentials["user_password"], $user->user_password)
        ) {
            Auth::login($user);
            Log::info("🟢 User " . $user->user_nama . " berhasil login");
            return redirect()->route("dashboard");
        } else {
            return back()->withErrors([
                "message" => "Username atau password Anda salah.",
            ]);
        }
    }
    public function register(Request $request)
    {
        $data = [
            "user_fullname" => $request->input("username"),
            "user_username" => $request->input("username"),
            "user_password" => bcrypt($request->input("password")),
            "user_email" => $request->input("email"),
            "user_notelp" => $request->input("notelp"),
            "user_alamat" => $request->input("alamat"),
        ];

        $user = Data_User::register($data);

        if ($user) {
            Log::info(
                "🟢 User bernama " .
                    $request->input("username") .
                    " telah mendaftar"
            );
            return redirect()
                ->route("login")
                ->with("success", "Pendaftaran akun berhasil!");
        } else {
            return back()->withInput();
        }
    }
    public function upload_profile(Request $request, $id)
    {
        $profil = $request->file("profil");
        if ($profil) {
            Data_User::upload_profile($id, $profil);
            Log::debug("🟣 File baru berhasil ditambahkan/disimpan");
            return back()->with("success", "Foto profil berhasil diperbarui!");
        }
        return back()->with("failed", "Foto profil gagal diperbarui!");
    }
    public function create(Request $request)
    {
        $profil = $request->file("profil");
        $data = [
            "user_fullname" => $request->input("fullname"),
            "user_username" => $request->input("username"),
            "user_password" => bcrypt($request->input("password")),
            "user_email" => $request->input("email"),
            "user_notelp" => $request->input("notelp"),
            "user_alamat" => $request->input("alamat"),
            "user_level" => $request->input("level"),
            "user_status" => $request->input("status"),
        ];
        Data_User::createData_User($data, $profil);
        Log::info(
            "🟢 Data_User " . $request->input("nama") . " berhasil ditambahkan"
        );
        return redirect()
            ->back()
            ->with("success", "Data user berhasil ditambahkan!");
    }
    public function update(Request $request, $id)
    {
        $ids = Data_User::find($id);
        if (!$ids) {
            return redirect()
                ->back()
                ->with("error", "Data user tidak ditemukan.");
        }
        $profil = $request->file("profil");
        $data = [
            "user_id" => $id,
            "user_fullname" => $request->input("fullname"),
            "user_username" => $request->input("username"),
            "user_password" => bcrypt($request->input("password")),
            "user_email" => $request->input("email"),
            "user_notelp" => $request->input("notelp"),
            "user_alamat" => $request->input("alamat"),
            "user_level" => $request->input("level"),
            "user_status" => $request->input("status"),
        ];
        Data_User::updateData_User($id, $data, $profil);
        Log::notice(
            "🟡 Data_User " . $request->input("nama") . " berhasil diubah"
        );
        return redirect()
            ->back()
            ->with("success", "Data user berhasil diperbarui!");
    }
    public function delete($id)
    {
        $user = Data_User::find($id);
        if ($user) {
            Log::alert("🔴 Data_User dengan ID : " . $id . " berhasil dihapus");
            $user->delete();
            return redirect()
                ->back()
                ->with("deleted", "Data user berhasil dihapus!");
        } else {
            Log::error("🔴 Data_User dengan ID : " . $id . " gagal dihapus");
            return redirect()
                ->back()
                ->with("error", "Data user tidak ditemukan.");
        }
    }
}