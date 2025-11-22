@extends('layouts.app')

@section('title', 'Estatísticas - Contactos por País')

@section('content')
<div class="mb-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Estatísticas</h1>
            <p class="text-gray-600">Contactos organizados por país</p>
        </div>
        <div class="flex space-x-4">
            <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg text-center">
                <div class="text-2xl font-bold">{{ $totalContacts }}</div>
                <div class="text-sm">Total Contactos</div>
            </div>
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg text-center">
                <div class="text-2xl font-bold">{{ $uniqueCountries }}</div>
                <div class="text-sm">Países</div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h2 class="text-xl font-semibold text-gray-800">Distribuição de Contactos por País</h2>
    </div>

    @if($stats->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            País
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Código
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nº de Contactos
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Percentagem
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($stats as $stat)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $stat['country_name'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                +{{ $stat['country_code'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 font-semibold">{{ $stat['total'] }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-24 bg-gray-200 rounded-full h-2.5 mr-2">
                                    <div class="bg-blue-600 h-2.5 rounded-full"
                                         style="width: {{ ($stat['total'] / $totalContacts) * 100 }}%">
                                    </div>
                                </div>
                                <span class="text-sm text-gray-600">
                                    {{ number_format(($stat['total'] / $totalContacts) * 100, 1) }}%
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('people.index') }}?country={{ $stat['country_code'] }}"
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-users mr-1"></i>Ver Pessoas
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm font-semibold text-gray-900 text-right">
                            Total:
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                            {{ $totalContacts }}
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                            100%
                        </td>
                        <td class="px-6 py-4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @else
        <div class="text-center py-12">
            <i class="fas fa-chart-pie text-4xl text-gray-300 mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Sem dados estatísticos</h3>
            <p class="text-gray-500 mb-4">Ainda não existem contactos registados no sistema.</p>
            <a href="{{ route('people.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fas fa-users mr-2"></i>Ver Pessoas
            </a>
        </div>
    @endif
</div>

<!-- Gráfico simples -->
@if($stats->count() > 0)
<div class="mt-8 bg-white rounded-lg shadow p-6">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Distribuição Visual</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($stats->take(5) as $stat)
        <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
            <span class="text-sm font-medium text-gray-700">{{ $stat['country_name'] }}</span>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">{{ $stat['total'] }}</span>
                <div class="w-16 bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full"
                         style="width: {{ ($stat['total'] / $totalContacts) * 100 }}%">
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
