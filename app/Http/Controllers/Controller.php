<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Book;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getDataCount(){
        $data = [
            'users' => User::where('role', 'umum')->count(),
            'authors' => User::where('role', 'author')->count(),
            'books' => Book::count()
        ];

        return $data;
    }

    public function response($error, $message){
        return response()->json([
            'error' => $error,
            'message' => $message
        ], 200);
    }
}
