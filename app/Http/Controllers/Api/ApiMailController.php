<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CollecteDemandeMail;

class ApiMailController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom'       => 'required|string|max:255',
            'employes'  => 'required|integer',
            'mail'      => 'required|email',
            'telephone' => 'nullable|string|max:30',
            'message'   => 'nullable|string|max:1000',
        ]);

        Mail::to('benoit.jaques@heig-vd.ch')->send(new CollecteDemandeMail($validated));

        return response()->json(['success' => true]);
    }
}
