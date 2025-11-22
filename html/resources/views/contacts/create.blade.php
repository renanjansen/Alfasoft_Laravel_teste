@extends('layouts.app')

@section('title', 'Novo Contacto para ' . $person->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Novo Contacto</h1>
        <p class="text-gray-600">Adicione um contacto para {{ $person->name }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('contacts.store') }}" method="POST">
            @csrf
            <input type="hidden" name="person_id" value="{{ $person->id }}">

            <div class="mb-4">
                <label for="country_code" class="block text-sm font-medium text-gray-700 mb-2">País *</label>
                <select name="country_code" id="country_code"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('country_code') border-red-500 @enderror"
                    required>
                    <option value="">Selecione um país</option>
                    @foreach($countries as $country)
                        <option value="{{ $country['code'] }}" {{ old('country_code') == $country['code'] ? 'selected' : '' }}>
                            {{ $country['display'] }}
                        </option>
                    @endforeach
                </select>
                @error('country_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="number" class="block text-sm font-medium text-gray-700 mb-2">Número de Telefone *</label>
                <input type="text" name="number" id="number" value="{{ old('number') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('number') border-red-500 @enderror"
                    placeholder="123456789"
                    required maxlength="9" pattern="[0-9]{9}" title="Digite exatamente 9 dígitos">
                <p class="text-sm text-gray-500 mt-1">Digite exatamente 9 dígitos (apenas números)</p>
                @error('number')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <a href="{{ route('people.show', $person->id) }}" class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>Voltar
                </a>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium">
                    <i class="fas fa-save mr-2"></i>Criar Contacto
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Validação client-side para garantir 9 dígitos
document.getElementById('number').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
    if (this.value.length > 9) {
        this.value = this.value.slice(0, 9);
    }
});
</script>
@endsection
