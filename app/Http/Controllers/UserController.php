<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Book;
use App\libShare;

class UserController extends Controller
{
    /**
     * Show the user library.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req, $id)
    {
        $data = null;
        $shared = false;       
        
        if (Auth::check()) {
            if (in_array($req->query('shared'), ['0', '1'])) {
                if ($req->query('shared') == '0') {
                    libShare::deleteShare($id);
                } elseif (!libShare::getShare(Auth::user()->id, $id)) {
                    libShare::createShare($id);
                }
                redirect()->route('user', ['id' => $id]);
            }

            if (libShare::getShare($id, Auth::user()->id) or $id == Auth::user()->id) {
                $data = Book::getAllBooks($id);
            }

            $shared = boolval(libShare::getShare(Auth::user()->id, $id));
        }
        
        return view('home', [
            'user' => User::find($id), 
            'data' => $data, 
            'shared' => $shared
        ]);
    }
}
