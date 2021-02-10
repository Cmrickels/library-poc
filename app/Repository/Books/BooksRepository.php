<?php

namespace App\Repository;

use App\Models\Books;
use App\Repository\IBooksRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BooksRepository extends BaseRepository implements IBooksRepository
{

   /**
    * UserRepository constructor.
    *
    * @param User $model
    */
   public function __construct(Books $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   /**
    * @return Books
    */
    public function createAndAssignOrder($book): Model
    {
        $lastOrder = DB::table('books')
            ->where('genres_id', $book["genres_id"])
            ->orderBy('order', 'desc')
            ->first();

        if ($lastOrder) {
            $book["order"] = $lastOrder->order + 1;
        } else {
            $book["order"] = 1;
        }

        return $this->create($book);
    }
}