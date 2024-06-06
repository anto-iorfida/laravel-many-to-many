<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user(); //istanza di user loggato
        // $user = Auth::id(); //ritorna numero id utente logato
        // $user = Auth::check(); //ritorna valore tru o false se e loggato o no

        $user = Auth::user();

        return view('admin.dashboard',compact('user'));
        // compact crea un array associativo la chiave è la variabile e, il valore è la variabile  che si chiama con lo stesso nome
    }
}
