@props(['field'])

@php

$visiblity = '';

if (!$errors->has("form.${field}")) $visibility = "invisible";

$inputClasses = "mt-2 text-xs text-red-600 dark:text-red-400 $visiblity";

@endphp

<p {{ $attributes->merge(['class' => $inputClasses]) }}>@error($field) {{ $message }} @enderror</p>
