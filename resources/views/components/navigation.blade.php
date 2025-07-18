@props(['active'])

@php
    $classes = $active ? 'bg-blue-100 text-blue-700' : 'text-gray-600 hover:bg-gray-50';
@endphp

<a {{ $attributes->merge(['class' => "px-3 py-2 rounded-md " . $classes]) }}>
    {{ $slot }}
</a>
