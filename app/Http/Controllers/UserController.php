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

        $user = User::where('id', $id)->first();
        if (!$user) {
            redirect('/');
        }
        
        if (Auth::check()) {
            if (in_array($req->query('shared'), ['0', '1'])) {
                if ($req->query('shared') == '0') {
                    libShare::where('user_id', $id)
                        ->where('owner', Auth::user()->id)
                        ->delete();
                } elseif (!libShare::where('user_id', $id)
                    ->where('owner', Auth::user()->id)->first()) {
    
                    $share = new libShare();
                    $share->owner = Auth::user()->id;
                    $share->user_id = $id;
                    $share->save();
                }
                redirect()->route('user', ['id' => $id]);
            }

            if (libShare::where('user_id', Auth::user()->id)
                ->where('owner', $id)
                ->first()) {
                    $data = Book::where('owner', $id)->get();
            }

            $shared = boolval(libShare::where('user_id', $id)
                ->where('owner', Auth::user()->id)
                ->first());
        }
        
        return view('home', [
            'user' => $user, 
            'data' => $data, 
            'shared' => $shared
        ]);
    }
}
