<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class libShare extends Model
{
    

    static public function deleteShare($id) {
        libShare::where('user_id', $id)
            ->where('owner', Auth::id())
            ->delete();
    }


    static public function getShare($owner, $id) {
        return libShare::where('owner', $owner)
            ->where('user_id', $id)->first();
    }


    static public function createShare($id) {
        $share = new libShare();
        $share->owner = Auth::user()->id;
        $share->user_id = $id;
        $share->save();
    }
}
