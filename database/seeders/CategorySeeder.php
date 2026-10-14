<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fasilitas dan Teknologi',
                'description' => 'Pengaduan terkait fasilitas fisik dan teknologi kampus.',
            ],
            [
                'name' => 'Pelayanan Administrasi',
                'description' => 'Pengaduan terkait pelayanan administrasi mahasiswa.',
            ],
            [
                'name' => 'Akademik dan Perkuliahan',
                'description' => 'Pengaduan terkait kegiatan dan layanan akademik.',
            ],
            [
                'name' => 'Kebersihan dan Lingkungan',
                'description' => 'Pengaduan terkait kebersihan dan lingkungan kampus.',
            ],
            [
                'name' => 'Keamanan dan Ketertiban',
                'description' => 'Pengaduan terkait keamanan dan ketertiban kampus.',
            ],
            [
                'name' => 'Lainnya',
                'description' => 'Pengaduan yang tidak termasuk kategori lainnya.',
            ],

        ];

        foreach ($categories as $category) {
            DB::table('categories')->updateOrInsert(
                ['name' => $category['name']],
                array_merge($category, [
                    'created_at' => now(), 
                    'updated_at' => now(),
                    ])
            );
        }
    }
}
