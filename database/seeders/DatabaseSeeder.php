<?php

namespace Database\Seeders;

use App\Models\EggSupplier;
use App\Models\HutangPlasma;
use App\Models\MedicCat;
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
            'email'     => 'asyla@gmail.com',
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

        MedicCat::create(['category'  => 'Antibiotik', 'code' => 'ABK']);
        MedicCat::create(['category'  => 'Vitamin', 'code' => 'VIT']);

        MedicUnit::create(['unit' => '100 Gr']);
        MedicUnit::create(['unit' => '125 Gr']);
        MedicUnit::create(['unit' => '250 Gr']);
        MedicUnit::create(['unit' => '1 Kg']);
        MedicUnit::create(['unit' => '25 Kg']);
        MedicUnit::create(['unit' => '30 Kg']);

        MedicPackaging::create(['packaging' => 'Pcs']);
        MedicPackaging::create(['packaging' => 'Botol']);
        MedicPackaging::create(['packaging' => 'Bungkus']);
        MedicPackaging::create(['packaging' => 'Viall']);
        MedicPackaging::create(['packaging' => 'Zak']);
        MedicPackaging::create(['packaging' => 'Cup']);
    }
}