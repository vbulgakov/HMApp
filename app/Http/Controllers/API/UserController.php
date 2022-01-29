<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(Request $request)
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

            if (Auth::attempt($credentials)) {
                $success = true;
                $message = 'Logged in!';
            } else {
                $success = false;
                $message = 'Wrong user data!';
            }

            $response = [
                'success' => $success,
                'message' => $message
            ];
            return response()->json($response);
        }

    public function logout()
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Logged out.';
        }
        catch (QueryException $ex){
            $success = false;
            $message = $ex->getMessage();
        }

        $response = [
            'success' => $success,
            'message' => $message
        ];
        return response()->json($response);

    }






}
