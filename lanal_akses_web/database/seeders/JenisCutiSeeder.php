<?php

namespace Database\Seeders;

use App\Models\CutiModel;
use Illuminate\Database\Seeder;

class JenisCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CutiModel::create([
            "nama_cuti" => 'Cuti Tahunan',
            "kode_cuti" => 'CT-THN12',
            "jumlah_hari_cuti" => '12',
            "deskripsi" => "syarat cuti ini adalah bagi anggota militer yang telah bekerja selama sekurang-kurangnya 1 tahun terus menerus \n
                            Cuti dapat ditambahkan selama 7 hari apabila cuti tahunan hendak dijalankan di suatu tempat terpisah oleh lautan dari tempat kedudukan anggota Militer",
            
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Sakit',
            "kode_cuti" => 'CT-SKT180',
            "jumlah_hari_cuti" => '180',
            "deskripsi" => "jika perlu  masa cuti tersebut dapat diperpanjang dengan paling lama 6 (enam) bulan.",
            
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Dinas Lama',
            "kode_cuti" => 'CT-DNSL30',
            "jumlah_hari_cuti" => '30',
            "deskripsi" => "Seorang anggota Militer yang telah bekerja 3 (tiga) tahun terus-menerus berhak atas cuti dinas lama pemberian cuti ini selanjutnya dapat dilakukan tiap-tiap jangka waktu bekerja 3 (tiga) tahun setelah ia mulai mempunyai hak atas cuti tersebut.",
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Kawin',
            "kode_cuti" => 'CT-KWN6',
            "jumlah_hari_cuti" => '6',
            "deskripsi" =>"jumlah hari untuk anggota Militer Pria adalah 3 & 6 hari untuk anggota Militer Wanita",
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Luar Biasa',
            "kode_cuti" => 'CT-LRBS8',
            "jumlah_hari_cuti" => '8',
            "deskripsi" =>"jika waktu cuti luar biasa diberikan lebih dari 8 hari maka jatah lebih dari cuti tersebut akan diberikan dalam cuti tahunan yang bersangkutan.",
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Istimewa',
            "kode_cuti" => 'CT-IST12',
            "jumlah_hari_cuti" => '12',
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Ibadah Haji',
            "kode_cuti" => 'CT-IBDHJ',
            "jumlah_hari_cuti" => '120',
            "deskripsi" => "Seorang anggota Militer berhak atas cuti untuk menunaikan Ibadah Haji dengan syarat-syarat sebagai berikut: \n 
- telah 5 (lima) tahun terus-menerus dalam dinas militer. \n
- belum pernah menjalankan Ibadah Haji; \n
- memenuhi syarat-syarat umum yang berlaku untuk setiap calon Jema'ah Haji; \n 
- dinas mengizinkan pemberian cuti untuk Ibadah Haji selama masa kurang lebih"
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Ibadah',
            "kode_cuti" => 'CT-IBD',
            "jumlah_hari_cuti" => '120',
            "deskripsi" => "_"
        ]);
        CutiModel::create([
            "nama_cuti" => 'Cuti Hamil & Melahirkan',
            "kode_cuti" => 'CT-HMLM90',
            "jumlah_hari_cuti" => '90',
            "deskripsi" => "Jumlah Cuti : \n
- untuk sebelum melahirkan adalah 1,5 bulan\n 
- untuk sesudah melahirkan adalah 1,5 bulan\n
- dalam hal gugur kandungan diberikan 1,5 bulan"
        ]);
    }
}
