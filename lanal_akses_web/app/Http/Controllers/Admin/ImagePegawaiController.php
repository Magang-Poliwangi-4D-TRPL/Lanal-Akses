<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class ImagePegawaiController extends Controller
{
    public function upload($nip, Request $request)
    {
        // Validasi form untuk memeriksa apakah file gambar diunggah
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // Sesuaikan dengan kebutuhan Anda
        ],[
            'image.required' => 'Gambar belum terupload atau belum diisi',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);

            // Simpan informasi gambar di database jika diperlukan
            $pegawai = PegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
            if ($pegawai == null) {
                return abort(404);
            } else {
                $pegawai->image_url = 'storage/images/' . $imageName;
                $pegawai->save();
            }
            return redirect()->route('admin.pegawai.show', ['nip' => $nip])->with('success', 'Foto pegawai berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Pilih file gambar terlebih dahulu.');
    }

    public function editGambar($nip){
        $pegawai = PegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        if($pegawai == null){
            return abort(404);
        } else {
            return view('admin.pegawai.upload-gambar', compact('pegawai'));
            
        }
    }
}
