<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\SisaCutiModel;
use Illuminate\Http\Request;

class SisaCutiController extends Controller
{
        // Menambahkan aturan untuk batasan sisa cuti 
        public function index(){
            $sisaCuti = SisaCutiModel::all();

            return view('admin.pengajuan-cuti.sisa-cuti.index', compact('sisaCuti'));
        }

        // Menambahkan aturan untuk batasan sisa cuti 
        public function create(){
            return view('admin.pengajuan-cuti.sisa-cuti.create');
        }
        
        // Menambahkan aturan untuk batasan sisa cuti 
        public function store(Request $request){
            // Validasi input
            $request->validate([
                'batas_cuti' => 'required|integer',
            ]);
    
            $personilList = PersonilModel::all();
            foreach ($personilList as $key => $value) {
                $sisaCuti = SisaCutiModel::create([
                    "personil_id" => $value['id'],
                    "batas_cuti" => $request['batas_cuti'],
                    "sisa_cuti" => $request['batas_cuti'],
                ]);
            }
            return redirect()->route('admin.sisa-cuti.index')->with('success', 'Batas cuti berhasil dibuat.');
        }

        // Menambahkan aturan untuk batasan sisa cuti 
        public function edit($id){
            $sisaCuti = SisaCutiModel::find($id);

            if ($sisaCuti == null) {
                return redirect()->back()->withErrors(['message' => 'Sisa cuti tidak ditemukan.']);
            } 
            

            return view('admin.pengajuan-cuti.sisa-cuti.edit', compact('sisaCuti'));
        }

        public function update(Request $request, $id){
            $sisaCuti = SisaCutiModel::find($id);

            if ($sisaCuti == null) {
                return redirect()->back()->withErrors(['message' => 'Sisa cuti tidak ditemukan.']);
            } 

            // Validasi input
            $request->validate([
                'sisa_cuti' => 'required|integer',
                'batas_cuti' => 'required|integer',
            ]);
    
            $sisaCuti->update([
                "batas_cuti" => $request['batas_cuti'],
                "sisa_cuti" => $request['sisa_cuti'],
            ]);
            $sisaCuti->save();          
    
            return redirect()->route('admin.sisa-cuti.index')->with('success', 'Batas cuti berhasil diupdate.');
        }

        public function updateAllCuti(){
            $sisaCuti = SisaCutiModel::all();

            foreach ($sisaCuti as $key => $value) {
                $value->update([
                    "batas_cuti" => 8,
                    "sisa_cuti" => 8,
                ]);

                $value->save();
            }
            return redirect()->route('admin.sisa-cuti.index')->with('success', 'Berhasil mengubah semua data batas cuti personel.');
        }
}
