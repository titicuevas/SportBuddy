<?php

namespace App\Http\Controllers;

use App\Mail\CantactanosMailable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class ContactanosController extends Controller
{
    public function __invoke(): RedirectResponse
    {
        Mail::to(config('mail.from.address', 'contacto@sportbuddy.test'))
            ->send(new CantactanosMailable);

        return back()->with('success', 'Mensaje enviado correctamente.');
    }
}
