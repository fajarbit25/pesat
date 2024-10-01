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
            ['name' => 'Asyila', 'address' => 'Puncak Harapan'],
            ['name' => 'Afika', 'address' => 'Puncak Harapan'],
            ['name' => 'Ambo', 'address' => 'Puncak Harapan'],
            ['name' => 'Ancing', 'address' => 'Puncak Harapan'],
            ['name' => 'Andi', 'address' => 'Malino'],
            ['name' => 'Bpk Ali', 'address' => 'Kampung Baru'],
            ['name' => 'Bpk Danil', 'address' => 'Kampung Baru'],
            ['name' => 'Bpk Ifa', 'address' => 'Puncak Harapan'],
            ['name' => 'Bpk Ippang', 'address' => 'Sagona'],
            ['name' => 'Bpk Nur', 'address' => 'Galatiri'],
            ['name' => 'Mama Ully', 'address' => 'Puncak Harapan'],
            ['name' => 'Bpk Ramma', 'address' => 'Puncak Harapan'],
            ['name' => 'Bpk Rina', 'address' => 'Puncak Harapan'],
            ['name' => 'Bpk Eni', 'address' => 'Galatiri'],
            ['name' => 'Bpk Diba', 'address' => 'Sagona'],
            ['name' => 'Bpk Accung', 'address' => 'Puncak Harapan'],
            ['name' => 'Bpk Karang', 'address' => 'Labungga'],
            ['name' => 'Bpk Sabir', 'address' => 'Wasing'],
            ['name' => 'Bpk Fahmi', 'address' => 'Labungga'],
            ['name' => 'Bpk Gina', 'address' => 'Paccini'],
            ['name' => 'Bpk Dendi', 'address' => 'Jln. Sarru'],
            ['name' => 'Basiri', 'address' => 'Labungga'],
            ['name' => 'Batong', 'address' => 'Kampo Baru'],
            ['name' => 'Cammang', 'address' => 'Labungga'],
            ['name' => 'Citong', 'address' => 'Wasing'],
            ['name' => 'Cambang', 'address' => 'Kampo Baru'],
            ['name' => 'Dimang', 'address' => 'Labungga'],
            ['name' => 'Dising', 'address' => 'Labungga'],
            ['name' => 'Ence', 'address' => 'Jln. Sarru'],
            ['name' => 'Hikmal', 'address' => 'Puncak Harapan'],
            ['name' => 'Hariadi', 'address' => 'Labungga'],
            ['name' => 'Hima', 'address' => 'Kampo Baru'],
            ['name' => 'Husna', 'address' => 'Puncak Harapan'],
            ['name' => 'Iwang', 'address' => 'Puncak Harapan'],
            ['name' => 'Ida', 'address' => 'Bolli'],
            ['name' => 'Jumbi', 'address' => 'Galatiri'],
            ['name' => 'Jamal', 'address' => 'Kampo Baru'],
            ['name' => 'Juliani', 'address' => 'Labungga'],
            ['name' => 'Kato', 'address' => 'Jln. Sarru'],
            ['name' => 'Muslimin', 'address' => 'Malino'],
            ['name' => 'Maslan', 'address' => 'Galatiri'],
            ['name' => 'P. Nunu', 'address' => 'Puncak Harapan'],
            ['name' => 'Paisal', 'address' => 'Labungga'],
            ['name' => 'puang Nusi', 'address' => 'Wasing'],
            ['name' => 'Pak Wahab', 'address' => 'Bolli'],
            ['name' => 'Pak Supri', 'address' => 'Puncak Harapan'],
            ['name' => 'Sarika', 'address' => 'Jln. Sarru'],
            ['name' => 'Saman', 'address' => 'Galatiri'],
            ['name' => 'Sada', 'address' => 'Galatiri'],
            ['name' => 'Sari', 'address' => 'Sagona'],
            ['name' => 'Ully', 'address' => 'Puncak Harapan'],
            ['name' => 'Uwa', 'address' => 'Puncak Harapan'],
            ['name' => 'Wa\'Nummi', 'address' => 'Wasing'],
            ['name' => 'Yusuf', 'address' => 'Kampo Baru'],
            ['name' => 'SADITA', 'address' => 'BTB'],
            ['name' => 'MEDION', 'address' => 'PUNCAK'],
            ['name' => 'MSF', 'address' => 'RAPPANG'],
            ['name' => 'AJS', 'address' => 'RAPPANG'],
            ['name' => 'H. ASRUL', 'address' => 'PUNCAK'],
            ['name' => 'H. USMAN', 'address' => 'MARIO'],
            ['name' => 'H. SYAHRUDDIN', 'address' => 'KADIDI'],
            ['name' => 'ADILLA (Rak)', 'address' => 'BARANTI'],
            ['name' => 'MBM (Rak)', 'address' => 'KULO'],
            ['name' => 'CPL (Rak)', 'address' => 'PINRANG'],
            ['name' => 'ISKANDAR', 'address' => 'MATAKALI'],
            ['name' => 'JULIADI', 'address' => 'ENREKANG'],
            ['name' => 'P. ILENG', 'address' => 'MALINO'],
            ['name' => 'ANSAR', 'address' => 'ENREKANG'],
            ['name' => 'BARODDING', 'address' => 'MARIO'],
            ['name' => 'DASANG', 'address' => 'MATAKALI'],
            ['name' => 'MUHLIS', 'address' => ''],
            ['name' => 'JUSMAN', 'address' => 'LEBANI'],
            ['name' => 'H. BAHAR', 'address' => 'RAPPANG'],
            ['name' => 'SARIFUDDIN', 'address' => 'MATAKALI'],
            ['name' => 'ARMAN', 'address' => 'RAPPANG'],
            ['name' => 'HARLIA', 'address' => ''],
            ['name' => 'H. IWAN', 'address' => 'MAROANGIN'],
            ['name' => 'SUPRIADI', 'address' => 'LEBANI'],
            ['name' => 'DARWAN', 'address' => 'ENREKANG'],
            ['name' => 'DARAWATI', 'address' => 'LEBANI'],
            ['name' => 'DIANA', 'address' => 'ENREKANG'],
        ];
    
        foreach ($users as $user) {
            $dataUser = User::create([
                'name'      => $user['name'],
                'email'     => strtolower(str_replace(' ', '_', $user['name'])) . '@gmail.com', // Generating fake email
                'level'     => 3,
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