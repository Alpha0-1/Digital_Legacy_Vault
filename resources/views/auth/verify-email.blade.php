@extends('layouts.guest')

@section('title', 'Verify Email')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                    Verify Your Email
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    A verification link has been sent to your email
                </p>
            </div>

            <div class="mt-8">
                <div class="bg-blue-50 p-4 rounded-md">
                    <p class="text-sm text-blue-700">
                        If you haven't received the verification email, check your spam folder or request a new one.
                    </p>
                    <form action="{{ route('verification.send') }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                            Resend Verification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
