<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::select('id', 'name', 'email', 'avatar', 'phonenumber', 'profession', 'address', 'postal_code', 'city', 'country')->get();

        return view('users')->with([
            'users' => $users,
        ]);
    }
}
