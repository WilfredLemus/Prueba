<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        // if(request()->has('empty')){
        //     $users = [];
        // }else {
        //     // $users = ['Juan', 'Mario', 'Carlos', 'Pedro','Raul'];
        // }
        $users = User::all();

        $title = "Usuarios";
        return view('users.index', compact('title', 'users'));
    }

    public function show(User $user){
        // $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(Request $request){

        // 'email' => ['required', 'email', Rule::unique('users)->ignore($user->id)],
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num|min:6',
        ], [
            'name.required' => 'El campo Nombre es obligatorio',
            'password.min' => 'El campo Contraseña debe tener 6 caracteres como minimo'
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|alpha_num|min:6'
        ], [
            'name.required' => 'El campo Nombre es obligatorio',
        ]);

        if($data['password'] != null){
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);

        return redirect()->route('users.show', ['user' => $user]);
    }

    public function delete(User $user)
    {
        // $user = User::findOrFail($id);
        return view('users.delete', compact('user'));
    }

    public function destroy(User $user)
    {
        // $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
