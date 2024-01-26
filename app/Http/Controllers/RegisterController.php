<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\MailSend;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        $str = Str::random(100);
        
        $this->validate($request, [
            'email' =>'required|string|max:225',
            'username'=> ['required','regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d)/','min:3','max:10'],
            'password'=> ['required','regex:/^(?=.*[a-z|A-Z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/','min:8','max:15'],
            'role'=> 'required',
        ]);

        try {
            
            $datas = $request->all(); 
            $save = new User;
            $cekEmail = User::where('email', $datas['email'])->first();

            if(!empty($cekEmail)){

                Session::flash('error', 'Email sudah terdaftar !');
                return redirect('register');
            
            }

            $save->email =$datas['email'];
            $save->username =$datas['username'];
            $save->password = Hash::make($datas['password']);
            $save->role =$datas['role'];
            $save->verify_key =$str;
            $save->save();
           /* $user = User::create([
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'verify_key' => $str
            ]); */
    
            $details = [
                'username' => $save->username,
                'role' => $save->role,
                'website' => 'www.sukasuka.com',
                'datetime' => date('Y-m-d H:i:s'),
                'url' => request()->getHttpHost().'/register/verify/'.$str
            ];
    
            Mail::to($save->email)->send(new MailSend($details));
    
            Session::flash('message', 'Link verifikasi telah dikrim ke Email Anda. Silahkan Cek Email Anda untuk Mengaktifkan Akun');
            return redirect('register');

        } catch (\Throwable $th) {
            Session::flash('error', 'Proses registrasi gagal', $th->getMessage());
            return redirect()->route('register');
        }
    }
    
    public function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')
                    ->where('verify_key', $verify_key)
                    ->exists();
        
        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)
            ->update([
                'active' => 1
            ]);
            
            Session::flash('message', 'Akun Aktif');
            return redirect('/');
        }else{
            Session::flash('error', 'invalid key');
            return redirect('/');
        }
    }
}
