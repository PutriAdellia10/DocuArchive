<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Logic to return different views based on the role
        if ($user->hasRole('admin')) {
            return view('components.sidebar-admin');
        } elseif ($user->hasRole('karyawan')) {
            return view('components.sidebar-karyawan');
        } elseif ($user->hasRole('pimpinan')) {
            return view('components.sidebar-pimpinan');
        } elseif ($user->hasRole('sekretariat')) {
            return view('components.sidebar-sekretariat');
        }

        return null;
    }
}
