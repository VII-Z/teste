<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $conteudo->titulo ?? 'Produto' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: Inter, sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    <header class="sticky top-0 z-30 border-b border-slate-200/80 bg-white/90 backdrop-blur">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-16 flex items-center justify-between">
                <a href="/" class="font-extrabold text-xl tracking-tight text-slate-900">Logo</a>

                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-600">
                    <a href="#produto" class="hover:text-slate-900 transition">Produto</a>
                    <a href="#beneficios" class="hover:text-slate-900 transition">Benefícios</a>
                    <a href="#checkout" class="hover:text-slate-900 transition">Comprar</a>
                    <a href="#contato" class="hover:text-slate-900 transition">Contato</a>
                </nav>

                <div class="flex items-center gap-2">
                    <a href="/admin"
                        class="text-sm font-semibold text-slate-700 hover:text-slate-900 transition">Login</a>
                    <a href="/admin"
                        class="text-sm font-semibold px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 transition">
                        Administração
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="produto" class="relative overflow-hidden bg-gradient-to-b from-sky-100 to-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-20">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">

                    <div class="lg:col-span-7">
                        <p
                            class="inline-flex items-center rounded-full bg-white border border-slate-200 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-slate-600">
                            Produto digital
                        </p>

                        <h1
                            class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight text-slate-900">
                            {{ $conteudo->titulo ?? 'Título do produto' }}
                        </h1>

                        <p class="mt-5 text-xl sm:text-2xl font-medium text-slate-700">
                            {{ $conteudo->subtitulo ?? 'Subtítulo do produto' }}
                        </p>

                        <p class="mt-4 max-w-2xl text-base sm:text-lg leading-relaxed text-slate-600">
                            {{ $conteudo->descricao ?? 'Descrição do produto.' }}
                        </p>

                        <section id="beneficios" class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-3 max-w-2xl">
                            <div
                                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                Compra rápida e simples</div>
                            <div
                                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                Acesso imediato ao conteúdo</div>
                            <div
                                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                Pagamento seguro</div>
                            <div
                                class="rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700">
                                Suporte por contato</div>
                        </section>
                    </div>

                    <aside id="checkout" class="lg:col-span-5">
                        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="text-2xl font-bold text-slate-900">Finalizar compra</h2>
                            <p class="mt-1 text-sm text-slate-500">Pagamento seguro via Stripe</p>

                            @if (session('success'))
                                <div
                                    class="mt-4 rounded-lg border border-green-200 bg-green-50 px-4 py-2 text-sm text-green-700">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div
                                    class="mt-4 rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm text-red-700">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="mt-5 text-sm text-slate-500">Preço</div>
                            <div class="text-4xl font-extrabold text-slate-900">
                                R$ {{ number_format($conteudo->preco ?? 0, 2, ',', '.') }}
                            </div>

                            <form method="POST" action="/checkout/criar" class="mt-5 space-y-3">
                                @csrf
                                <input type="text" name="nome" placeholder="Seu nome"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300"
                                    required>
                                <input type="email" name="email" placeholder="seu@email.com"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-300"
                                    required>
                                <button type="submit"
                                    class="w-full rounded-xl bg-slate-900 py-3 text-white font-bold hover:bg-slate-800 transition">
                                    Comprar agora
                                </button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-14">
            <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-6">
                @if ($conteudo->imagem ?? false)
                    <img src="{{ asset('storage/' . $conteudo->imagem) }}" alt="Imagem do produto"
                        class="w-full rounded-xl object-cover max-h-[500px]">
                @else
                    <div
                        class="h-72 sm:h-96 rounded-xl bg-gradient-to-br from-slate-100 to-sky-100 flex items-center justify-center text-slate-500">
                        Imagem do produto
                    </div>
                @endif
            </div>
        </section>
    </main>

    <footer id="contato" class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-slate-600 text-center">
            <p>Contato: {{ $config->email ?? 'contato@exemplo.com' }}</p>
            <p>Telefone: {{ $config->telefone ?? '(00) 0000-0000' }}</p>
        </div>
    </footer>

</body>

</html>
