<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KehadiranModel;
use App\Models\PegawaiModel;
use App\Models\PengajuanCutiModel;
use App\Models\PersonilModel;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(){
        $personil = PersonilModel::all();
        $pns = PegawaiModel::all();
        $admin = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('name', ['personel', 'pegawai']);
        })->get();

        // Kehadiran 
        $utc_timezone = new DateTimeZone("UTC");
        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");
        $datetime = new DateTime("now", $utc_timezone);
        $datetime->setTimezone($tallinn_timezone);
        $date = $datetime->format('Y-m-d');


        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();
        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();
        $countPresensiPersonilToday = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->where('status_kehadiran', 'Belum Absen')->get();
        $countPresensiPegawaiToday = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->where('status_kehadiran', 'Belum Absen')->get();
        
        // Pengajuan Cuti
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $pengajuanCuti = PengajuanCutiModel::whereBetween('tanggal_mulai_cuti', [$startDate, $endDate])->get();

        return view('admin.dashboard', compact('personil', 'pns', 'admin' ,'absensiPersonil', 'absensiPegawai', 'countPresensiPersonilToday', 'countPresensiPegawaiToday', 'pengajuanCuti'));

    }

    public function createAllUserPegawai() {
        $pegawai = PegawaiModel::all();
        if ($pegawai->count()<=0) {
            return abort(404, 'tabel pegawai masih kosong');
        }
        $pegawaiHaveUser = []; 
        foreach ($pegawai as $item) {
            $test = User::where('pegawai_id', $item->id)->get();
            if ($test->count()!=0) {
                array_push($pegawaiHaveUser, $test);
            }
            
        }

        if ($pegawaiHaveUser == null) {
            foreach ($pegawai as $key => $value) {
                $user = User::create([
                    "nama_lengkap" => $value['nama_pegawai'],
                    "username" => $value['nip'],
                    "password" => Hash::make($value['nip']),
                    'pegawai_id' => $value['id']
                ]);

                $user->assignRole('pegawai');
                
            }

            return redirect()->route('admin.akun-personil.index', ['page' => 1]);
        } elseif ($pegawai->count() == count($pegawaiHaveUser)){
            return redirect()->route('admin.akun-pegawai.index', ['page' => 1]);
        }
        else {
            
            $pegawaiWithoutUser = [];
            
            foreach ($pegawai as $item) {
                $check = [];
                foreach ($pegawaiHaveUser as $data) {
                    if ($item->id != $data[0]->pegawai_id) {
                        array_push($check, 'true');
                    } else {
                        array_push($check, 'false');
                    }                     
                }
                if (in_array('false', $check)) {

                } else {
                    array_push($pegawaiWithoutUser, $item);
                }
            }
            foreach ($pegawaiWithoutUser as $key => $value) {
                $user = User::create([
                    "nama_lengkap" => $value['nama_pegawai'],
                    "username" => $value['nip'],
                    "password" => Hash::make($value['nip']),
                    'pegawai_id' => $value['id']
                ]);

                

                $user->assignRole('pegawai');
            }

            return redirect()->route('admin.akun-pegawai.index', ['page' => 1]);
        }
        
    }

    public function createAllUserPersonil() {
        $personil = personilModel::all();
        if ($personil->count()<=0) {
            return abort(404, 'tabel personil masih kosong');
        }
        $personilHaveUser = []; 
        foreach ($personil as $item) {
            $test = User::where('personil_id', $item->id)->get();
            if ($test->count()!=0) {
                array_push($personilHaveUser, $test);
            }
            
        }

        if ($personilHaveUser == null) {
            foreach ($personil as $key => $value) {
                $user = User::create([
                    "nama_lengkap" => $value['nama_lengkap'],
                    "username" => $value['nrp'],
                    "password" => Hash::make($value['nrp']),
                    'personil_id' => $value['id']
                ]);
                $user->assignRole('personel');
            }
            return redirect()->route('admin.akun-personil.index', ['page' => 1]);
        } elseif ($personil->count() == count($personilHaveUser)){
            return redirect()->route('admin.akun-personil.index', ['page' => 1]);
        }
        else {
            
            $personilWithoutUser = [];
            
            foreach ($personil as $item) {
                $check = [];
                foreach ($personilHaveUser as $data) {
                    if ($item->id != $data[0]->personil_id) {
                        array_push($check, 'true');
                    } else {
                        array_push($check, 'false');
                    }                     
                }
                if (in_array('false', $check)) {
                } else {
                    array_push($personilWithoutUser, $item);
                }
            }
            foreach ($personilWithoutUser as $key => $value) {
                $user = User::create([
                    "nama_lengkap" => $value['nama_lengkap'],
                    "username" => $value['nrp'],
                    "password" => Hash::make($value['nrp']),
                    'personil_id' => $value['id']
                ]);

                $user->assignRole('personel');
            }

            return redirect()->route('admin.akun-personil.index', ['page' => 1]);
        }
        
    }
}
