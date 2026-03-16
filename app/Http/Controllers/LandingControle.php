<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Conteudo;
use App\Models\Vendas;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class LandingControle extends Controller
{
    public function index()
    {
        $conteudo = Conteudo::first();
        $config = Config::first();
        return view('landing', compact('conteudo', 'config'));
    }
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->senha)) {
            return back()->with('error', 'Credenciais inválidas')->withInput();
        }

        session(['admin_id' => $admin->id]);
        return redirect('/admin/dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function criarCheckout(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $conteudo = Conteudo::first();

        if (!$conteudo) {
            return back()->with('error', 'Produto não configurado.');
        }

        if (!env('STRIPE_SECRET')) {
            return back()->with('error', 'STRIPE_SECRET não configurado no .env.');
        }

        $venda = Vendas::create([
            'nome_cliente' => $request->nome,
            'email_cliente' => $request->email,
            'produto' => $conteudo->titulo ?? 'Produto',
            'preco' => (float) ($conteudo->preco ?? 0),
            'status' => 'pending',
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'mode' => 'payment',
            'customer_email' => $venda->email_cliente,
            'metadata' => [
                'venda_id' => (string) $venda->id,
            ],
            'line_items' => [[
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'brl',
                    'unit_amount' => (int) round($venda->preco * 100),
                    'product_data' => [
                        'name' => $venda->produto,
                    ],
                ],
            ]],
            'success_url' => env('APP_URL') . '/checkout/sucesso?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('APP_URL') . '/checkout/falha',
        ]);

        return redirect()->away($session->url);
    }

    public function checkoutSucesso(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return redirect('/')->with('error', 'Sessão de pagamento não identificada.');
        }

        if (!env('STRIPE_SECRET')) {
            return redirect('/')->with('error', 'STRIPE_SECRET não configurado no .env.');
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = StripeSession::retrieve($sessionId);

        $vendaId = $session->metadata->venda_id ?? null;
        $paymentStatus = $session->payment_status ?? 'unpaid';

        if ($vendaId) {
            $statusFinal = $paymentStatus === 'paid' ? 'approved' : $paymentStatus;
            Vendas::where('id', $vendaId)->update(['status' => $statusFinal]);
        }

        return redirect('/')->with('success', 'Pagamento confirmado com status: ' . $paymentStatus);
    }

    public function checkoutFalha()
    {
        return redirect('/')->with('error', 'Pagamento cancelado ou não concluído.');
    }

    public function checkoutPendente()
    {
        return redirect('/')->with('error', 'Pagamento pendente.');
    }
}
