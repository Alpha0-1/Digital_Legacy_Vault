@extends('admin.layout')

@section('page-title', 'Editar beneficiario')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">Editar beneficiario</h1>
        
        <form action="{{ route('admin.beneficiaries.update', $beneficiary->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="bg-white shadow rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="name" value="{{ $beneficiary->name }}" required
                               class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                        <input type="email" name="email" value="{{ $beneficiary->email }}" required
                               class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Relación</label>
                        <input type="text" name="relationship" value="{{ $beneficiary->relationship }}" required
                               class="w-full p-2 border border-gray-300 rounded-md">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Preferencia de notificación</label>
                        <select name="notification_preference[]" multiple required
                                class="w-full p-2 border border-gray-300 rounded-md">
                            <option value="email" {{ in_array('email', $beneficiary->notification_preference) ? 'selected' : '' }}>Email</option>
                            <option value="sms" {{ in_array('sms', $beneficiary->notification_preference) ? 'selected' : '' }}>SMS</option>
                            <option value="push" {{ in_array('push', $beneficiary->notification_preference) ? 'selected' : '' }}>Push</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-6">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
                        Actualizar beneficiario
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
