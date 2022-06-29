<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Sanctum\HasApiTokens;


class AuthController extends Controller
{
    // use HasApiTokens;
    use HasApiTokens;
    public function register(Request $request) {
        $fields = $request->validate([
            'fname' => 'required|string',
            'lname' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
            'password_confirm' => 'required|string',
            'specialist'=>'required|boolean',
            'client'=>'required|boolean',
            'male'=>'required|boolean',
            'female'=>'required|boolean',
            'age'=>'required|string',
            'job_title'=>'required|string',
            'job_address'=>'required|string',
        ]);

        $duplicate = User::select('email')->where('email',$fields['email'])->exists();
            if(!$duplicate){


        $user = User::create([
            'fname' => $fields['fname'],
            'lname' => $fields['lname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'password_confirm' => bcrypt($fields['password_confirm']),
            'specialist' => $fields['specialist'],
            'client' => $fields['client'],
            'male' => $fields['male'],
            'female' => $fields['female'],
            'age' => $fields['age'],
            'job_title' => $fields['job_title'],
            'job_address' => $fields['job_address'],

        ]);


        $token = $user->createToken('myapptoken')->plainTextToken;
        $token= substr($token , -40,40);
        User::where('id', $user->id)->update(['api_token' => $token]);


        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

        return response(['this email is already exist'], 200);
    }
    
}
