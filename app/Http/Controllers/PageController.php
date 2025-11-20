<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Mostrar la página de Contactanos
     */
    public function contactanos()
    {
        return view('pages.contactanos');
    }

    /**
     * Procesar formulario de contacto y enviar un correo simple.
     */
    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            $to = config('mail.from.address');
            $subject = 'Mensaje de contacto desde sitio web: ' . ($data['name'] ?? 'Contacto');

            Mail::raw($data['message'] . "\n\nFrom: {$data['name']} <{$data['email']}>", function ($msg) use ($to, $data, $subject) {
                $msg->to($to)->subject($subject);
            });

            return redirect()->route('contactanos')->with('status', 'Gracias, tu mensaje fue enviado correctamente.');
        } catch (\Exception $e) {
            Log::error('Contact form send failed: ' . $e->getMessage());
            return redirect()->route('contactanos')->with('error', 'Ocurrió un error al enviar tu mensaje. Intenta de nuevo más tarde.');
        }
    }

    /**
     * Mostrar la página About Us
     */
    public function about()
    {
        return view('pages.about');
    }
}
