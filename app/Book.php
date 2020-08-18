<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\User;

class Book extends Model
{    
    static public function book($id) {
        $book = Book::find($id);
        if ($book) {
            $book->owner = User::find($book->owner);
        }
        return $book;
    }

    static public function getAllBooks($id) {
        return Book::where('owner', $id)->get();
    }

    static public function share($id, $status) {
        if (!Auth::check()) {
            return;
        }
        $book = Book::where([
            ['id', $id], 
            ['owner', Auth::id()]
        ]);
        if ($book) {
            $book->update(['shared' => $status]);
        }
        
    }


    static public function createBook($title, $text) {
        $book = new Book;
        $book->title = $title;
        $book->text = $text;
        $book->owner = Auth::id();

        $book->save();
    }


    static public function updateBook($id, $columns) {
        Book::where('id', $id)->update($columns);
    }


    static public function deleteBook($id) {
        $book = Book::where('id', $id)->where('owner', Auth::id());
        if (!$book->first()) {
            return false;
        }
        
        $book->delete();
        return true;
    }
}
