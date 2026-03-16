<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Admin;
use App\Models\Conteudo;
use App\Models\Vendas;
use App\Models\Config;


class AdminControle extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->senha)) {
            session(['admin_id' => $admin->id]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Credenciais inválidas')->withInput();
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function editarConteudo()
    {
        $conteudo = Conteudo::first();
        if (!$conteudo) {
            $conteudo = Conteudo::create([
                'titulo' => '',
                'subtitulo' => '',
                'descricao' => '',
                'imagem' => '',
                'preco' => 0,
            ]);
        }

        $config = Config::first();
        if (!$config) {
            $config = new Config();
            $config->email = '';
            $config->telefone = '';
            $config->save();
        }

        return view('admin.conteudo', compact('conteudo', 'config'));
    }



    public function atualizarConteudo(Request $request)
    {
        $conteudo = Conteudo::first();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem')->store('conteudo', 'public');
            $conteudo->imagem = $imagem;
        }

        $conteudo->titulo = $request->titulo;
        $conteudo->subtitulo = $request->subtitulo;
        $conteudo->descricao = $request->descricao;
        $conteudo->preco = $request->preco;
        $conteudo->save();

        $config = Config::first();
        if (!$config) {
            $config = new Config();
        }
        $config->email = $request->email_contato;
        $config->telefone = $request->telefone_contato;
        $config->save();

        return back()->with('success', 'Conteúdo atualizado!');
    }

    public function pagamento()
    {
        $vendas = Vendas::all();
        return view('admin.pagamento', compact('vendas'));
    }

    public function logout()
    {
        session()->forget('admin_id');
        return redirect('/admin')->with('success', 'Logout realizado com sucesso.');
    }
}
