@extends('layouts.app')

@section('title', 'Lista de Pessoas')

@section('content')
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Lista de Pessoas</h1>
        <p class="text-gray-600">Gerencie as pessoas e seus contactos</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
         @auth
        <div class="px-6 py-4 border-b border-gray-200">
            <a href="{{ route('people.create') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-plus mr-2"></i>Nova Pessoa
            </a>
        </div>
        @endauth
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contatos
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($people as $person)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($person->avatar)
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                        {!! $person->avatar !!}
                                    </div>
                                @else
                                    <div
                                        class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                                        {{ substr($person->name, 0, 1) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $person->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $person->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $person->contacts_count }} contactos
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('people.show', $person->id) }}" class="text-blue-600 hover:text-blue-900">
                                    <i class="fas fa-eye"></i> Ver
                                </a>

                                @auth
                                    <a href="{{ route('people.edit', $person->id) }}" class="text-green-600 hover:text-green-900">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('people.destroy', $person->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Tem certeza que deseja eliminar esta pessoa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                Nenhuma pessoa encontrada. <a href="{{ route('people.create') }}"
                                    class="text-blue-600 hover:text-blue-800">Crie a primeira pessoa</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
