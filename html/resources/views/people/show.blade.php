@extends('layouts.app')

@section('title', $person->name)

@section('content')
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $person->name }}</h1>
                <p class="text-gray-600">{{ $person->email }}</p>
            </div>
            <div class="space-x-2">
    @auth
    <a href="{{ route('contacts.create', $person->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-phone-alt mr-2"></i>Novo Contacto
    </a>
    <a href="{{ route('people.edit', $person->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-edit mr-2"></i>Editar
    </a>
    <form action="{{ route('people.destroy', $person->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja eliminar esta pessoa?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fas fa-trash mr-2"></i>Eliminar
        </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
        <i class="fas fa-sign-in-alt mr-2"></i>Entrar para editar
    </a>
    @endauth
</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Informações da Pessoa -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Informações</h2>

            <div class="flex items-center mb-6">
                @if($person->avatar)
                    <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                        {!! $person->avatar !!}
                    </div>
                @else
                    <div
                        class="w-20 h-20 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-2xl mr-4">
                        {{ substr($person->name, 0, 1) }}
                    </div>
                @endif
                <div>
                    <h3 class="text-lg font-medium text-gray-900">{{ $person->name }}</h3>
                    <p class="text-gray-600">{{ $person->email }}</p>
                </div>
            </div>

            <div class="text-sm text-gray-500">
                <p><strong>ID:</strong> {{ $person->id }}</p>
                <p><strong>Criado em:</strong> {{ $person->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Atualizado em:</strong> {{ $person->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <!-- Lista de Contactos -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Contactos</h2>
                <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ $person->contacts->count() }} contactos
                </span>
            </div>

            @if($person->contacts->count() > 0)
                <div class="space-y-4">
                    @foreach($person->contacts as $contact)
                        <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="font-medium text-gray-900">+{{ $contact->country_code }}
                                        {{ chunk_split($contact->number, 3, ' ') }}</h3>
                                    <p class="text-sm text-gray-600">Código do País: {{ $contact->country_code }}</p>
                                </div>
                                <div class="space-x-2">
                                    <a href="{{ route('contacts.show', $contact->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                     @auth
                                    <a href="{{ route('contacts.edit', $contact->id) }}"
                                        class="text-green-600 hover:text-green-800 text-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar este contacto?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-phone-slash text-4xl mb-4 text-gray-300"></i>
                    <p class="text-lg mb-4">Nenhum contacto encontrado</p>
                    <a href="{{ route('contacts.create', $person->id) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-plus mr-2"></i>Adicionar Primeiro Contacto
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
