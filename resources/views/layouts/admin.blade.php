@extends('layouts.app')

@section('body')
    <div class="min-h-screen bg-gray-100">
        @include('admin.layouts.navigation')
        @include('admin.layouts.sidebar')

        <main class="py-6 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
@endsection
