@props(['disabled' => false, 'field', 'label'])


@php
    $textColor = 'text-gray-900';
    $darkTextColor = 'dark:text-white';
    $disabledClass = '';

    if ($disabled) $disabledClass = 'opacity-20';

    if ($errors->has("form.${field}")) {
        $textColor = 'text-red-600';
        $darkTextColor = 'dark:text-red-500';
    }

    $inputClasses = "absolute text-sm $disabledClass $textColor $darkTextColor duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto";

@endphp

<label
{{ $disabled ? 'disabled' : '' }}
{{ $attributes->merge(['class' => $inputClasses]) }}>


    {{ __("shipments::$label") ?? $slot }}
</label>
