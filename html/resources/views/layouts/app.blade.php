<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Alfasoft</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <a href="{{ route('people.index') }}" class="text-xl font-bold">
                    <i class="fas fa-address-book mr-2"></i>Alfasoft Contatos
                </a>
                <div class="space-x-4">
                    <a href="{{ route('people.index') }}" class="hover:text-blue-200">
                        <i class="fas fa-users mr-1"></i>Pessoas
                    </a>
                    </a>


                    <a href="{{ route('stats.contacts-by-country') }}" class="hover:text-blue-200">
                        <i class="fas fa-chart-bar mr-1"></i>Estatísticas
                    </a>

                    @auth
                        <a href="{{ route('people.create') }}" class="hover:text-blue-200">
                            <i class="fas fa-plus mr-1"></i>Nova Pessoa
                        </a>
                        <span class="text-blue-200">
                            <i class="fas fa-user mr-1"></i>{{ Auth::user()->name }}
                        </span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-blue-200">
                                <i class="fas fa-sign-out-alt mr-1"></i>Sair
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-blue-200">
                            <i class="fas fa-sign-in-alt mr-1"></i>Entrar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-gray-800 text-white py-4 fixed bottom-0 left-0 w-full">
        <div class="container mx-auto px-4 text-center">
            <p>&copy; 2025 Alfasoft. Teste Laravel.</p>
        </div>
    </footer>
</body>

</html>
