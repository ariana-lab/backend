<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    
    public function index()
    {
        $animes = Anime::all();
        return response()->json($animes);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'studio' => 'required|string|max:255',
            'genres' => 'required|array',
            'hype' => 'required|integer',
            'description' => 'required|string',
            'title' => 'required|string|max:255',
            'image' => 'required|string|max:255',
            'link' => 'nullable|string|max:255',
        ]);

        $anime = Anime::create($validated);
        return response()->json($anime, 201);
    }

    public function importFromJson()
    {
        $jsonPath = database_path('data/data.json');
        $jsonData = json_decode(file_get_contents($jsonPath), true);

        foreach ($jsonData as $animeData) {
            $title = is_array($animeData['title']) ? $animeData['title']['text'] : $animeData['title'];
            $startDate = Carbon::parse($animeData['start_date'])->format('Y-m-d H:i:s');

            Anime::create([
                'title' => $title,
                'start_date' => $startDate,
                'studio' => $animeData['studio'],
                'genres' => json_encode($animeData['genres']),
                'description' => $animeData['description'],
                'hype' => $animeData['hype'],
                'image' => $animeData['image']
            ]);
        }

        return response()->json(['message' => 'Animes imported successfully'], 200);
    }


    public function show($id)
    {
        $anime = Anime::findOrFail($id);
        return response()->json($anime);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'studio' => 'required|string|max:255',
        'genres' => 'required|array',
        'hype' => 'required|integer',
        'description' => 'required|string',
        'title' => 'required|string|max:255',
        'link' => 'nullable|url',
        'start_date' => 'nullable|date',
        'image' => 'nullable|url',
    ]);

    if ($request->has('start_date')) {
        $request->merge([
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d')
        ]);
    }

    $anime = Anime::findOrFail($id);
    $anime->update($request->all());
    return response()->json($anime);
}

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        $anime->delete();
        return response()->json(['message' => 'Anime deleted successfully']);
    }
}