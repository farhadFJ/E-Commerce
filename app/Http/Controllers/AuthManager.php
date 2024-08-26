<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthManager extends Controller
{
    //
    function login()
    {
        // Überprüfen, ob der Benutzer bereits angemeldet ist. Wenn ja, weiterleiten.
        if (Auth::check()){
            return redirect(route('home'));
        }
        // Wenn nicht, zeige die Anmeldeseite an.
        return view('AuthBlade.login');
    }
    function registration()
    {
        if (Auth::check()){
            return redirect(route('home'));
        }
        return view('AuthBlade.registration');
    }
    function loginPost(Request $request)
    {
        // Validiere die Eingabe des Benutzers (E-Mail und Passwort).
        $request ->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        // Holen Sie sich die Anmeldeinformationen des Benutzers aus dem Formular.
        $credentails =$request->only('email','password');
        // Versuchen Sie, den Benutzer anzumelden.
        if (Auth::attempt($credentails)){
            // Wenn die Anmeldung erfolgreich ist, leiten Sie den Benutzer entsprechend seinem Benutzertyp weiter.
            if (Auth::user()->usertype == 1)
                return redirect()->intended(route('productsCreate')); // Weiterleiten zum Erstellen von Produkten (Admin).
            return redirect()->intended(route('productsList')); // Weiterleiten zur Produktliste (normaler Benutzer).
        }
        // Wenn die Anmeldung fehlschlägt, leiten Sie den Benutzer zurück zur Anmeldeseite mit einer Fehlermeldung.
        return redirect(route('login'))->with('error','login details are not valid!');
    }
    function registrationPost(Request $request)
    {
        // Validiere die Benutzerregistrierungsdaten (Name, E-Mail, Telefon, Adresse und Passwort).
        $request ->validate([
            'name' =>'required',
            'email'=>'required|email|unique:users',
            'phone' =>'required',
            'address' =>'required',
            'password'=>'required'
        ]);

        // Erstellen Sie ein Array mit den Benutzerregistrierungsdaten.
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);

        // Versuchen Sie, einen neuen Benutzer zu erstellen.
        $user = User::Create($data);

        if (!$user){
            // Wenn die Registrierung fehlschlägt, leiten Sie den Benutzer zurück zur Registrierungsseite mit einer Fehlermeldung.
            return redirect(route('registration'))->with('error','Registration failed ,  try again!');
        }
        // Wenn die Registrierung erfolgreich ist, leiten Sie den Benutzer zur Loginsite weiter mit einer Erfolgsmeldung.
        return redirect(route('login'))->with('success','Registration success , Login to access the app!');
    }

    function logout()
    {
        // Beenden Sie die Benutzersitzung und melden Sie den Benutzer ab.
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
