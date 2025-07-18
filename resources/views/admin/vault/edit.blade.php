@extends('admin.layout')

@section('page-title', 'Editar caja de legado')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Editar caja de legado</h1>
        
        <form action="{{ route('admin.vault.update', $vault->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" name="title" value="{{ $vault->title }}" required
                               class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="description" rows="4"
                                class="w-full p-2 border border-gray-300 rounded-md">{{ $vault->description }}</textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nivel de seguridad</label>
                        <select name="security_level" required
                                class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="low" {{ $vault->security_level === 'low' ? 'selected' : '' }}>Bajo</option>
                            <option value="medium" {{ $vault->security_level === 'medium' ? 'selected' : '' }}>Medio</option>
                            <option value="high" {{ $vault->security_level === 'high' ? 'selected' : '' }}>Alto</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        Actualizar caja de legado
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
