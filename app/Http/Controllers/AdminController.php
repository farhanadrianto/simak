<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan dashboard admin
     */
    public function dashboard()
    {
        $user = auth()->user();
        
        return view('admin.dashboard', [
            'user' => $user,
        ]);
    }
}
