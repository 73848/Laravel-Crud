<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ControlandoPah extends Controller
{
    public function logout(){
        auth()->logout();
        return redirect('/home');
    }
    /*
    1-) receber dados do form de login e vê se o campo nome e senha estão preenchidos
    2-)
    */
    public function login(Request $request){
        $validating = $request->validate([
            'loginname'=>'required',
            'loginpassword'=>'required'
        ]);
        // attempt recebe um array de chave/valor e compara se a chave corresponde ao valor
        if(auth()->attempt(['name'=> $validating['loginname'], 'password'=> $validating['loginpassword']]))
        {      
            $request->session()->regenerate(); // crio nova sessão
        }
        return redirect('/home');
    }
    public function register(Request $request){
        //validando input de forms
        $validating = $request->validate([
            'name'=>['required', 'min:3', 'max:35', Rule::unique('users', 'name')],
            'email'=>['required','email', Rule::unique('users', 'email')],  
            'password'=>['required','min:8']
        ]);
/*
    criando usuario e encriptando sua senha 
*/
        $validating['password'] = bcrypt($validating['password']);
        $user = User::create($validating);
        auth()->login($user);
        return redirect('/home');
    }
}
