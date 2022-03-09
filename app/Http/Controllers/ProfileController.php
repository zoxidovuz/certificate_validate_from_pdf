<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function edit()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'new_password' => 'nullable|sometimes|string|min:5'
        ]);
        if($request->input('new_password')){
            $data['password'] = Hash::make($request->input('new_password'));
        }
        $user->update($data);
        return redirect()->route('dashboard');
    }
}
