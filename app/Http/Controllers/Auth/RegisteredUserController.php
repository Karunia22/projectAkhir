<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view(view: 'auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_telepon' => 'required|string|max:15', 
        ]);

        DB::beginTransaction();
        try{
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'no_telepon' => $request->no_telepon, 
            ]);
            
            $profil = Profil::create([
                'id_user'=> $user->id,
                'kota' => '',
                'kode_pos' => '',
                'no_telepon'=> $user->no_telepon,
                'alamat' => '',
            ]);

            event(new Registered($user));
            DB::commit();
            Auth::login($user);
            return redirect(route('pembeliBeranda', absolute: false));
        } catch(\Exception $e){
            DB::rollBack();
             return redirect()->route('register')
            ->withErrors(['error' => 'Masukkan ulang data diri Anda.']);
        }
    }
}
