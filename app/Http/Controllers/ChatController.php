<?php

namespace App\Http\Controllers;

use App\Events\NewChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function sendMessage(Request $request)
    {
        $user = auth()->user();
        $message = $request->input('message');

        event(new NewChatMessage($user, $message));

        return response()->json(['status' => 'Message Sent!']);
    }




    public function mostrarPaginaChat()
    {
        return view('chat.pagina');
    }
}
