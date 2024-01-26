<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\LupaPasswordMail;
use App\Models\ResetPasswordModel;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function LupaPassword(){
        return view('lupapass');
    }

    public function actionForgot(Request $request)
    {
        
        $this->validate($request, [
            'email' => 'required|string|email'
        ]);

        try {
            
            
            $datas = $request->all();

            $cekEmail = User::where('email', $datas['email'])->first();

            if(empty($cekEmail)){

                Session::flash('error', 'Email tidak ditemukan !');
                return redirect('password');
            
            }

            $verify_key = Str::random(100);

            $dataToken = new ResetPasswordModel;
            $dataToken->email = $datas['email'];
            $dataToken->verify_key = $verify_key;
            $dataToken->created_at = date('Y-m-d H:i:s');
            $dataToken->save();

            $details = [
                'email' => $request->email,
                'website' => 'www.sukasuka.com',
                'datetime' => date('Y-m-d H:i:s'),
                'url' => request()->getHttpHost().'/password/input-reset/'.$verify_key
            ];

            Mail::to($datas['email'])->send(new LupaPasswordMail($details));
    
            Session::flash('message', 'Link verifikasi telah dikrim ke Email Anda. Silahkan Cek Email Anda untuk mengubah password');
            return redirect('password');

        } catch (\Throwable $th) {
            Session::flash('error',$th->getMessage());
            return redirect('password');
        }
    }

    public function ResetPass($verify_key)
    {
        //cek data by token
        $dataReset = ResetPasswordModel::where('verify_key', $verify_key)->first();
        if (empty($dataReset)) {
            session()->flash('error', 'Token tidak valid');
            return redirect('password');
        }
        $verify_key = $verify_key;
        $email = $dataReset->email;

        //proses menampilkan form reset password
        return view('resetpass', compact('email', 'verify_key'));
    }

    public function prosesResetPassword(Request $req)
    {
        //validasi password baru
        $this->validate($req, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        try {
            $datas = $req->all();
            //validasi email
            $cek_email = User::where('email', $datas['email'])->first();
            if (empty($cek_email)) {
                session()->flash('error', 'Email tidak ditemukan');
                return redirect()->route('password');
            }
            
            //proses update password
            User::where('email', $datas['email'])->update([
                'password' => Hash::make($datas['password'])
            ]);

            //proses hapus ke tabel reset password by email
            ResetPasswordModel::where('email', $datas['email'])->delete();

            session()->flash('message', 'Reset password sukses');
            return redirect()->route('password');
        } catch (\Throwable $th) {
            session()->flash('error', 'Token tidak valid');
            return redirect()->route('password');
        }
    }
}
