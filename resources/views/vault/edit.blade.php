@extends('layouts.app')

@section('title', 'Edit Vault')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">Edit Vault</h1>
                
                <form action="{{ route('vault.update', $vault) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Vault Title</label>
                        <input type="text" id="title" name="title" value="{{ $vault->title }}" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description"
                                  class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            {{ $vault->description }}
                        </textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label for="security_level" class="block text-sm font-medium text-gray-700">Security Level</label>
                        <select id="security_level" name="security_level" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="low" @if($vault->security_level === 'low') selected @endif>Low</option>
                            <option value="medium" @if($vault->security_level === 'medium') selected @endif>Medium</option>
                            <option value="high" @if($vault->security_level === 'high') selected @endif>High</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end">
                        <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Update Vault
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
