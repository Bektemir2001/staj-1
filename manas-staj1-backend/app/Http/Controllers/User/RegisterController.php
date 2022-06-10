<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request){
        $data = $request->validate([
            'full_name' => '',
            'student_num' => '',
            'password' => '',
        ]);
        $users = User::where('student_num', $data['student_num'])->get();
        if(count($users)){
            return response(['error' => 'unique'])
            ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
            ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        }
        $user = User::create([
            'full_name' => $data['full_name'],
            'student_num' => $data['student_num'],
            'password' => Hash::make($data['password']),
        ]);
        session(['password' => $user->password]);
        return response(['password' => $user->password, 'is_admin' => false])
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
