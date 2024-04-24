<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
{
    try {
        $admins = Admin::all();
        
        if ($admins->isEmpty()) {
            return response()->json([
                'message' => 'Data masih kosong',
                'data' => $admins
            ], 200);
        }

        return response()->json([
            'message' => 'Data Admin berhasil ditemukan',
            'data' => $admins
        ], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan pada server!'
        ], 500);
    }
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'admin_username' => 'required|max:50|unique:admin,admin_username',
                'password' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $admin = Admin::create([
                'admin_username' => $request->admin_username,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'Admin berhasil ditambahkan',
                'data' => $admin
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $admin = Admin::find($id);

            if (!$admin) {
                return response()->json([
                    'message' => 'Data Admin tidak ditemukan',
                    'data' => $admin
                ], 404);
            }

            return response()->json([
                'message' => 'Data Admin berhasil ditemukan',
                'data' => $admin
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server!'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'admin_username' => 'required|max:50' . $id,
                'password' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $admin = Admin::find($id);

            if (!$admin) {
                return response()->json([
                    'message' => 'Data Admin tidak ditemukan!',
                    'data' => $admin
                ], 404);
            }

            $admin->update([
                'admin_username' => $request->admin_username,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'message' => 'Data Admin berhasil diperbarui!',
                'data' => $admin
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $admin = Admin::find($id);

            if (!$admin) {
                return response()->json([
                    'message' => 'Data Admin tidak ditemukan!',
                    'data' => $admin
                ], 404);
            }

            $admin->delete();

            return response()->json([
                'message' => 'Data Admin berhasil dihapus!',
                'data' => $admin
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan pada server!'
            ], 500);
        }
    }
}
