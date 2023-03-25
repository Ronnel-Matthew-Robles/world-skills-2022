<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;

class GameController extends Controller
{
    public function index(Request $request)
    {
        // get query parameters
        $page = $request->input('page', 0);
        $size = $request->input('size', 10);
        $sortBy = $request->input('sortBy', 'name');
        $sortDir = $request->input('sortDir', 'asc');

        // validate query parameters
        $size = max(1, $size);

        // build query
        $query = Game::withCount('scores')->orderBy($sortBy, $sortDir);

        // get paginated results
        $games = $query->paginate($size, ['*'], 'page', $page);

        // return response
        return response()->json([
            'content' => $games->items(),
            'page' => $games->currentPage(),
            'size' => $games->perPage(),
            // 'totalPages' => $games->lastPage(),
            'totalElements' => $games->total()
        ]);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title'=>'required|min:3|max:60',
            'description'=>'required|min:0|max:200'
        ]);

        // check if game title already exists
        if (Game::where('name', $validated['title'])->exists()) {
            return response()->json([
                'status' => 'invalid',
                'slug' => 'Game title already exists'
            ], 400);
        }

        $game = new Game;
        $game->name = $validated['title'];
        $game->description = $validated['description'];
        $game->slug = Str::slug($validated['title']);
        $game->author = $request->user()->id;
        $game->save();

        return response()->json([
            'status' => 'success',
            'slug' => $game->slug
        ], 201);
    }

    public function show($slug){
        $game = Game::where('slug', $slug)->with('game_author')->first();

        if (!$game) {
            abort(404);
        }

        return response()->json([
            'slug' => $game->slug,
            'name' => $game->name,
            'description' => $game->description,
            'thumbnail' => $game->thumbnail,
            'uploadTimestamp' => $game->created_at->toISOString(),
            'author' => $game->game_author->username,
            'scoreCount' => $game->scores()->count(),
            'gamePath' => '/games/' . $game->slug . '/' . $game->versions()->latest()->first()->version,
        ]);
    }

    public function upload(Request $request, $slug) {
        $game = Game::where('slug', $slug)->first();

        if (!$game) {
            abort(404);
        }

        if ($game->author !== $request->user()->id) {
            return response('You are not the author of this game', 403);
        }

        $validated = $request->validate([
            'zipfile' => 'required|file|max:100000',
            'token' => 'required'
        ]);

        $zipfile = $request->file('zipfile');
        $tempPath = $zipfile->storeAs('temp', $zipfile->getClientOriginalName());
        $zip = new ZipArchive;
        $res = $zip->open(storage_path('app/'.$tempPath));
        if ($res !== true) {
            return response('Failed to extract ZIP file', 400);
        }
        $extractPath = 'games/'.$game->slug.'/'.$game->versions()->latest()->first()->version + 1;
        Storage::makeDirectory($extractPath);
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i);
            if (Str::endsWith($filename, '/')) {
                Storage::makeDirectory($extractPath.'/'.Str::beforeLast($filename, '/'));
            } else {
                $file = $zip->getFromIndex($i);
                Storage::put($extractPath.'/'.$filename, $file);
            }
        }
        $zip->close();
        Storage::delete($tempPath);

        // update game record with new version information
        $game->versions()->create([
            'version' => $game->versions()->latest()->first()->version + 1,
            'path' => $extractPath,
            'thumbnail' => null,
        ]);
        $game->thumbnail = null;
        foreach (Storage::files($extractPath) as $file) {
            if (Str::endsWith($file, 'thumbnail.png')) {
                $game->thumbnail = $file;
                break;
            }
        }
        $game->save();

        // return success response
        return response('Game uploaded successfully', 200);
    }
}