<?php
namespace App\Repository;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBooksRepository
{
   public function all(): Collection;

   public function createAndAssignOrder($book): Model;
}