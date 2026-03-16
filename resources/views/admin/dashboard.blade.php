@extends('layouts.admin')

@section('titulo', 'Dashboard')

@section('conteudo')
    <div class="mb-8">
        <h2 class="text-3xl font-extrabold text-blue-600 mb-2">Dashboard</h2>
        <p class="text-slate-500 text-base">Bem-vindo ao painel administrativo.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl">
        <div class="bg-white rounded-2xl shadow p-8 flex flex-col items-start">
            <div class="text-xs text-slate-400 uppercase mb-2">Gerenciar</div>
            <div class="text-xl font-bold text-slate-800 mb-4">Conteúdo da Landing</div>
            <a href="/admin/conteudo"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-base font-semibold px-6 py-3 rounded-lg transition">
                Editar Conteúdo
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow p-8 flex flex-col items-start">
            <div class="text-xs text-slate-400 uppercase mb-2">Relatório</div>
            <div class="text-xl font-bold text-slate-800 mb-4">Vendas Realizadas</div>
            <a href="/admin/pagamento"
               class="inline-block border border-blue-600 text-blue-600 hover:bg-blue-50 text-base font-semibold px-6 py-3 rounded-lg transition">
                Ver Vendas
            </a>
        </div>
    </div>
@endsection
