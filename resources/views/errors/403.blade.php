@extends('layouts.guest')

@section('title', 'Acceso denegado')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-9xl font-bold text-red-600">403</h1>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">
                    Acceso denegado
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    No tienes permisos para acceder a este recurso
                </p>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('dashboard') }}" 
                   class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>
@endsection
