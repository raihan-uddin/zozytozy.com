@props([
    'disabled' => false,
    'error' => null,
])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => ($error ? 'border-red-400' : 'border-gray-300') . ' focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
