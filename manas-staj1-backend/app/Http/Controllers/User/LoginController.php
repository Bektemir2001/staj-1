<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __invoke(Request $request){
        $data = $request->validate([
            'student_num' => '',
            'password' => ''
        ]);
        // return response($data)
        // ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        // ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
        $user = User::where('student_num', $data['student_num'])->get();
        if(count($user)){
            if(Hash::check($data['password'], $user[0]->password)){
                session(['password' => $user[0]->password]);
                if($user[0]->role === 'admin'){
                    return response(['password' => $user[0]->password,
                                     'is_admin' => true])
                                    ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                                    ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
                }
                return response(['password' => $user[0]->password,
                                 'is_admin' => false])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
            }
            else{
                return response(['error' => 'error_password'])
                ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
                ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
            }
        }
        return response(['error' => 'error_user'])
        ->header("Access-Control-Allow-Origin", config('cors.allowed_origins'))
        ->header("Access-Control-Allow-Methods", config('cors.allowed_methods'));
    }
}
