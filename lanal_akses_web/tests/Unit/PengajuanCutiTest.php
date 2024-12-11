<?php

use Tests\TestCase;

class PengajuanCutiTest extends TestCase
{
    
    public function test_personel_can_submit_leave_with_sufficient_leave_balance()
    {
        

        // Pengajuan cuti dengan jenis cuti tahunan yang mengurangi sisa cuti
        $response = $this->post('/admin/pengajuan-cuti/', [
            'personil_id' => 162,// Personel Rudi Hartono
            'tanggal_mulai_cuti' => now()->addDays(1)->format('Y-m-d'),
            'tanggal_selesai_cuti' => now()->addDays(3)->format('Y-m-d'),
            'atasan_id' => 7, // id atasan
            'jenis_cuti' => 'Cuti Tahunan',
            'alasan_cuti' => 'Butuh istirahat',
            'no_telepon' => '08123456789',
            'alamat_cuti' => 'Jl. Pahlawan',
        ]);

        // dd($response->getOriginalContent()->getData());

        // Pastikan pengajuan berhasil
        $response->assertRedirect(route('admin.surat-cuti.index'));
        $this->assertDatabaseHas('pengajuan_cuti', [
            'personil_id' => 162,
            'jenis_cuti' => 'Cuti Tahunan',
        ]);

        // Pastikan sisa cuti diperbarui
        $this->assertDatabaseHas('sisa_cuti', [
            'personil_id' => 162,
            'sisa_cuti' => 5, // 8 - 3 hari cuti
        ]);
    }
}
