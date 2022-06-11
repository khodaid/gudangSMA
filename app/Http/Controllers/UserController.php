<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // dd($request);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'email' => 'email tidak cocok',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function index()
    {
        $user = User::where('id_super',Auth::id())->get();
        // dd($user);
        return view('admin.user.index',[
            'users' => $user
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);


        $user = new User();
        $user->name = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->roles = 2;
        $user->id_super = Auth::id();
        // dd($user);

        $user->save();
        return redirect()->route('user.index')->with(['success' => 'Data Tersimpan']);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit',[
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required'
        ]);
        $user->name = $request->nama;
        $user->email = $request->email;
        if($request->password !== NULL){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        // dd($request->all());

        return redirect()->route('user.index')->with(['success'=>'Data Terupdate']);
    }

    public function show(User $user)
    {
        return view('admin.user.show',[
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with(['warning' => 'Data Terhapus']);
    }

    public function reset(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $akun = User::where('email',$request->email)->first();
        if ($akun === NULL) {
            return back()->withErrors([
                'email' => 'email bukan admin'
            ])->onlyInput('email');
        }
        $akun->password = Hash::make($request->password);
        $akun->save();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }
    }
}
