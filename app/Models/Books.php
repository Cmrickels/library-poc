<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory; 

    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    protected $guarded = [];

    public function setOrder($order) {
        $this->order = $order;
    }
}
