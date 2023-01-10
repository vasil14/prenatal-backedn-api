<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'lastName' => ['required', 'min:3'],
            'birthday' => ['required'],
            'gender' => ['required'],
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->symbols()
            ]
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        $user = User::create($formFields);
        $token = $user->createToken('PersonalAccessToken')->plainTextToken;


        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response(compact('user', 'token'));
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
        $user = $request->user();

        $user->currentAccessToken()->delete();

        return [
            'message' => 'Logged out!'
        ];
    }
}
