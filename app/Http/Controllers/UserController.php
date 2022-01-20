<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail as FacadesMail;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('user');
    }

    public function dashboard(Request $request){
        $data_count = $this->getDataCount();
        return view('dashboard.index', compact('data_count'));
    }

    public function users(Request $request){
        $data_count = $this->getDataCount();
        $user = User::where('role', 'umum')->get();
        return view('dashboard.users', compact('data_count', 'user'));
    }

    public function authors(Request $request){
        $data_count = $this->getDataCount();
        $user = User::where('role', 'author')->get();
        return view('dashboard.authors', compact('data_count', 'user'));
    }

    public function store(Request $request){
        $user = new User;
        $password = Str::random(10);

        $pesan = "Informasi Akun Website Perpustakaan TekenAja: ";
        $pesan_email    = "Email    : ".$request->email;
        $pesan_password = "Password : ".$password;

        try {

            FacadesMail::send('send_password', ['name' => $request->name, 'pesan' => $pesan ,'email' => $pesan_email, 'password' => $pesan_password], function ($message) use ($request){
                $message->subject('Reset Password');
                $message->from('radensaleh@student.polindra.ac.id', 'Virtual Tes Tahap ke 2');
                $message->to($request->email);
            });

            $user->name = $request->name;
            $user->password = $password;
            $user->email = $request->email;
            $user->role = $request->role;
            
            if($user->save()){
                return $this->response(0, 'Berhasil tersimpan, password akan dikirim melalui email tersebut');
            }else{
                return $this->response(1, 'Gagal menyimpan data');
            }
        } catch (\Exception $e) {
            return $this->response(1, $e->getMessage());
        }
    }

    public function update(Request $request){
        $user = User::where('user_id', $request->user_id);

        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = $request->role;

        if($user->update($data)) {
            return $this->response(0, 'Data berhasil diperbaharui');
        } else {
            return $this->response(1, 'Gagal memperbaharui data');
        }
    }

    public function destroy(Request $request){
        $u = User::where('user_id', $request->user_id);

        try {
          $u->delete();

          if( $u ){
            return $this->response(0, 'Data berhasil dihapus');
          }
        } catch (\Exception $e) {
            return $this->response(1, 'Gagal menghapus data');
        }
    }

    public function setting_page(Request $request){
        $data_count = $this->getDataCount();

        return view('dashboard.setting', compact('data_count'));
    }

    public function setting_update(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'new_password' => 'required|string|min:6',
        ]);
      
        if ($validator->fails()) {
            return $this->response(1, $validator->messages());
        } else {
            $data = User::findOrFail($request->user_id);
            if(Hash::check($request->password, $data->password)){
              $update = $data->update([
                'name' => $request->name,
                'email' => $request->email,
                'password'  => $request->new_password
              ]);

              if($update){
                return $this->response(0, 'Berhasil memperbaharui data');
              }else{
                return $this->response(2, 'Gagal memperbaharui data');
              }
            }else{
              return $this->response(2, 'Password lama tidak sesuai');
            }
        }
    }

}
