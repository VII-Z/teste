@extends('layouts.admin')
@section('titulo', 'Vendas')
@section('conteudo')
<div class="mb-8">
    <h2 class="text-3xl font-extrabold text-blue-600 mb-2">Relatório de Vendas</h2>
    <p class="text-slate-500 text-base">Acompanhe todas as compras realizadas.</p>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-slate-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">#</th>
                <th class="px-4 py-3 text-left">Cliente</th>
                <th class="px-4 py-3 text-left">E-mail</th>
                <th class="px-4 py-3 text-left">Produto</th>
                <th class="px-4 py-3 text-left">Valor</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Data</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($vendas as $venda)
            <tr class="hover:bg-slate-50">
                <td class="px-4 py-3 text-slate-400">{{ $venda->id }}</td>
                <td class="px-4 py-3 font-medium text-slate-800">{{ $venda->nome_cliente }}</td>
                <td class="px-4 py-3 text-slate-500">{{ $venda->email_cliente }}</td>
                <td class="px-4 py-3">{{ $venda->produto }}</td>
                <td class="px-4 py-3 font-semibold">R$ {{ number_format($venda->preco, 2, ',', '.') }}</td>
                <td class="px-4 py-3">
                    @if($venda->status === 'approved')
                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs font-semibold">Aprovado</span>
                    @elseif($venda->status === 'pending')
                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs font-semibold">Pendente</span>
                    @else
                        <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded-full text-xs font-semibold">{{ $venda->status }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-slate-400">{{ $venda->created_at->format('d/m/Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-10 text-center text-slate-400">Nenhuma venda registrada ainda.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

