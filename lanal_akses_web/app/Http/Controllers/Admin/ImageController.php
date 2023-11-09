<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload($nrp, Request $request)
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
            $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
            if ($personil == null) {
                return abort(404);
            } else {
                $personil->image_url = 'storage/images/' . $imageName;
                $personil->save();
            }
            return redirect()->route('admin.personil.show', ['nrp' => $nrp])->with('success', 'Foto personil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Pilih file gambar terlebih dahulu.');
    }


    public function editGambar($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        if($personil == null){
            return abort(404);
        } else {
            return view('admin.personil.upload-gambar', compact('personil'));
            
        }
    }

}
