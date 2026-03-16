<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Admin')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans min-h-screen">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex flex-col py-8 px-6">
            <div class="mb-10">
                <span class="text-2xl font-extrabold text-blue-600">Administração</span>
            </div>
            <nav class="flex flex-col gap-2">
                <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg font-semibold text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                    <span>🏠</span> Dashboard
                </a>
                <a href="/admin/conteudo" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 transition">
                    <span>📝</span> Conteúdo
                </a>
                <a href="/admin/pagamento" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-700 hover:bg-blue-50 transition">
                    <span>💳</span> Pagamentos
                </a>
                <form method="POST" action="/admin/logout" class="mt-8">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition w-full text-left">
                        <span>🚪</span> Sair
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Conteúdo principal -->
        <main class="flex-1 p-10">
            @yield('conteudo')
        </main>
    </div>

</body>
</html>