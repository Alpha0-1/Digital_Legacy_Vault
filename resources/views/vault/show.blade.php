@extends('layouts.app')

@section('title', 'Vault Details')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-6">{{ $vault->title }}</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="col-span-2">
                        <h2 class="text-lg font-semibold mb-4">Items</h2>
                        @if($vault->legacyItems->isEmpty())
                            <p>No items in this vault</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($vault->legacyItems as $item)
                                    <li class="bg-gray-50 p-3 rounded-md">
                                        <div class="flex justify-between">
                                            <span>{{ $item->title }}</span>
                                            <span class="text-sm text-gray-500">{{ $item->item_type }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Beneficiaries</h2>
                        @if($vault->beneficiaries->isEmpty())
                            <p>No beneficiaries assigned</p>
                        @else
                            <ul class="space-y-2">
                                @foreach($vault->beneficiaries as $beneficiary)
                                    <li class="bg-gray-50 p-3 rounded-md">
                                        <div>{{ $beneficiary->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $beneficiary->email }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
