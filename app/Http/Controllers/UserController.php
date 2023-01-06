<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6']
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        $token = $user->createToken('PersonalAccessToken')->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);


        $user = User::where('email', $formFields['email'])->first();

        if (!$user || !Hash::check($formFields['password'], $user->password)) {
            return response(['message' => 'Wrong Creds'], 401);
        }

        $token = $user->createToken('PersonalAccessToken')->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token
        ];


        return response($response);
    }


    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out!'
        ];
    }
}
