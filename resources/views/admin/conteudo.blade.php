@extends('layouts.admin')

@section('titulo', 'Editar Conteúdo')

@section('conteudo')
    <div class="flex flex-col md:flex-row gap-10 max-w-5xl mx-auto bg-white rounded-2xl shadow p-10">
        <!-- Preview ou instruções -->
        <div class="flex-1 flex flex-col justify-center mb-8 md:mb-0">
            <h2 class="text-2xl font-extrabold text-blue-600 mb-4">Editar Conteúdo da Landing</h2>
            <p class="text-slate-500 mb-6">
                Altere os textos e imagens que aparecem na página principal do site. As mudanças são salvas imediatamente
                após clicar em "Salvar".
            </p>
            @if (!empty($conteudo->imagem) && file_exists(public_path('storage/' . $conteudo->imagem)))
                <div class="flex justify-center">
                    <img src="{{ asset('storage/' . $conteudo->imagem) }}" alt="Preview"
                        class="max-w-xs max-h-60 rounded-xl shadow mb-4 object-contain bg-slate-100 border border-slate-200" />
                </div>
            @else
                <div class="flex justify-center">
                    <div
                        class="w-full max-w-xs h-60 flex items-center justify-center rounded-xl shadow mb-4 bg-slate-100 border border-slate-200 text-slate-400 text-sm">
                        Nenhuma imagem enviada
                    </div>
                </div>
            @endif
        </div>

        <!-- Formulário de edição -->
        <form method="POST" action="/admin/conteudo" enctype="multipart/form-data" class="flex-1 flex flex-col gap-6">
            @csrf

            @if (session('success'))
                <div class="bg-green-50 text-green-700 border border-green-200 rounded-lg px-4 py-2 text-sm mb-2">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 text-red-700 border border-red-200 rounded-lg px-4 py-2 text-sm mb-2">
                    {{ session('error') }}
                </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Título</label>
                <input type="text" name="titulo" value="{{ old('titulo', $conteudo->titulo ?? '') }}"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Subtítulo</label>
                <input type="text" name="subtitulo" value="{{ old('subtitulo', $conteudo->subtitulo ?? '') }}"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Descrição</label>
                <textarea name="descricao" rows="3"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required>{{ old('descricao', $conteudo->descricao ?? '') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Imagem principal</label>
                <input type="file" name="imagem"
                    class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    accept="image/*">
            </div>
            <div> <label class="block text-sm font-semibold text-slate-700 mb-1">Preço</label> <input type="number"
                    name="preco" step="0.01" min="0" value="{{ old('preco', $conteudo->preco ?? 0) }}"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-base focus:outline-none focus:ring-2 focus:ring-blue-400"
                    required> </div>

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 transition">
                Salvar
            </button>
        </form>
    </div>

@endsection
