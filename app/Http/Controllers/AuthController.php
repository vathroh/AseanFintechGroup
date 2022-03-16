<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    $validation = Validator::make($request->all(), [
      'name' => 'required|string|min:3',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:8',
      'confirm_password' => 'required|same:password'
    ]);

    if($validation->fails()){
      return response()->json($validation->errors(), 400);
    }

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password)
    ]);

    return response()->json([
      'data' => $user,
      'message' => 'Registrasi berhasil dilakukan'
    ]);

  }


  public function login(Request $request)
  {
    $validation = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required|min:8'
    ]);


    if($validation->fails())
    {
      return response()->json($validation->errors(), 400);
    }

    if(!Auth::attempt($request->only('email', 'password')))
    {
      return response()->json([
        'message' => 'Email atau password salah!'], Response::HTTP_UNAUTHORIZED
      );
    }

    $user = Auth::user();
    $token = $user->createToken('token')->plainTextToken;
    $cookie = cookie('aseanfinancegroupcookie', $token, 60*24);

    return response()->json(['message' => 'Anda berhasil login!'])->withCookie($cookie);

  }


  public function logout()
  {
    $cookie = Cookie::forget('aseanfinancegroupcookie');
    return response(['message' => 'Anda berhasil logout!'])->withCookie($cookie);
  }
}
