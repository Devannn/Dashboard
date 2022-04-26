<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id', 'name', 'email', 'phonenumber', 'profession', 'address', 'postal_code', 'city', 'country')->get();

        return view('user.user')->with([
            'users' => $users,
        ]);
    }

    /**
     * Pulls the personal information from the user to show on the edit-personal page.
     */
    public function editPersonal()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('user/edit-personal', $data);
    }

    /**
     * Update the user's personal settings.
     */
    public function updatePersonal(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'phonenumber'    => '',
            'profession'    => '',
        ], [
            'name'          => 'Name is required',
            'phonenumber'   => '',
            'profession'    => '',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'phonenumber' => $request->phonenumber,
            'profession' => $request->profession,
        ]);

        return redirect('user')->with('success', 'Profile succesfully updated');
    }

    /**
     * Pulls the security information from the user to show on the edit-security page.
     */
    public function editEmail()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('user/edit-email', $data);
    }

    /**
     * Update the user's security settings.
     */
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email'         => 'required',
        ], [
            'email'         => 'Email is required',
        ]);

        $user = auth()->user();

        $user->update([
            'email' => $request->email,
        ]);

        return redirect('user')->with('success', 'Profile succesfully updated');
    }

    public function changePassword()
    {
        return view('user/edit-security');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Pulls the address information from the user to show on the edit-address page.
     */
    public function editAddress()
    {
        $user = auth()->user();
        $data['user'] = $user;
        return view('user/edit-address', $data);
    }

    /**
     * Update the user's address settings.
     */
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address'       => '',
            'postal_code'   => '',
            'city'          => '',
            'country'       => '',
        ], [
            'address'       => 'Address is required',
            'postal_code'   => 'Postal Code is required',
            'city'          => 'City Name is required',
            'country'       => 'Country is required',
        ]);

        $user = auth()->user();

        $user->update([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'city' => $request->city,
            'country' => $request->country,
        ]);

        return redirect('user')->with('success', 'Profile succesfully updated');
    }

    /**
     * Update the user's avatar.
     * 
     * This avatar is set to default.jpg by default.
     */
    public function update_avatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/img/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }

        return redirect('user')->with('success', 'Profile succesfully updated');
    }
}
