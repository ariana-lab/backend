<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Anime;

class AnimeSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents(database_path('data/data.json'));
        $animes = json_decode($json, true);

        foreach ($animes as $anime) {
            DB::table('animes')->insert([
                'title' => $anime['title']['text'], 
                'link' => $anime['title']['link'], 
                'start_date' => Carbon::parse($anime['start_date'])->format('Y-m-d H:i:s'), 
                'studio' => $anime['studio'],
                'genres' => json_encode($anime['genres']), 
                'description' => $anime['description'],
                'hype' => $anime['hype'],
                'image' => $anime['image'],
            ]);
        }
               
    }
}


