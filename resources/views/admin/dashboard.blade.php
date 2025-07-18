@extends('admin.layouts.app')

@section('title', 'Panel de administración')

@section('content')
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Usuarios</h2>
                <div class="flex justify-between items-center">
                    <span>{{ $userCount ?? 0 }}</span>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">Ver detalles</a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Cajas de legado</h2>
                <div class="flex justify-between items-center">
                    <span>{{ $vaultCount ?? 0 }}</span>
                    <a href="{{ route('admin.vaults.index') }}" class="text-blue-600 hover:underline">Ver detalles</a>
                </div>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold mb-4">Sistema</h2>
                <div class="flex justify-between items-center">
                    <span>Versión: 1.0.0</span>
                    <a href="{{ route('admin.system.settings') }}" class="text-blue-600 hover:underline">Configuración</a>
                </div>
            </div>
        </div>
    </div>
@endsection
