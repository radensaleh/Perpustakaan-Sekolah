<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as FacadesMail;

class BeforeLoginController extends Controller
{
    public function login_page(Request $request){
        if(Auth::check()){ 
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function resetpswd_page(Request $request){
        if(Auth::check()){ 
            return redirect()->route('dashboard');
        }
        return view('reset_pswd');
    }
    
    public function login_process(Request $request){
        if(Auth::check()){ 
            return redirect()->route('dashboard');
        }

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];
    
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:6',
        ]);
    
        if ($validator->fails()) {
            return $this->response(1, $validator->messages());
        } else {
            if (Auth::attempt($credentials)) {
                //$user = User::where('user_id', Auth::id())->first();  
                return response()->json([
                    'error'   => 0,
                    'message' => 'Login Success',
                    'email'   => $request->email
                ], 200);
            } else {
                return $this->response(2, 'Wrong Email or Password');
            }
        }
    }

    public function reset_process(Request $request){
        $email = $request->email;
        $password = Str::random(10);

        $cekEmail = User::where('email', $email)->count();
        if($cekEmail >= 1){
            $nama = User::where('email', $email)->value('name');
            
            $pesan = "Informasi Reset Password Akun Website Perpustakaan TekenAja: ";
            $pesan_email    = "Email    : ".$email;
            $pesan_password = "Password : ".$password;

            try{
                FacadesMail::send('send_password', ['name' => $nama, 'pesan' => $pesan, 'email'=>$pesan_email, 'password'=>$pesan_password], function ($message) use ($request)
                {
                    $message->subject('Reset Password Website Perpustakaan TekenAja');
                    $message->from('support@radensaleh.com', 'Website Perpustakaan TekenAja');
                    $message->to($request->email);
                });

                $user_id = User::where('email', $email)->value('user_id');
                $user = User::find($user_id);
                $user->password = $password;
                $user->save();
                
            }catch(Exception $e){
                return response()->json([
                    'error' => 1,
                    'message' => $e->getMessage(),
                ], 200);
            }

            return response()->json([
                'error' => 0,
                'message' => 'Password berhasil dikirim ke email tersebut',
            ], 200);

        } else {
            return response()->json([
                'error' => 1,
                'message' => 'Email tidak terdaftar!',
            ], 200);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('login');
    }
}
