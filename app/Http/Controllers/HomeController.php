<?php

namespace App\Http\Controllers;

use App\Car;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::all();
        $ids = implode(',', $users->pluck('id')->toArray());

        return view('cars')->with(compact('users','ids'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->input();
        $user = User::find($id);

        if (empty($user)) {
            abort('404');
        }

        $user->update([
            'first_name' => $input['hidden_first_name-'.$id],
            'last_name' => $input['hidden_last_name-'.$id],
            'username' => $input['hidden_username-'.$id],
            'email' => $input['hidden_email-'.$id]
        ]);

        return redirect('/');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!empty($user)) {
            $user->delete();
        }

        return redirect(url('/'));
    }

    public function create(Request $request)
    {
        $input = $request->input();
    }
}
