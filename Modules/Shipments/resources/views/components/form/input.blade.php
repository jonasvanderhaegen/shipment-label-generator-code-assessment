@props(['disabled' => false, 'field'])

@php
    $textColor = "text-gray-900";
    $darkTextColor = "dark:text-white";

    $disabledTextColor = "disabled:gray-600";
    $darkDisabledTextColor = "dark:disabled:text-gray-600";

    $borderColor = "border-gray-300";
    $darkBorderColor = "dark:border-gray-600";

    $borderColorFocus = "focus:border-blue-600";
    $darkBorderColorFocus = "dark:focus:border-blue-500";

    if ($errors->has("form.${field}")) {
        $textColor = "text-red-600";
        $borderColor = "text-red-600";
        $borderColorFocus = "focus:border-red-600";
        $disabledTextColor = "disabled:text-red-600";

        $darkTextColor = "dark:text-red-500";
        $darkBorderColor = "dark:border-red-500";
        $darkBorderColorFocus = "dark:focus:border-red-500";
        $darkDisabledTextColor = "dark:disabled:text-red-500";
    }

    $inputClasses = "block py-2.5 px-0 w-full text-sm $textColor bg-transparent border-0 border-b-2 $borderColor appearance-none $darkTextColor $darkBorderColor $darkBorderColorFocus $darkTextColor focus:outline-none focus:ring-0 $borderColorFocus $textColor disabled:opacity-20 $disabledTextColor $darkDisabledTextColor peer";

@endphp

<input type="text"
wire:loading.delay.long.attr="disabled"
wire:model.live.debounce.200ms="form.{{$field}}"
id="{{$field}}"
name="{{$field}}"
{{ $disabled ? 'disabled' : '' }}
{!! $attributes->merge(
    [
        'class' => $inputClasses
    ])
!!}
placeholder="" />
