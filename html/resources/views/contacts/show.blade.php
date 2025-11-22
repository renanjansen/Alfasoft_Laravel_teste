@extends('layouts.app')

@section('title', 'Detalhes do Contacto')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detalhes do Contacto</h1>
                <p class="text-gray-600">Informações completas do contacto</p>
            </div>
             @auth
            <div class="space-x-2">
                <a href="{{ route('contacts.edit', $contact->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
                    <i class="fas fa-edit mr-2"></i>Editar
                </a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('Tem certeza que deseja eliminar este contacto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium">
                        <i class="fas fa-trash mr-2"></i>Eliminar
                    </button>
                </form>
            </div>
            @endauth
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Informações do Contacto -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Informações do Contacto</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Número Completo</label>
                        <p class="text-lg font-semibold text-gray-900">+{{ $contact->country_code }} {{ chunk_split($contact->number, 3, ' ') }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Código do País</label>
                        <p class="text-gray-900">{{ $contact->country_code }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-600">Número</label>
                        <p class="text-gray-900">{{ $contact->number }}</p>
                    </div>
                </div>
            </div>

            <!-- Informações da Pessoa -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Pessoa Associada</h2>

                <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                    <div class="flex items-center mb-3">
                        @if($contact->person->avatar)
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                {!! $contact->person->avatar !!}
                            </div>
                        @else
                            <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-lg mr-3">
                                {{ substr($contact->person->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h3 class="font-medium text-gray-900">{{ $contact->person->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $contact->person->email }}</p>
                        </div>
                    </div>

                    <a href="{{ route('people.show', $contact->person_id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        <i class="fas fa-external-link-alt mr-1"></i>Ver detalhes da pessoa
                    </a>
                </div>
            </div>
        </div>

        <!-- Informações Adicionais -->
        <div class="mt-6 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-800 mb-3">Informações Adicionais</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                <div>
                    <label class="block text-gray-600">ID do Contacto</label>
                    <p class="text-gray-900">{{ $contact->id }}</p>
                </div>
                <div>
                    <label class="block text-gray-600">Criado em</label>
                    <p class="text-gray-900">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-gray-600">Atualizado em</label>
                    <p class="text-gray-900">{{ $contact->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('people.show', $contact->person_id) }}" class="text-blue-600 hover:text-blue-800 font-medium">
            <i class="fas fa-arrow-left mr-2"></i>Voltar para a pessoa
        </a>
    </div>
</div>
@endsection
