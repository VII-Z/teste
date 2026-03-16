<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 font-sans min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-10">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold text-blue-600 mb-2">Login Administrativo</h1>
            <p class="text-slate-500 text-sm">Insira suas credenciais para acessar.</p>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-700 border border-red-200 rounded-lg px-4 py-2 text-sm mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="/admin/login" class="flex flex-col gap-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">E-mail</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="admin@exemplo.com" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Senha</label>
                <input type="password" name="password"
                    class="w-full border border-slate-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="••••••••" required>
            </div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg py-3 transition">
                Entrar
            </button>
        </form>
    </div>

</body>
</html>
