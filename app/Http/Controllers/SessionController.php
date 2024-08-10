<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Guru;
use Illuminate\Validation\Rule;


class SessionController extends Controller
{
    //

    //login

    public function login(){
        return view('login');
    }
    public function login_akun()
    {
        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($attributes)) {
            $user = Auth::user(); // Mendapatkan objek pengguna yang berhasil login
            session()->regenerate();
    
            if ($user->level == "admin") {
                return redirect('dashboard_admin')->with(['success' => 'Welcome admin.']);
            } else if ($user->level == "kepalaMadrasah") {
                return redirect('dashboard_kepalaMadrasah')->with(['success' => 'Welcome Kepala Madrasah.']);
            } else if ($user->level == "guru") {
                // Retrieve the Guru model associated with the logged-in user
                $guru = Guru::where('id_user', $user->id)->first();
    
                if ($guru) {
                    if ($guru->status == "guru_inti") {
                        return redirect('dashboard_guru_inti')->with(['success' => 'Welcome Guru Inti.']);
                    } else {
                        return redirect('dashboard_guru_piket')->with(['success' => 'Welcome Guru Piket.']);
                    } 
                } else {
                    return redirect('dashboard_guru')->with(['success' => 'Welcome Guru.']);
                }
            } else if ($user->level == "waliMurid") {
                return redirect('dashboard_waliMurid')->with(['success' => 'Welcome Wali Murid.']);
            }
        } else {
            return back()->withErrors(['email' => 'Email or password invalid.']);
        }
    }
    


    //register

    public function register(){
        return view('register');
    }

    public function createUser()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'level' => 'required', // validasi level
        ]);
        $attributes['password'] = bcrypt($attributes['password']);
    
        $user = User::create($attributes);
        Auth::login($user);
    
        // Mengarahkan pengguna baru sesuai dengan level
        if ($user->level == "admin") {
            return redirect('dashboard_admin')->with(['success' => 'Welcome admin.']);
        } else if ($user->level == "kepalaMadrasah") {
            return redirect('dashboard_kepalaMadrasah')->with(['success' => 'Welcome guru.']);
        } else if ($user->level == "guru") {
            return redirect('dashboard_guru')->with(['success' => 'Welcome waliMurid.']);
        } else if ($user->level == "waliMurid") {
            return redirect('dashboard_waliMurid')->with(['success' => 'Welcome waliMurid.']);
        }else {
            return redirect('errors.404')->with(['success' => 'tidak punya akun']);
        }
    }

   

    //logout

    public function destroyAdmin()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }

    public function destroyKepalaMadrasah()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }

    public function destroyGuru()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
    public function destroyWaliMurid()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}

