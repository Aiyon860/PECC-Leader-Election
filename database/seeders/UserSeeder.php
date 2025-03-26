<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->importUsersFromCsv();
    }

    /**
     * Import users from CSV file
     */
    private function importUsersFromCsv(): void
    {
        // Path ke file CSV (simpan di storage/app/csv/users.csv)
        $csvPath = storage_path('app/csv/users.csv');
        
        // Pastikan file ada
        if (!File::exists($csvPath)) {
            $this->command->error("File CSV tidak ditemukan di: $csvPath");
            return;
        }

        // Baca file CSV
        $csvFile = fopen($csvPath, 'r');
        
        // Baca header
        $header = fgetcsv($csvFile);
        
        // Loop setiap baris
        while (($row = fgetcsv($csvFile)) !== FALSE) {
            // Buat array associative dari header dan row values
            $data = array_combine($header, $row);
            
            // Buat user baru
            $user = User::create([
                'name' => $data['name'],
                'nim' => $data['nim'],
                'password' => Hash::make($data['password']), // Hashing password
                'status' => $data['status'] ?? 'Belum', // Default 'Belum' jika tidak ada
                'remember_token' => Str::random(10),
            ]);
            
            // Assign role (contoh: assign semua sebagai voter)
            // Anda bisa menambahkan kolom 'role' di CSV untuk menentukan role
            if (isset($data['role'])) {
                $user->assignRole($data['role']);
            } else {
                $user->assignRole('voter'); // Default role
            }
        }
        
        fclose($csvFile);
        
        // Tampilkan pesan sukses jika menggunakan artisan command
        if (isset($this->command)) {
            $this->command->info('Import users dari CSV berhasil');
        }
    }
}
