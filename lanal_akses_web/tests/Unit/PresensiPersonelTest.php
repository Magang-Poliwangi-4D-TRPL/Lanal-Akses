<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Tests\TestCase;

class PresensiPersonelTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testPresensiGagalKarenaNrpSalah()
    {
        $response = $this->post('/personel/absensi', [
            'nama_lengkap' => 'Suhendra Kurniawan',
            'nrp' => 'wrong_nrp',
            'status_kehadiran' => 'Hadir',
            'lokasi' => '-8.137807,114.4005344'
        ]);

        $response->assertSessionHasErrors(['nrp' => 'NRP tidak ditemukan! Harap periksa kembali.']);
    }

    // 2. Test ketika jam masuk melebihi batas dan status menjadi 'Terlambat'
    public function testPresensiMasukTerlambat()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
        $response = $this->post('/personel/absensi', [
            'nama_lengkap' => 'Suhendra Kurniawan',
            'nrp' => '26226/P',
            'status_kehadiran' => 'Hadir',
            'lokasi' => '-8.137807,114.4005344',
            'waktu_kerja_id' => 1,
            'tanggal_absensi' => Carbon::now()->toDateString(),
            'jam_masuk' => '09:00:00', // Melebihi batas jam masuk (08:00)
            'keterangan' => '-'
        ]);
        // dd($response);
        $response->assertRedirect(route('absensi.masuk.success'));
        $response->assertSessionHas('warning', 'Anda berhasil melakukan absensi masuk hari ini. Jangan sampai terlambat lagi');
    }
    
    public function testPresensiMasukTepatWaktu()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
        $response = $this->post('/personel/absensi', [
            'nama_lengkap' => 'Rudi Hartono',
            'nrp' => '101313',
            'status_kehadiran' => 'Hadir',
            'lokasi' => '-8.137807,114.4005344',
            'waktu_kerja_id' => 1,
            'tanggal_absensi' => Carbon::now()->toDateString(),
            'keterangan' => '-',
            'jam_masuk' => '06:45:00' // Tepat waktu sebelum jam masuk (08:00)
        ]);

        // dd($response);

        $response->assertRedirect('/personel/absensi/success-absensi-masuk');
        $response->assertSessionHas('success', 'Anda berhasil melakukan absensi masuk hari ini. Jangan lupa untuk melakukan absensi pulang nanti');
    }
    
    
    // 4. Test presensi pulang sebelum batas waktu
    public function testPresensiPulangSebelumBatas()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
        $response = $this->post('/personel/absensi', [
            'nama_lengkap' => 'Suhendra Kurniawan',
            'nrp' => '26226/P',
            'status_kehadiran' => 'Hadir',
            'lokasi' => '-8.137807,114.4005344',
            'keterangan' => '-',
            'waktu_kerja_id' => 1,
            'tanggal_absensi' => Carbon::now()->toDateString(),
            'jam_masuk' => '09:00:00', 
            'jam_pulang' => '12:00:00' // Sebelum jam pulang (13:00)
        ]);

        $response->assertRedirect('/personel/absensi/success-absensi-masuk');
        $response->assertSessionHas('warning', 'Anda telah melakukan absensi masuk, tunggu hingga waktu absensi pulang!');
    }

    // 5. Test presensi pulang berhasil
    public function testPresensiPulangBerhasil()
    {
        date_default_timezone_set('Asia/Jakarta');
        Carbon::setLocale('id');
        $response = $this->post('/personel/absensi', [
            'nama_lengkap' => 'Rudi Hartono',
            'nrp' => '101313',
            'status_kehadiran' => 'Hadir',
            'lokasi' => '-8.137807,114.4005344',
            'waktu_kerja_id' => 1,
            'keterangan' => '-',
            'tanggal_absensi' => Carbon::now()->toDateString(),
            'jam_masuk' => '13:45:00', 
            'jam_pulang' => '17:10:00' // Setelah jam pulang (17:00)
        ]);

        $response->assertRedirect('/personel/absensi/success-absensi');
        $response->assertSessionHas('success', 'Terimakasih telah melakukan absensi, semoga anda dapat hadir di hari esok!');

    }

}
