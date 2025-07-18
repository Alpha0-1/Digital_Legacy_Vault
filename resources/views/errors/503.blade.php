@extends('layouts.guest')

@section('title', 'Service Unavailable')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="text-center">
                <h1 class="text-9xl font-bold text-red-600">503</h1>
                <h2 class="mt-4 text-2xl font-bold text-gray-900">
                    Service Unavailable
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    We are currently performing maintenance. Please try again later.
                </p>
            </div>
            
            <div class="mt-4">
                <div class="bg-blue-50 p-4 rounded-md">
                    <p class="text-sm text-blue-700">
                        You can check our status page for updates or contact support.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
