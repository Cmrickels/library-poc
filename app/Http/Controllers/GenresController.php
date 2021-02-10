<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Genres;
use Illuminate\Database\Eloquent\Collection;

class GenresController extends Controller
{
    /**
     * Return all books
     * 
     * @return Collection
     */
    public function index(): Collection
    {        
        return Genres::all();
    }

    /**
     * Return books by genre
     * 
     * @return Collection
     */
    public function getBooks($genre_id) : Collection
    {
        if(!isset($genre_id)) {
            abort(500, "genre id required");
        }
        $books = Genres::find($genre_id)->books;
        $temp = null;
        for ($i = 0; $i < count($books) - 1; $i++) {
            for ($j = $i + 1; $j < count($books); $j++) {
                if ($books[$i]->order > $books[$j]->order) {
                    $temp = $books[$i];
                    $books[$i] = $books[$j];
                    $books[$j] = $temp;
                }
            }    
        }
        return $books;
    }
}
