@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-amber-100 border-yellow-300 focus:border-yellow-500 focus:ring-yellow-500 rounded-md shadow-sm']) !!}>
