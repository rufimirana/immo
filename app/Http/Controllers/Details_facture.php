<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class Details_facture extends Controller{
    public function create_facture(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->save();

            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->bio = $request->input('bio');
            $profile->save();
        });

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }
}
