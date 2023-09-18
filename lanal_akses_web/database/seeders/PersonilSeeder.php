<?php

namespace Database\Seeders;

use App\Models\PersonilModel;
use Illuminate\Database\Seeder;

class PersonilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonilModel::create(
            [
                "nama_lengkap" => "Indra Nusha R",
                "PANGKAT_KORPS" => "Letkol Laut (P)",
                "NRP" => "16572/P",
                "JABATAN" => "Komandan Lanal Bwi",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                'nama_lengkap'    => 'Rochmat Abdullah',
                'nrp'    => '17374/P',
                'jabatan'    => 'Palaksa',
                'jenis_kelamin'    => 'L',
            ],
        );
        PersonilModel::create(
            [
                'nama_lengkap'    => 'Suwarno',
                'nrp'    => '19386/P',
                'jabatan'    => 'Pasminlog',
                'jenis_kelamin'    => 'L',
            ],
        );
        PersonilModel::create(
            [
                'nama_lengkap'    => 'Teguh Kurniawan',
                'nrp'    => '19754/P',
                'jabatan'    => 'Pasintel',
                'jenis_kelamin'    => 'L',
            ],
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Muryanto",
                "PANGKAT_KORPS" => "Kapten Laut (P)",
                "NRP" => "20198/P",
                "JABATAN" => "Dan KAL RJW",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sutejo, S.T., Han",
                "PANGKAT_KORPS" => "Kapten Laut (PM)",
                "NRP" => "20781/P",
                "JABATAN" => "Dandenpomal",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Rianto, S.H",
                "PANGKAT_KORPS" => "Kapten Laut (KH)",
                "NRP" => "21037/P",
                "JABATAN" => "Paspotmar",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Mujanu, S.Sos",
                "PANGKAT_KORPS" => "Kapten Laut (T)",
                "NRP" => "21265/P",
                "JABATAN" => "Pasprogar",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hermanto",
                "PANGKAT_KORPS" => "Lettu Laut (P)",
                "NRP" => "19743/P",
                "JABATAN" => "Paset",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Eko Meiyanto",
                "PANGKAT_KORPS" => "Lettu Laut (P)",
                "NRP" => "21574/P",
                "JABATAN" => "Posal Puger/Ur. Intel/PA",
                'jenis_kelamin'    => 'L',
            ]
        );
        ([
            "nama_lengkap" => "Suyadi",
            "PANGKAT_KORPS" => "Lettu Laut (S)",
            "NRP" => "21718/P",
            "JABATAN" => "Akun/Ur.Yar BP",
            'jenis_kelamin'    => 'L',
        ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suyadi",
                "PANGKAT_KORPS" => "Lettu Laut (S)",
                "NRP" => "21718/P",
                "JABATAN" => "Akun/Ur.Yar BP",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sigit Marsetyo",
                "PANGKAT_KORPS" => "Lettu Laut (S)",
                "NRP" => "21726/P",
                "JABATAN" => "Akun(PPSPM)/KA",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ahmad Jayadi",
                "PANGKAT_KORPS" => "Lettu Laut (PM)",
                "NRP" => "21844/P",
                "JABATAN" => "Denpomal/Ur.Idik Hartib",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Gadakusuma PS, S.Tr. Han",
                "PANGKAT_KORPS" => "Lettu Laut (S)",
                "NRP" => "21917/P",
                "JABATAN" => "Dan Unit Intel",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Alex Hamid Rusli T",
                "PANGKAT_KORPS" => "Lettu Laut (P)",
                "NRP" => "22029/P",
                "JABATAN" => "Paur Lid Sintel",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "dr.Dewa Nyoman PS",
                "PANGKAT_KORPS" => "Lettu Laut (K)",
                "NRP" => "22443/P",
                "JABATAN" => "Paur Polum",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Muchamad Hakim",
                "PANGKAT_KORPS" => "Lettu Laut (P)",
                "NRP" => "22474/P",
                "JABATAN" => "Dankal TBA",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "drg. Abdul Hadi",
                "PANGKAT_KORPS" => "Lettu Laut (K)",
                "NRP" => "22761/P",
                "JABATAN" => "Paur Polgi",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Dedi Nugraha, Amd",
                "PANGKAT_KORPS" => "Letda Laut (P)",
                "NRP" => "23275/P",
                "JABATAN" => "Posal Muncar/ Ur. Binpotmar/Pa",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Narsidin",
                "PANGKAT_KORPS" => "Letda Laut (T)",
                "NRP" => "23335/P",
                "JABATAN" => "Kasatbek",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Prayogo Setiawan, A.Md",
                "PANGKAT_KORPS" => "Letda Laut (E)",
                "NRP" => "23379/P",
                "JABATAN" => "Kasatkom",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Herdin",
                "PANGKAT_KORPS" => "Letda Laut (S)",
                "NRP" => "23422/P",
                "JABATAN" => "Paur Silta",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Satria Adenata N, A.Md",
                "PANGKAT_KORPS" => "Letda Laut (T)",
                "NRP" => "23895/P",
                "JABATAN" => "Kadepsin Kal RJW",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Achmad Andri",
                "PANGKAT_KORPS" => "Letda Laut (T)",
                "NRP" => "24769/P",
                "JABATAN" => "Dan Sub Unit Teknis",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Warwo",
                "PANGKAT_KORPS" => "Letda Laut (E)",
                "NRP" => "25819/P",
                "JABATAN" => "Posal Paiton/Ur. Intel/Pa",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Nur Hasan",
                "PANGKAT_KORPS" => "Letda Laut (S)",
                "NRP" => "25924/P",
                "JABATAN" => "Posal Pancer/Pur.Intel/Pa",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Priyo Budi Utomo",
                "PANGKAT_KORPS" => "Letda Mar",
                "NRP" => "26000/P",
                "JABATAN" => "Pasiopos Unit Intel",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "PANGKAT_KORPS" => "Letda Laut (KH)",
                "NRP" => "26226/P",
                "JABATAN" => "Simak/paur BMN",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Apang Suprahman",
                "PANGKAT_KORPS" => "Letda Laut (P)",
                "NRP" => "26289/P",
                "JABATAN" => "Paur Syahal",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "M. Choirul A",
                "PANGKAT_KORPS" => "Letda Laut (P)",
                "NRP" => "26342/P",
                "JABATAN" => "Posal Paiton/Ur. Opskamla/Pa",
                'jenis_kelamin'    => 'L',
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suraji",
                "PANGKAT_KORPS" => "Letda Laut (P)",
                "NRP" => "26388/P",
                "JABATAN" => "Paur Opslat",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Zaenal Arifin",
                "PANGKAT_KORPS" => "Letda Laut (P)",
                "NRP" => "26243/P",
                "JABATAN" => "Posal Paiton/Ur.Babinpotmar/Pa",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Edy Suprihantoro",
                "PANGKAT_KORPS" => "Letda Laut (T)",
                "NRP" => "26420/P",
                "JABATAN" => "Kasat Faslan",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Marthen Sattu S",
                "PANGKAT_KORPS" => "Peltu Bek",
                "NRP" => 73909,
                "JABATAN" => "Unit Teknis/Anggota Teknis 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suharjo",
                "PANGKAT_KORPS" => "Peltu Pom",
                "NRP" => 76663,
                "JABATAN" => "Pomal/Ur.Lidkrim",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Andik Karvianto",
                "PANGKAT_KORPS" => "Peltu Pum",
                "NRP" => 79670,
                "JABATAN" => "Set/Ur Protokol 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Edi Sukiswo",
                "PANGKAT_KORPS" => "Peltu Pku",
                "NRP" => 79848,
                "JABATAN" => "Danpatkamla 1-5-27",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "I Nyoman S",
                "PANGKAT_KORPS" => "Peltu Ttu",
                "NRP" => 79926,
                "JABATAN" => "Sops/Ur Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Samproni S.H",
                "PANGKAT_KORPS" => "Peltu Ttu",
                "NRP" => 79927,
                "JABATAN" => "Sintel/Ur. Pamgal/Ur. Pam",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Slamet Santoso",
                "PANGKAT_KORPS" => "Peltu Pom",
                "NRP" => 82159,
                "JABATAN" => "Pomal/Ur Idik",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Dedi Wijayanto,S.T",
                "PANGKAT_KORPS" => "Peltu Mes",
                "NRP" => 82178,
                "JABATAN" => "Spotmar/Ur.Renbin",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Suyono",
                "PANGKAT_KORPS" => "Peltu Mes",
                "NRP" => 82209,
                "JABATAN" => "Paga Tap",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Tintin Indraswati",
                "PANGKAT_KORPS" => "Peltu Nav/W",
                "NRP" => 82662,
                "JABATAN" => "Sprogar/Ur Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Mujibbudin",
                "PANGKAT_KORPS" => "Peltu Pom",
                "NRP" => 83798,
                "JABATAN" => "Pomal/Idik Ur Riksa/Olah TKP",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Soim Romadhon",
                "PANGKAT_KORPS" => "Peltu Ttu",
                "NRP" => 83968,
                "JABATAN" => "Sops/Ur Opslat",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ali Wahyudi",
                "PANGKAT_KORPS" => "Peltu Mar",
                "NRP" => 84248,
                "JABATAN" => "Satma/Bama",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Eka Hermawan",
                "PANGKAT_KORPS" => "Peltu Saa",
                "NRP" => 86502,
                "JABATAN" => "Sops/Opslat/Ur Sahal",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Eko Susianto",
                "PANGKAT_KORPS" => "Peltu Keu",
                "NRP" => 89261,
                "JABATAN" => "Akun/PPSPM/Ur Yar(BP) Ur Yar 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Supriyadi",
                "PANGKAT_KORPS" => "Peltu Keu",
                "NRP" => 89275,
                "JABATAN" => "Akun (PPSPM)/Ur. Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Helmy Soesanto",
                "PANGKAT_KORPS" => "Peltu Bah",
                "NRP" => 91411,
                "JABATAN" => "Sminlog/Ur Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sigit Santoso",
                "PANGKAT_KORPS" => "PeltuTtu",
                "NRP" => 91600,
                "JABATAN" => "Satma/Ur Ang",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Imam Safi'i",
                "PANGKAT_KORPS" => "Peltu Ttu",
                "NRP" => 91686,
                "JABATAN" => "Pos Puger/Ur.Binpotmar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Marlin Imam T",
                "PANGKAT_KORPS" => "Peltu Ttu",
                "NRP" => 91687,
                "JABATAN" => "Satma/Ur. Arsip",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Salim",
                "PANGKAT_KORPS" => "Peltu Keu",
                "NRP" => 91705,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ilham fahruzi",
                "PANGKAT_KORPS" => "Pelda Ttg",
                "NRP" => 94152,
                "JABATAN" => "Akun/PPSPM/Ur Verifikasi/Ur Verif 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Andi Utomo",
                "PANGKAT_KORPS" => "Pelda Ttu",
                "NRP" => 98807,
                "JABATAN" => "Sminlog/Ur barang tdk bergerak",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Andik Avianto",
                "PANGKAT_KORPS" => "Pelda Rum",
                "NRP" => 98861,
                "JABATAN" => "BP/Ur. Polum",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Zaidi Antoni",
                "PANGKAT_KORPS" => "Pelda Kom",
                "NRP" => 96162,
                "JABATAN" => "Satkom/Juru Kom 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Iswanto, S.E",
                "PANGKAT_KORPS" => "Serma Nav",
                "NRP" => 70421,
                "JABATAN" => "Patkamla 1-5-28/Juru bahari 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "A. Nursaki",
                "PANGKAT_KORPS" => "Serma Ptb",
                "NRP" => 70544,
                "JABATAN" => "Patkamla 1-5-28/Dan",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Fajar Ismiyanto",
                "PANGKAT_KORPS" => "Serma Jas",
                "NRP" => 70814,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Syarief Hidayatullah",
                "PANGKAT_KORPS" => "Serma Lis",
                "NRP" => 72077,
                "JABATAN" => "Unit Intel/Ur Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Budiman",
                "PANGKAT_KORPS" => "Serma Nav",
                "NRP" => 74334,
                "JABATAN" => "Ur.Harranmor",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Wastono",
                "PANGKAT_KORPS" => "Serma Mar",
                "NRP" => 75800,
                "JABATAN" => "Unit Intel/Sub Unit Teknis/Unit Teknis 3",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Tri Siswoko",
                "PANGKAT_KORPS" => "Serma Bah",
                "NRP" => 766730,
                "JABATAN" => "Kal RJW/Bama",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Bambang Herutomo",
                "PANGKAT_KORPS" => "Serma Esa",
                "NRP" => 77895,
                "JABATAN" => "Posal Muncar/ Ur.Binpotmar 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Andriono",
                "PANGKAT_KORPS" => "Serma Bah",
                "NRP" => 82742,
                "JABATAN" => "Sops/Ur Kamla",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Moh. Ansori",
                "PANGKAT_KORPS" => "Serma Apm",
                "NRP" => 96527,
                "JABATAN" => "",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Widyar Florentina",
                "PANGKAT_KORPS" => "Serma Pdk/W",
                "NRP" => 110410,
                "JABATAN" => "Set/Ur Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Bayu Pramudita",
                "PANGKAT_KORPS" => "Serma Pom",
                "NRP" => 112782,
                "JABATAN" => "Denpomal/Ur Pamfik 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sunoto",
                "PANGKAT_KORPS" => "Serka Pom",
                "NRP" => 77696,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Saman",
                "PANGKAT_KORPS" => "Serka Nav",
                "NRP" => 78771,
                "JABATAN" => "Posal Paiton/Ur. Opskamla-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Beny Wahono Hadi",
                "PANGKAT_KORPS" => "Serka Pom",
                "NRP" => 80417,
                "JABATAN" => "Denpomal/ Ur Hartib 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Samsul Hadi",
                "PANGKAT_KORPS" => "Serka Kom",
                "NRP" => 80455,
                "JABATAN" => "Satkom/jr.Sandi-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suprapto",
                "PANGKAT_KORPS" => "Serka Eko",
                "NRP" => 80871,
                "JABATAN" => "Faslan/Ur. Instalasi",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Teguh Sudarmo",
                "PANGKAT_KORPS" => "Serka Pom",
                "NRP" => 83010,
                "JABATAN" => "Denpomal/Ur Hartib/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Mahmud Yunus",
                "PANGKAT_KORPS" => "SerkaTtu",
                "NRP" => 85641,
                "JABATAN" => "Spotmar/Ur PPU Bindesir",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Muhammad Badar",
                "PANGKAT_KORPS" => "Serka Tku",
                "NRP" => 118374,
                "JABATAN" => "Faslan/Ur.Kuntruksi",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Abdul Gofur",
                "PANGKAT_KORPS" => "Sertu Mes",
                "NRP" => 75418,
                "JABATAN" => "Satma/Ur Haranmor-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Subakir",
                "PANGKAT_KORPS" => "Sertu Mes",
                "NRP" => 76876,
                "JABATAN" => "MPP",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Singgih Prayoga",
                "PANGKAT_KORPS" => "Sertu Bah",
                "NRP" => 77318,
                "JABATAN" => "Posal Mcr/Ur.Binpotmar/Babinpotmar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suparman",
                "PANGKAT_KORPS" => "Sertu Rdl",
                "NRP" => 77560,
                "JABATAN" => "MPP",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Suroso",
                "PANGKAT_KORPS" => "Sertu Rjd",
                "NRP" => 77583,
                "JABATAN" => "Satma/Ur Senamo 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sari'i",
                "PANGKAT_KORPS" => "Sertu Ttg",
                "NRP" => 85673,
                "JABATAN" => "Mess Pakis-1/Ur. Mess-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Rudi Setyo Anggoro",
                "PANGKAT_KORPS" => "Sertu Kom",
                "NRP" => 87232,
                "JABATAN" => "kal RJW/Juru Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Endri Santoso",
                "PANGKAT_KORPS" => "Sertu Ttg",
                "NRP" => 88393,
                "JABATAN" => "PD Mess Bahari",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Badrus Saleh",
                "PANGKAT_KORPS" => "Sertu Nav",
                "NRP" => 90331,
                "JABATAN" => "Kal TBA/Juru Nav",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Zaenal Arifin",
                "PANGKAT_KORPS" => "Sertu Nav",
                "NRP" => 92208,
                "JABATAN" => "Sub Uunit Intel/Unit intel-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Rifan Hendriyanto",
                "PANGKAT_KORPS" => "Sertu Ttu",
                "NRP" => 93276,
                "JABATAN" => "Satma/Baga Tap",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yuli Ujiono",
                "PANGKAT_KORPS" => "Sertu Ttu",
                "NRP" => 97106,
                "JABATAN" => "Satma/Ur. Lam-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Rahmat Hidayat",
                "PANGKAT_KORPS" => "Serda Rdl",
                "NRP" => 77561,
                "JABATAN" => "Patkamla 1-528/Juru Bah 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Edi Supardi",
                "PANGKAT_KORPS" => "Serda Rjd",
                "NRP" => 77578,
                "JABATAN" => "Set/ Ur Yar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Nanang Helmi",
                "PANGKAT_KORPS" => "Serda Mes",
                "NRP" => 77664,
                "JABATAN" => "Satma/Pengemudi 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Miswan",
                "PANGKAT_KORPS" => "Serda Mus",
                "NRP" => 78170,
                "JABATAN" => "Set/Ur Protokol 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Selamat",
                "PANGKAT_KORPS" => "Serda Rdl",
                "NRP" => 78830,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yuwono S.H",
                "PANGKAT_KORPS" => "SerdaTlg",
                "NRP" => 80478,
                "JABATAN" => "Pos TNI AL Paiton/Juru Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Badius Afendi,S.H",
                "PANGKAT_KORPS" => "Serda Eko",
                "NRP" => 80833,
                "JABATAN" => "Posal Muncar/Juru kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sugiyono",
                "PANGKAT_KORPS" => "Serda Apk",
                "NRP" => 83257,
                "JABATAN" => "BP/Ur. Ku",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Joko Hariyanto",
                "PANGKAT_KORPS" => "Serda Ede",
                "NRP" => 85595,
                "JABATAN" => "Satkom/Ur.Harmat",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Choirul Anam",
                "PANGKAT_KORPS" => "Serda Bah",
                "NRP" => 92121,
                "JABATAN" => "PD Gedung serba guna II",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Januar Wijarnarko",
                "PANGKAT_KORPS" => "Serda Saa",
                "NRP" => 92239,
                "JABATAN" => "Posal Muncar/Ur.Opskamla-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Alfariek Syah",
                "PANGKAT_KORPS" => "Serda Mes",
                "NRP" => 95335,
                "JABATAN" => "Patkamla 1-5.5.05/Juru Mesin",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Selamet Hariyanto",
                "PANGKAT_KORPS" => "Serda Ttg",
                "NRP" => 97207,
                "JABATAN" => "Set/Ur.Lam",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sumarno",
                "PANGKAT_KORPS" => "Serda Ttg",
                "NRP" => 977979,
                "JABATAN" => "PD Gedung Serba Guna 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Moh.Seger Supardi",
                "PANGKAT_KORPS" => "Serda Bek",
                "NRP" => 97957,
                "JABATAN" => "Satbek/Ur.Bekpers",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Novi Dwi Yanto",
                "PANGKAT_KORPS" => "Serda Saa",
                "NRP" => 99494,
                "JABATAN" => "Ur. Gal",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Anang Subekti",
                "PANGKAT_KORPS" => "Serda Ttu",
                "NRP" => 101380,
                "JABATAN" => "Akun/Ur.Silta",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Paijo",
                "PANGKAT_KORPS" => "Serda Bek",
                "NRP" => 101412,
                "JABATAN" => "Satbek/Ur.Bekum",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Priyo Susilo",
                "PANGKAT_KORPS" => "Serda Kom",
                "NRP" => 101560,
                "JABATAN" => "Posal Puger/Ur.Opskamla-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Nanang Wahyudi",
                "PANGKAT_KORPS" => "Serda Ede",
                "NRP" => 101671,
                "JABATAN" => "Kal RJW/Juru Nav/Alnav",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Widhiyanto",
                "PANGKAT_KORPS" => "Serda Kom",
                "NRP" => 103669,
                "JABATAN" => "Jr.Kom Posal Blimbingsari",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Adi Prayogo",
                "PANGKAT_KORPS" => "Serda Nav",
                "NRP" => 105616,
                "JABATAN" => "KAL RJW/Juru Nav",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Irfan Zidni",
                "PANGKAT_KORPS" => "Serda Nav",
                "NRP" => 107351,
                "JABATAN" => "Unit Intel/Angg Unit Intel 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Helmi Martono",
                "PANGKAT_KORPS" => "Serda Ttg",
                "NRP" => 107546,
                "JABATAN" => "Posal Puger/Babinpotmar-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Abu Sairi",
                "PANGKAT_KORPS" => "Serda Kom",
                "NRP" => 108396,
                "JABATAN" => "Kal TBA/Jr.Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "M. Danis Baskoro",
                "PANGKAT_KORPS" => "Serda Mes",
                "NRP" => 108489,
                "JABATAN" => "Kal TBA/Jr.Mess-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Erik Santoso",
                "PANGKAT_KORPS" => "Serda Apm",
                "NRP" => 109057,
                "JABATAN" => "BP/Ur.Polgi",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Indra Wahyudi",
                "PANGKAT_KORPS" => "Serda Saa",
                "NRP" => 109196,
                "JABATAN" => "Spotmar/Babinpotmar-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sugiarto",
                "PANGKAT_KORPS" => "Serda Kom",
                "NRP" => 109116,
                "JABATAN" => "Posal Puger/Juru Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sarifudin",
                "PANGKAT_KORPS" => "Serda Mes",
                "NRP" => 109242,
                "JABATAN" => "KAL RJW/Dep Sin/Jr. MPK-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Wahab Abdilah",
                "PANGKAT_KORPS" => "Serda Saa",
                "NRP" => 110524,
                "JABATAN" => "Posal Muncar/Babinpotmar 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Iput Purwo A",
                "PANGKAT_KORPS" => "Serda Bek",
                "NRP" => 110712,
                "JABATAN" => "Sminlog/Minpers/Ur Yanpers jahpers",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Eko Wijaya",
                "PANGKAT_KORPS" => "SerdaTtg",
                "NRP" => 110741,
                "JABATAN" => "Kal RJW/Jr.Masak",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Eko Wahyu Galiana",
                "PANGKAT_KORPS" => "Serda Alf",
                "NRP" => 111297,
                "JABATAN" => "Posal Paiton/Babinpotmar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Budi Prasojo",
                "PANGKAT_KORPS" => "Serda Bah",
                "NRP" => 112897,
                "JABATAN" => "Spotmar/Binpotmar-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Alfian Firdausi",
                "PANGKAT_KORPS" => "Serda Kom",
                "NRP" => 112974,
                "JABATAN" => "Satkom/Juru Kom-1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Wawan Setiawan",
                "PANGKAT_KORPS" => "Serda Jas",
                "NRP" => 113559,
                "JABATAN" => "Sminlog/Ur.Minlog",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ficky Fathur Rahman",
                "PANGKAT_KORPS" => "Serda Keu",
                "NRP" => 131594,
                "JABATAN" => "Akun/PPSPM/Ur Yar(BP) Ur Yar 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Intan Syafial Tahta",
                "PANGKAT_KORPS" => "Serda Ttu/W",
                "NRP" => 131949,
                "JABATAN" => "Sprogar/Ur. Lakgar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Artika Septi Rahayu",
                "PANGKAT_KORPS" => "Serda Jas/W",
                "NRP" => 131980,
                "JABATAN" => "Sminlog/Ur. Minpers",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Abu Hasan",
                "PANGKAT_KORPS" => "Kopka Ptr",
                "NRP" => 76807,
                "JABATAN" => "Satma/Caraka Tap",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Kamiran",
                "PANGKAT_KORPS" => "Kopka Bah",
                "NRP" => 77315,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Fajar Indah",
                "PANGKAT_KORPS" => "Kopka Amo",
                "NRP" => 77614,
                "JABATAN" => "Pos TNI AL Blimbingsari/Juru Kom 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Habibbudin",
                "PANGKAT_KORPS" => "Kopka Mes",
                "NRP" => 77693,
                "JABATAN" => "Pos TNI AL Puger/Caraka",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Imam Haryono",
                "PANGKAT_KORPS" => "Kopka Mus",
                "NRP" => 79148,
                "JABATAN" => "Satma/Mess BA/TA/Ur Mess 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Soni Alriawan",
                "PANGKAT_KORPS" => "Kopka Nav",
                "NRP" => 80576,
                "JABATAN" => "Patkamla TJ Bantenan/Juru Bah",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Jemirin",
                "PANGKAT_KORPS" => "Kopka Bah",
                "NRP" => 81493,
                "JABATAN" => "Pos TNI AL Pancer/Caraka",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Puris Yulius A",
                "PANGKAT_KORPS" => "Kopka Bah",
                "NRP" => 81495,
                "JABATAN" => "Soptmar/Ur.Geomar/Injasmar",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Masroi",
                "PANGKAT_KORPS" => "Kopka Nav",
                "NRP" => 81559,
                "JABATAN" => "Satma/anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Maswan",
                "PANGKAT_KORPS" => "Kopka Ttg",
                "NRP" => 81709,
                "JABATAN" => "Satma/PD Mess Pakis/Ur Mess 1",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Samsul Arifin",
                "PANGKAT_KORPS" => "Kopka Pom",
                "NRP" => 84703,
                "JABATAN" => "Satma/Mess Pakis/Ur.Mess 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Vivin Agusdiyanto",
                "PANGKAT_KORPS" => "Kopka Trb",
                "NRP" => 85235,
                "JABATAN" => "Spotmar/Ur. Binpuan Daya Guna",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Supardi",
                "PANGKAT_KORPS" => "Kopka Ttg",
                "NRP" => 85689,
                "JABATAN" => "Pos TNI AL pancer/ur.Opskamla 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hadi Siswono",
                "PANGKAT_KORPS" => "Kopka Eta",
                "NRP" => 88232,
                "JABATAN" => "Kal TBA/Jr.Bah-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ishaq",
                "PANGKAT_KORPS" => "KopkaTtg",
                "NRP" => 88329,
                "JABATAN" => "Satma/PD Mess BA/TA",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "M.Hasyim Asy'ari",
                "PANGKAT_KORPS" => "Kopka Bah",
                "NRP" => 89630,
                "JABATAN" => "Spormar/Ur. Armanas",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yudi Siswanto",
                "PANGKAT_KORPS" => "Kopka  Isy",
                "NRP" => 89757,
                "JABATAN" => "Satkom/Juru Isy",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Muliyono",
                "PANGKAT_KORPS" => "Kopka Keu",
                "NRP" => 89924,
                "JABATAN" => "Akun/PPSPM/Ur Yar(BP) Ur Yar 3",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yulianto",
                "PANGKAT_KORPS" => "KopkaTtg",
                "NRP" => 89966,
                "JABATAN" => "Kal TBA/Juru Masak",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sigit Waliadi",
                "PANGKAT_KORPS" => "Kopka Pum",
                "NRP" => 90661,
                "JABATAN" => "Satkom/Juru Kom 3",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Subhan Supriyanto",
                "PANGKAT_KORPS" => "Kopka Bah",
                "NRP" => 92120,
                "JABATAN" => "Satma/Pengemudi Dan",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Supriyadi",
                "PANGKAT_KORPS" => "Kopka Ttu",
                "NRP" => 92477,
                "JABATAN" => "Kal Tabuan/Juru Pantry",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Aan Sumantri",
                "PANGKAT_KORPS" => "Kopka Jas",
                "NRP" => 93399,
                "JABATAN" => "Pos TNI AL Blimbingsari/Ur.Opskamla 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Nono Suryadi",
                "PANGKAT_KORPS" => "Kopka Lis",
                "NRP" => 95477,
                "JABATAN" => "Kal RJW/Juru Distlis Dep Sin",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Budi Setyo",
                "PANGKAT_KORPS" => "Kopka Mes",
                "NRP" => 94559,
                "JABATAN" => "Patkamla Mus/Juru Bah",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sugeng Riadi",
                "PANGKAT_KORPS" => "Kopka Mes",
                "NRP" => 94555,
                "JABATAN" => "Ur.Harranmor-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hendra Yunus K",
                "PANGKAT_KORPS" => "Kopka Mer",
                "NRP" => 95187,
                "JABATAN" => "Posal Muncar/Caraka",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Misnarun",
                "PANGKAT_KORPS" => "Kopka Mes",
                "NRP" => 96842,
                "JABATAN" => "Kal TBA/Juru Mesin-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Wahyudiono",
                "PANGKAT_KORPS" => "Kopka Mes",
                "NRP" => 96935,
                "JABATAN" => "Kal RJW/Juru Mes 2 Dep Sin",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sadiarto",
                "PANGKAT_KORPS" => "Kopka Ttu",
                "NRP" => 97110,
                "JABATAN" => "Satma/PD Mess Pakis 1/Ur Mess 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sayis Wardani",
                "PANGKAT_KORPS" => "Kopka Ttu",
                "NRP" => 100349,
                "JABATAN" => "Akun/PPSPM/Ur Yar(BP) Ur Yar 4",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ahmad Zaenulloh",
                "PANGKAT_KORPS" => "Kopka Ttu",
                "NRP" => 101295,
                "JABATAN" => "Spotmar/Ur. Sbj",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Rudi Hartono",
                "PANGKAT_KORPS" => "Kopka Ttu",
                "NRP" => 101313,
                "JABATAN" => "Spotmar/Binpuan/Ur Diklat",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Basri",
                "PANGKAT_KORPS" => "Koptu Nav",
                "NRP" => 87158,
                "JABATAN" => "Satma/Anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Budiono",
                "PANGKAT_KORPS" => "Koptu Mer",
                "NRP" => 92918,
                "JABATAN" => "Satma/Ur.Mess",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Sulistiono",
                "PANGKAT_KORPS" => "Koptu Nav",
                "NRP" => 99533,
                "JABATAN" => "Posal Puger/Ur.Opskamla 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Agus Yunianto",
                "PANGKAT_KORPS" => "Koptu Ttu",
                "NRP" => 105787,
                "JABATAN" => "Kal RJW/Jr.Komandemen",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Mintri Budi S",
                "PANGKAT_KORPS" => "Koptu Bah",
                "NRP" => 102994,
                "JABATAN" => "Satma/Ur. Jaga",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hadi Siswoyo",
                "PANGKAT_KORPS" => "Koptu Tlg",
                "NRP" => 103648,
                "JABATAN" => "Set/Caraka Dan",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ainur Rohman",
                "PANGKAT_KORPS" => "Koptu Isy",
                "NRP" => 103649,
                "JABATAN" => "Pos TNI AL Paiton/Juru Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Muhammad Saleh",
                "PANGKAT_KORPS" => "Koptu Tlg",
                "NRP" => 103650,
                "JABATAN" => "Posal Pancer/Jr.Kom",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Doni Kurniawan",
                "PANGKAT_KORPS" => "Koptu Jas",
                "NRP" => 106489,
                "JABATAN" => "Satma/Ur. Tu",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Andi Arista",
                "PANGKAT_KORPS" => "Koptu Mes",
                "NRP" => 109255,
                "JABATAN" => "Kal Mustaka/Juru Mesin-2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Didit Sektiawan",
                "PANGKAT_KORPS" => "Koptu Jas",
                "NRP" => 110080,
                "JABATAN" => "Ur Minpers/Ur. Persmil",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hundory Muhammad",
                "PANGKAT_KORPS" => "Koptu Bek",
                "NRP" => 110693,
                "JABATAN" => "Satbek/Ur.Bekca",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Farid Indrayanto",
                "PANGKAT_KORPS" => "Koptu Mus",
                "NRP" => 111330,
                "JABATAN" => "Posal Paiton/Caraka",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Erfendi",
                "PANGKAT_KORPS" => "Kopda Jas",
                "NRP" => 98044,
                "JABATAN" => "Minlog/ur.Log",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Fadris Salam",
                "PANGKAT_KORPS" => "Kopda Apk",
                "NRP" => 109221,
                "JABATAN" => "BP/Ur. Kamar Suntik/Balut",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Herman Purwono",
                "PANGKAT_KORPS" => "Kopda Apk",
                "NRP" => 113540,
                "JABATAN" => "BP/Ur.Laborat",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Hasanudin",
                "PANGKAT_KORPS" => "Kopda Ttu",
                "NRP" => 111731,
                "JABATAN" => "Set/Ur.Telegram",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Maryono",
                "PANGKAT_KORPS" => "Kopda Isy",
                "NRP" => 115384,
                "JABATAN" => "Kal RJW/Juru Telegrafis",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yasin Latif",
                "PANGKAT_KORPS" => "Kopda Rdl",
                "NRP" => 111562,
                "JABATAN" => "Posal Paiton/Ur.Opskamla 2",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Phasky Laksana s",
                "PANGKAT_KORPS" => "KopdaTlg",
                "NRP" => 115307,
                "JABATAN" => "Satma/anggota",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Prastyo",
                "PANGKAT_KORPS" => "Kopda Eta",
                "NRP" => 115638,
                "JABATAN" => "Kal RJW/Juru Bahari",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Faris Aulia Indrawan",
                "PANGKAT_KORPS" => "Kopda Mes",
                "NRP" => 116601,
                "JABATAN" => "KAL TBA/Jr. Lis",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Toni Tri Purwanto",
                "PANGKAT_KORPS" => "Kopda Ttu",
                "NRP" => 116687,
                "JABATAN" => "KAL TBA/Jr. Komandemen",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Fajar Purwanto",
                "PANGKAT_KORPS" => "Klk Pom",
                "NRP" => 117892,
                "JABATAN" => "Denpomal/Ur.Babuk",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Adi Priyanto",
                "PANGKAT_KORPS" => "Klk Pom",
                "NRP" => 119160,
                "JABATAN" => "Denpomal/Ur.Hartib/Ur Walmor",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Ahmad Fawaid",
                "PANGKAT_KORPS" => "Klk Pom",
                "NRP" => 119993,
                "JABATAN" => "Denpomal/Laka/Ur. Hartib",
                'jenis_kelamin' => 'L'
            ]
        );
        PersonilModel::create(
            [
                "nama_lengkap" => "Yogo Febri Romadhoni",
                "PANGKAT_KORPS" => "Kls Mes",
                "NRP" => 123522,
                "JABATAN" => "Kal RJW/Juru motor bantu Dep Sin",
                'jenis_kelamin' => 'L'
            ]
        );
    }
}
