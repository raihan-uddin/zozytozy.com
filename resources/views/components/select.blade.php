@props(['disabled' => false, 'multiple' => false])

<select {{ $disabled ? 'disabled' : '' }} {{ $multiple ? 'multiple' : '' }} {!! $attributes->merge(['class' => 'w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) !!}>
    {{ $slot }}
</select>
