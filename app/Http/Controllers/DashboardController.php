<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view("dashboard", compact('user'));
    }

    public function showImage()
    {
        $user = auth()->user();
        return view("dashboard", compact("user"));
    }

    public function create(Request $request)
    {
        $request->user()->createToken($request->token_name);
        return redirect()->to('/dashboard');
    }

    public function delete($id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();
        return redirect()->to('/dashboard');
    }
}
