<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Models\Books;
use App\Models\Genres;
use App\Repository\Eloquent\BooksRepository;
use App\Repository\IBooksRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;

class BooksController extends Controller
{
    private $booksRepo;
    
    public function __construct(IBooksRepository $_booksRepo) {
        $this->booksRepo = $_booksRepo;
    }

    /**
     * Get all books
     * 
     * @return Collection
     */
    public function index(): Collection
    {        
        return $this->booksRepo->all();
    }

    /**
     * Delete one book by id
     * 
     * @return Boolean
     */
    public function deleteOne(int $book_id): bool
    {
        return Books::find($book_id)->delete();
    }

    /**
     * Update order of books using id => order mappings
     * 
     * @return Collection
     */
    public function updateOrder(Request $request): Collection
    {
        try {
            $idOrderPairs = $request->all();
            foreach ($idOrderPairs as $id => $order) {
                $book = Books::find($id);
                $book->order = $order;
                $book->save();
            }
            return Genres::find(1)->books;

        } catch(\Exception $e) {
            return abort(500, $e->getMessage());
        }
    }

    /** 
     * Find next order number and create book
     * 
     * @return Books
     */
    public function create(Request $request): Books
    {
        return $this->booksRepo->createAndAssignOrder($request->all());
    }
}
