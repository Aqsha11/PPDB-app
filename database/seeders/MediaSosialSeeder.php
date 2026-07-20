<?php

namespace Database\Seeders;

use App\Models\MediaSosial;
use Illuminate\Database\Seeder;

class MediaSosialSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['platform' => 'WhatsApp',  'icon' => 'fab fa-whatsapp',    'urutan' => 1],
            ['platform' => 'Instagram', 'icon' => 'fab fa-instagram',   'urutan' => 2],
            ['platform' => 'Facebook',  'icon' => 'fab fa-facebook-f',  'urutan' => 3],
            ['platform' => 'YouTube',   'icon' => 'fab fa-youtube',     'urutan' => 4],
            ['platform' => 'TikTok',    'icon' => 'fab fa-tiktok',      'urutan' => 5],
            ['platform' => 'Twitter/X', 'icon' => 'fab fa-x-twitter',   'urutan' => 6],
        ];

        foreach ($platforms as $data) {
            MediaSosial::updateOrCreate(
                ['platform' => $data['platform']],
                [
                    'icon'   => $data['icon'],
                    'url'    => '',
                    'urutan' => $data['urutan'],
                    'status' => false,
                ]
            );
        }
    }
}
