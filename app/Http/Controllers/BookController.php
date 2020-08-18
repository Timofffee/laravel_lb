<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\bookRequest;
use Illuminate\Support\Facades\Auth;
use App\Book;

class BookController extends Controller
{

    public function index(Request $req, $id) {        
        if (in_array($req->query('shared'), ['0', '1'])) {
            Book::share($id, $req->query('shared'));
            redirect()->route('book', ['id' => $id]);
        }
        
        return view('showBook', ['book' => Book::book($id)]);
    }


    public function createPage() {
        return view('newBook');
    }

    
    public function create(bookRequest $req) {
        Book::createBook($req->input('title'), $req->input('text'));

        return redirect()->route('home')
            ->with('success', 'Книга успешно создана');
    }


    public function editPage($id) {
        $book = Book::book($id);
        return view('editBook', ['book' => $book]);
    }


    public function edit(bookRequest $req, $id) {
        Book::updateBook($id, [
            'title' => $req->input('title'),
            'text' => $req->input('text')
        ]);


        return redirect()->route('home')
            ->with('success', 'Книга успешно отредактирована');
    }


    public function delete($id) {
        if (Book::deleteBook($id)) {
            return redirect()->route('home')
                ->with('success', 'Книга успешно удалена');
        } else {
            return redirect()->route('home')
                ->with('error', 'Ошибка во время удаления книги. У вас нет прав или книга не существует.');
        }
    }
}
