<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class BookController extends Controller
{

    public function __construct(){
        $this->middleware('user');
    }
    
    public function books(Request $request){
        $data_count = $this->getDataCount();
        $author = User::where('role', 'author')->get();
        $book = Book::all();

        return view('dashboard.books', compact('data_count', 'book', 'author'));
    }

    public function store(Request $request){
        $data = $request->all();

        try {
            Book::create($data);
            return $this->response(0, 'Berhasil tersimpan');
        } catch (\Exception $e) {
            return $this->response(1, $e->getMessage());
        }
    }

    public function update(Request $request){
        $book = Book::where('book_id', $request->book_id);

        $data = [];
        $data['name'] = $request->name;
        $data['user_id'] = $request->user_id;
        $data['category'] = $request->category;
        $data['publication_year'] = $request->publication_year;
        $data['isbn'] = $request->isbn;

        if($book->update($data)) {
            return $this->response(0, 'Data berhasil diperbaharui');
        } else {
            return $this->response(1, 'Gagal memperbaharui data');
        }
    }

    public function destroy(Request $request){
        $b = Book::where('book_id', $request->book_id);

        try {
          $b->delete();

          if( $b ){
            return $this->response(0, 'Data berhasil dihapus');
          }
        } catch (\Exception $e) {
            return $this->response(1, 'Gagal menghapus data');
        }
    }
}
