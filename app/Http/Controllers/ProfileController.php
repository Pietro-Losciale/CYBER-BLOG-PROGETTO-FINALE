<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $data = $request->all();

        // ❌ IGNORA password vuota (fix errore SQL)
        if (empty($data['password']) || !$request->filled('password')) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($request->password);
        }

        // ⚠️ VULNERABILE DI PROPOSITO (mass assignment)
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update($data);
        $user->refresh();

        return redirect()->back()->with('message', 'Profilo aggiornato');
    }
}