<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload($nrp, Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);

            // Simpan informasi gambar di database jika diperlukan
            // Misalnya, jika Anda ingin menghubungkan gambar dengan entitas "personil".
            $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
            if($personil == null){
                return abort(404);
            } else {// Gantilah dengan cara Anda mengambil entitas Personil
                $personil->image_url = 'storage/images/' . $imageName;
                $personil->save();
            }
            return redirect()->route('admin.personil.show', ['nrp' => $nrp])->with('success', 'Foto personil berhasil diperbarui.');
        }

        return 'Tidak ada gambar yang diunggah.';
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
