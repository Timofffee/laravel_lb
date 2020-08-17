<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\bookRequest;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BookController extends Controller
{

    public function index(Request $req, $id)
    {        
        $book = Book::find($id);
        
        
        if ($book && !$book->shared) {
            if (!(Auth::check() && $book->owner == Auth::id()))
                return view('showBook', ['book' => null]);
        }
        if (in_array($req->query('shared'), ['0', '1'])) {
            Book::where([
                ['id', $id], 
                ['owner', Auth::id()]
            ])->update(['shared' => $req->query('shared')]);
            redirect()->route('book', ['id' => $id]);
        }
        
        return view('showBook', ['book' => $book]);
    }


    public function createPage()
    {
        return view('newBook');
    }

    
    public function create(bookRequest $req)
    {
        $book = new Book;
        $book->title = $req->input('title');
        $book->text = $req->input('text');
        $book->owner = Auth::id();

        $book->save();

        return redirect()->route('home')
        ->with('success', 'Книга успешно создана');
    }


    public function editPage($id)
    {
        $book = Book::where('id', $id)->first();
        return view('editBook', ['book' => $book]);
    }


    public function edit(bookRequest $req, $id)
    {
        Book::where('id', $id)
        ->update([
            'title' => $req->input('title'),
            'text' => $req->input('text')
        ]);


        return redirect()->route('home')
        ->with('success', 'Книга успешно отредактирована');
    }


    public function delete($id)
    {
        $book = Book::where('id', $id)->where('owner', Auth::id());
        if (!$book->first()) {
            return redirect()->route('home')
            ->with('error', 'Ошибка во время удаления книги. У вас нет прав или книга не существует.');
        }
        
        $book->delete();

        return redirect()->route('home')
        ->with('success', 'Книга успешно удалена');
    }
}
