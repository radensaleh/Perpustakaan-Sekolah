<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
      'book_id', 'name', 'category', 'publication_year', 'user_id', 'isbn'
    ];

    protected $primaryKey = 'book_id';

    public function user(){
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
