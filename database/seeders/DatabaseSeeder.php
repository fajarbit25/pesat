<?php

namespace Database\Seeders;

use App\Models\EggSupplier;
use App\Models\HutangPlasma;
use App\Models\MedicCat;
use App\Models\Medicine;
use App\Models\MedicPackaging;
use App\Models\MedicSupplier;
use App\Models\MedicUnit;
use App\Models\Store;
use App\Models\User;
use App\Models\UserLevel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Store::create([
            'storename'     => 'CV. ASYLA TERNAK',
            'slogan'        => 'Distributor Obat dan Pakan Ternak',
            'owner'         => '2',
            'logo'          => 'favicon.png',
            'shopaddress'   => 'Sidenreng Rappang',
            'norek'         => 'BCA 0000000000',
        ]);
        User::create([
            'name'      => 'Administrator',
            'email'     => 'admin@gmail.com',
            'level'     => 1,
            'img'       => 'user.png',
            'password'  => Hash::make('admin123'),
            'phone'     => '0895330078691',
            'norek'     => 'BCA 0000000000',
            'address'   => 'Makassar'
        ]);

        User::create([
            'name'      => 'Asyla Ternak',
            'email'     => 'asylaternak@gmail.com',
            'level'     => 1,
            'img'       => 'user.png',
            'password'  => Hash::make('admin123'),
            'phone'     => '0895330078692',
            'norek'     => 'BRI 12345678911',
            'address'   => 'Makassar'
        ]);

        User::create([
            'name'      => 'Amrul Ikhwan',
            'email'     => 'supplier@gmail.com',
            'level'     => 3,
            'img'       => 'user.png',
            'password'  => Hash::make('admin123'),
            'phone'     => '0895330078693',
            'norek'     => 'BNI 123456789',
            'address'   => 'Makassar'
        ]);

        $users = [
            ['name' => 'Asyila', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Afika', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Ambo', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Ancing', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Andi', 'address' => 'Malino', 'level' => '3'],
            ['name' => 'Bpk Ali', 'address' => 'Kampung Baru', 'level' => '3'],
            ['name' => 'Bpk Danil', 'address' => 'Kampung Baru', 'level' => '3'],
            ['name' => 'Bpk Ifa', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Bpk Ippang', 'address' => 'Sagona', 'level' => '3'],
            ['name' => 'Bpk Nur', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'Mama Ully', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Bpk Ramma', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Bpk Rina', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Bpk Eni', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'Bpk Diba', 'address' => 'Sagona', 'level' => '3'],
            ['name' => 'Bpk Accung', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Bpk Karang', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Bpk Sabir', 'address' => 'Wasing', 'level' => '3'],
            ['name' => 'Bpk Fahmi', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Bpk Gina', 'address' => 'Paccini', 'level' => '3'],
            ['name' => 'Bpk Dendi', 'address' => 'Jln. Sarru', 'level' => '3'],
            ['name' => 'Basiri', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Batong', 'address' => 'Kampo Baru', 'level' => '3'],
            ['name' => 'Cammang', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Citong', 'address' => 'Wasing', 'level' => '3'],
            ['name' => 'Cambang', 'address' => 'Kampo Baru', 'level' => '3'],
            ['name' => 'Dimang', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Dising', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Ence', 'address' => 'Jln. Sarru', 'level' => '3'],
            ['name' => 'Hikmal', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Hariadi', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Hima', 'address' => 'Kampo Baru', 'level' => '3'],
            ['name' => 'Husna', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Iwang', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Ida', 'address' => 'Bolli', 'level' => '3'],
            ['name' => 'Jumbi', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'Jamal', 'address' => 'Kampo Baru', 'level' => '3'],
            ['name' => 'Juliani', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'Kato', 'address' => 'Jln. Sarru', 'level' => '3'],
            ['name' => 'Muslimin', 'address' => 'Malino', 'level' => '3'],
            ['name' => 'Maslan', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'P. Nunu', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Paisal', 'address' => 'Labungga', 'level' => '3'],
            ['name' => 'puang Nusi', 'address' => 'Wasing', 'level' => '3'],
            ['name' => 'Pak Wahab', 'address' => 'Bolli', 'level' => '3'],
            ['name' => 'Pak Supri', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Sarika', 'address' => 'Jln. Sarru', 'level' => '3'],
            ['name' => 'Saman', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'Sada', 'address' => 'Galatiri', 'level' => '3'],
            ['name' => 'Sari', 'address' => 'Sagona', 'level' => '3'],
            ['name' => 'Ully', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Uwa', 'address' => 'Puncak Harapan', 'level' => '3'],
            ['name' => 'Wa\'Nummi', 'address' => 'Wasing', 'level' => '3'],
            ['name' => 'Yusuf', 'address' => 'Kampo Baru', 'level' => '3'],
            ['name' => 'SADITA', 'address' => 'BTB', 'level'    => '4'],// Suplier
            ['name' => 'MEDION', 'address' => 'PUNCAK', 'level' => '4'],
            ['name' => 'MSF', 'address' => 'RAPPANG', 'level'   => '4'],
            ['name' => 'AJS', 'address' => 'RAPPANG', 'level'   => '4'],
            ['name' => 'H. ASRUL', 'address' => 'PUNCAK', 'level'   => '4'],
            ['name' => 'H. USMAN', 'address' => 'MARIO', 'level'    => '4'],
            ['name' => 'H. SYAHRUDDIN', 'address' => 'KADIDI', 'level'  => '4'],
            ['name' => 'ADILLA (Rak)', 'address' => 'BARANTI', 'level'  => '4'],
            ['name' => 'MBM (Rak)', 'address' => 'KULO', 'level'    => '4'],
            ['name' => 'CPL (Rak)', 'address' => 'PINRANG', 'level' => '4'],
            ['name' => 'ISKANDAR', 'address' => 'MATAKALI', 'level' => '4'],
            ['name' => 'JULIADI', 'address' => 'ENREKANG', 'level'  => '4'],
            ['name' => 'P. ILENG', 'address' => 'MALINO', 'level'   => '4'],
            ['name' => 'ANSAR', 'address' => 'ENREKANG', 'level'    => '4'],
            ['name' => 'BARODDING', 'address' => 'MARIO', 'level'   => '4'],
            ['name' => 'DASANG', 'address' => 'MATAKALI', 'level'   => '4'],
            ['name' => 'MUHLIS', 'address' => '', 'level'   => '4'],
            ['name' => 'JUSMAN', 'address' => 'LEBANI', 'level' => '4'],
            ['name' => 'H. BAHAR', 'address' => 'RAPPANG', 'level'  => '4'],
            ['name' => 'SARIFUDDIN', 'address' => 'MATAKALI', 'level'   => '4'],
            ['name' => 'ARMAN', 'address' => 'RAPPANG', 'level' => '4'],
            ['name' => 'HARLIA', 'address' => '', 'level'   => '4'],
            ['name' => 'H. IWAN', 'address' => 'MAROANGIN', 'level' => '4'],
            ['name' => 'SUPRIADI', 'address' => 'LEBANI', 'level'   => '4'],
            ['name' => 'DARWAN', 'address' => 'ENREKANG', 'level'   => '4'],
            ['name' => 'DARAWATI', 'address' => 'LEBANI', 'level'   => '4'],
            ['name' => 'DIANA', 'address' => 'ENREKANG', 'level'    => '4'],
        ];
    
        foreach ($users as $user) {
            $dataUser = User::create([
                'name'      => $user['name'],
                'email'     => strtolower(str_replace(' ', '_', $user['name'])) . '@gmail.com', // Generating fake email
                'level'     => $user['level'],
                'img'       => 'user.png',
                'password'  => Hash::make('admin123'),
                'phone'     => '085000000000', // Replace with unique phone numbers if needed
                'norek'     => 'MANDIRI 0000000000', // Replace with unique bank account if needed
                'address'   => $user['address']
            ]);

            HutangPlasma::create([
                'user_id'   => $dataUser->id,
                'hutang'    => 0,
            ]);
        }

        UserLevel::create(['level' => 'Administrator', 'divisi' => 'Owner']);
        UserLevel::create(['level' => 'Kasir', 'divisi' => 'Staff']);
        UserLevel::create(['level' => 'Costumer', 'divisi' => 'Mitra']);
        UserLevel::create(['level' => 'Supplier', 'divisi' => 'Mitra']);
        UserLevel::create(['level' => 'Buyer', 'divisi' => 'Mitra']);
        UserLevel::create(['level' => 'Buruh', 'divisi' => 'Staff']);

        MedicCat::create(['category'  => 'Desinfetan', 'code' => 'DES']);
        MedicCat::create(['category'  => 'Obat', 'code' => 'OBT']);
        MedicCat::create(['category'  => 'Obat Herbal', 'code' => 'OBH']);
        MedicCat::create(['category'  => 'Obat Injet', 'code' => 'OBI']);
        MedicCat::create(['category'  => 'Premix', 'code' => 'PMX']);
        MedicCat::create(['category'  => 'Vaksin', 'code' => 'VKS']);
        MedicCat::create(['category'  => 'Lainnya', 'code' => 'OTH']);

        MedicUnit::create(['unit' => 'gr']);
        MedicUnit::create(['unit' => 'kg']);
        MedicUnit::create(['unit' => 'L']);
        MedicUnit::create(['unit' => 'Viall']);
        MedicUnit::create(['unit' => 'Ml']);
        MedicUnit::create(['unit' => 'Kps']);
        MedicUnit::create(['unit' => 'Pcs']);
    

        MedicPackaging::create(['packaging' => 'Pcs']);
        MedicPackaging::create(['packaging' => 'Botol']);
        MedicPackaging::create(['packaging' => 'Bungkus']);
        MedicPackaging::create(['packaging' => 'Viall']);
        MedicPackaging::create(['packaging' => 'Zak']);
        MedicPackaging::create(['packaging' => 'Cup']);

        $products = [
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Cipruxan 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '60'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Levantel 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '60'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Larvanol 1 kg', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '2', 'sup' => '60'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Restac Plus 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '60'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'L Spec 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '60'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Vaksimune Coryzale Plus 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '61'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Vaksimune Coryzale Plus 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '61'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Vaksimune Al Multi H5+Hg 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '61'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Vaksimune Al Multi H5+Hg 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '61'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Erytrogin HC 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '61'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Cyprotytogrin 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '61'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Desgrin 1 Liter', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '3', 'sup' => '61'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Vaksimune ND Clone 1B+D4 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '61'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.IB 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.IB 500 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.Ctone 45 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Gumboro 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Gumboro 500 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.Lasota 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.Lasota 500 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ILT 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ILT 500 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'M.Pox 1.000 DS 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'M.Pox 500 Ds 1 Viall', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Coryza T 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'Coryza T 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.EDS IB 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.EDS IB 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.A1 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.A1 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'AI.H5N1/H9N2 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'AI.H5N1/H9N2 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.67.IB Variant 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.67.IB Variant 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'ND.Emulsion 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Egg Stimulan 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Tetra Chort 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Gentamin 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Tinotin 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Medimilk 100 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Kututox 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Tetra Kaps 300 kps', 'jenis' => 'obat', 'cat' => '6', 'unit' => '2', 'packaging'  => '6', 'sup' => '59'],
            ['kode' => 'OTH'.rand(1111, 9999), 'name' => 'Jarum pcs', 'jenis' => 'obat', 'cat' => '1', 'unit' => '7', 'packaging'  => '7', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Vermixon 1 Liter', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '3', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Interpectin 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'DES'.rand(1111, 9999), 'name' => 'Destan 1 Liter', 'jenis' => 'obat', 'cat' => '2', 'unit' => '1', 'packaging'  => '3', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Vitsel NJ 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Vita Chiks 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Bestrim 1 Liter', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '3', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Larvatux 1 kg', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '2', 'sup' => '59'],
            ['kode' => 'DES'.rand(1111, 9999), 'name' => 'Antisep 1 Liter', 'jenis' => 'obat', 'cat' => '2', 'unit' => '1', 'packaging'  => '3', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Koleridin 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Meduxi T-N 250 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Ductril 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Fortofit 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'B.Kom 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Vetstrcp 125 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'Triminzi 250 gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '59'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.LS / H120@1000DS', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'STREPTOMYCIN @100 GRAM', 'jenis' => 'obat', 'cat' => '3', 'unit' => '4', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'SPEC-L 100 Ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OTH'.rand(1111, 9999), 'name' => 'AQUADEST @500ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '7', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA CYPROTIL @250 Gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA TORTIL-25 @ 1 L*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '3', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.AI PLUS @500 ML (1000Ds)', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DOXYTHRO @250 GR*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'NOCOLD SUPER @ 250Gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'KOLERIN @ 250 GR*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'ENROVIT PLUS @ 250 GR', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'EGG PRO BR 10: 10 @ 250gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'AMPROXAL @ 250gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'TRIMEDIAZ @250 Gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA THERAPIX @250 GR*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA FLOXA @ 250 Gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'NOSTRESS @ 250gr', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'B COMPLEX Kemasan 500 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'SUPERVIT BR 30:6 (1:6)  @ 250GR*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA SORBITOL PLUS @ 1 L*', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '3', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CEVAC CORYZA ABC GEL', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.CLONE/H120@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.GUMBORO@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.POX@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'DES'.rand(1111, 9999), 'name' => 'DITADINE @ 1 L*', 'jenis' => 'obat', 'cat' => '2', 'unit' => '1', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA SEL E 120 @ 1 L*', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'SANAVAC ND AI @500ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'VETRIMOXIN L.A @ 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.ND K@500ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CEVAC GUMBO L_1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CEVAC NB L@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.ND IB K 1000DS', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CEVAC CORYMUNE 4 K', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'LARVACID 1% @1KG', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '2', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA CURMINO @ 250gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA TORTIL-25 @ 100ml*', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'CLOVAMID @ 250gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'AMOXY 20% INJ @ 100ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA TYLO @250 Gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'TOXIBLOCK @25KG ((BITOX)', 'jenis' => 'obat', 'cat' => '5', 'unit' => '2', 'packaging'  => '2', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'SODIUM SELENITE VIT E INJ @ 100 ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CEVAC CORYMUNE 7 K', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITAQUA @ 20ltr', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '3', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'DITA CURMINO @ 250gr*', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'AMOXY LA 150 INJ @ 100 ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'S.ND IB K 1000DS', 'jenis' => 'obat', 'cat' => '2', 'unit' => '2', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'PMX'.rand(1111, 9999), 'name' => 'DITAMIX FS @ 25 KG', 'jenis' => 'obat', 'cat' => '5', 'unit' => '5', 'packaging'  => '2', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.ND AI @500ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'AMOX + ERY @ 100 GRAM', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'VETRIMOXIN L.A @ 100 ml', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'OXYTHRO @250GR', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'DES'.rand(1111, 9999), 'name' => 'VIROBLOCK @ 1ltr*', 'jenis' => 'obat', 'cat' => '2', 'unit' => '1', 'packaging'  => '3', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.ILT@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'OBH'.rand(1111, 9999), 'name' => 'BOOSTER PRO @250ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '3', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'VAIOL VAC (FOX)@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'OBT'.rand(1111, 9999), 'name' => 'AMOXTRO @250 Gr *', 'jenis' => 'obat', 'cat' => '3', 'unit' => '2', 'packaging'  => '1', 'sup' => '58'],
            ['kode' => 'OBI'.rand(1111, 9999), 'name' => 'SPECTOLINE 150 INJ @ 100 ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '4', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'BIOVAC LS-H120@1000DS', 'jenis' => 'obat', 'cat' => '4', 'unit' => '6', 'packaging'  => '4', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'VAKSIN INAKTIF ND AI 5.1@1000DS', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'CAPRIVAC ND AI-K SK2@1000DS', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'VKS'.rand(1111, 9999), 'name' => 'S.AI Plus H9 1000ds @ 500ML', 'jenis' => 'obat', 'cat' => '2', 'unit' => '6', 'packaging'  => '5', 'sup' => '58'],
            ['kode' => 'PELUNASAN', 'name' => 'PELUNASAN', 'jenis' => 'obat', 'cat' => '0', 'unit' => '0', 'packaging'  => '0', 'sup' => '0'],
        ];

        foreach ($products as $produk) {
            Medicine::create([
                'code'          => $produk['kode'],
                'name'          => strtoupper($produk['name']),
                'jenis'         => 'obat',
                'cat'           => $produk['cat'],
                'unit'          => $produk['unit'],
                'packaging'     => $produk['packaging'],
                'stock'         => 0,
                'price'         => 0,
                'sellingprice'  => 0,
                'supplier'      => $produk['sup']    
            ]);
        }

    }
}