<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Services\PayPalService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayPalController extends Controller
{
    public function __construct(
        protected PayPalService $paypal
    ) {}

    public function start(Partido $partido): RedirectResponse
    {
        abort_unless(auth()->id() === $partido->user_id, 403);
        abort_if($partido->fecha_hora->isPast(), 403, 'Este partido ya ha finalizado.');
        abort_if($partido->pago_aprobado, 400, 'Este partido ya está pagado.');

        if (! $this->paypal->isConfigured()) {
            return back()->with('error', 'PayPal no está configurado.');
        }

        try {
            $order = $this->paypal->createOrder($partido);
            $approveUrl = collect($order['links'] ?? [])
                ->first(fn (array $link) => ($link['rel'] ?? '') === 'approve')['href'] ?? null;

            if (! $approveUrl) {
                return back()->with('error', 'No se pudo iniciar el pago con PayPal.');
            }

            return redirect()->away($approveUrl);
        } catch (\Throwable $e) {
            Log::error('PayPal start error', ['partido_id' => $partido->id, 'message' => $e->getMessage()]);

            return back()->with('error', 'No se pudo conectar con PayPal. Inténtalo de nuevo.');
        }
    }

    public function return(Request $request, Partido $partido): RedirectResponse
    {
        abort_unless(auth()->id() === $partido->user_id, 403);
        abort_if($partido->fecha_hora->isPast(), 403, 'Este partido ya ha finalizado.');

        if ($partido->pago_aprobado) {
            return redirect()->route('partidos.show', $partido)
                ->with('success', 'La pista ya estaba pagada.');
        }

        $orderId = $request->query('token');

        if (! $orderId) {
            return redirect()->route('partidos.show', $partido)
                ->with('error', 'No se recibió la confirmación de PayPal.');
        }

        if (! $this->paypal->isConfigured()) {
            return redirect()->route('partidos.show', $partido)
                ->with('error', 'PayPal no está configurado.');
        }

        try {
            $capture = $this->paypal->captureOrder($orderId);

            if (! $this->paypal->verifyCaptureForPartido($capture, $partido)) {
                return redirect()->route('partidos.show', $partido)
                    ->with('error', 'El pago no pudo verificarse.');
            }

            $partido->pago_aprobado = true;
            $partido->save();

            return redirect()->route('partidos.show', $partido)
                ->with('success', 'Pista pagada correctamente.');
        } catch (\Throwable $e) {
            Log::error('PayPal capture error', ['partido_id' => $partido->id, 'order_id' => $orderId, 'message' => $e->getMessage()]);

            return redirect()->route('partidos.show', $partido)
                ->with('error', 'No se pudo completar el pago. Inténtalo de nuevo.');
        }
    }

    public function cancel(Partido $partido): RedirectResponse
    {
        abort_unless(auth()->id() === $partido->user_id, 403);

        return redirect()->route('partidos.show', $partido)
            ->with('info', 'Has cancelado el pago. Puedes pagar la pista más tarde.');
    }
}
