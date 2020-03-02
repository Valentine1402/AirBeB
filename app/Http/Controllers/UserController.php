<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function setAvatar(Request $request, $id){
    $user = User::findOrFail($id);

    $data = $request -> validate([
      'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
    ]);

    $file = $request -> file('avatar') -> store('avatars', 'public');

    $user -> avatar = $file;

    $user -> save();

    return redirect() -> route('home') -> with('avatar_updated', 'Avatar successfully updated!');
  }

  public function userInfo($id){

    return view('pages.user-info');
  }
}
