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

        // Crear un nuevo anime en la base de datos
        $anime = Anime::create($validated);

        // Retornar el anime recién creado
        return response()->json($anime, 201);
    }


    /**
     * Import animes from JSON file
     */
    public function importFromJson()
    {
        try {
            $jsonPath = database_path('data/dataa.json');
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
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified anime
     */
    public function show($id)
    {
        try {
            $anime = Anime::findOrFail($id);
            return response()->json($anime);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Anime not found'], 404);
        }
    }

    /**
     * Update the specified anime
     */
    public function update(Request $request, $id)
{
    try {
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

        // Si la fecha es válida, la formateas antes de guardarla
        if ($request->has('start_date')) {
            $request->merge([
                'start_date' => Carbon::parse($request->start_date)->format('Y-m-d')
            ]);
        }

        $anime = Anime::findOrFail($id);
        $anime->update($request->all());

        return response()->json($anime);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    /**
     * Remove the specified anime
     */
    public function destroy($id)
    {
        try {
            $anime = Anime::findOrFail($id);
            $anime->delete();
            return response()->json(['message' => 'Anime deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Anime not found'], 404);
        }
    }
}