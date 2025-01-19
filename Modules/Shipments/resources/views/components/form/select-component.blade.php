@props(['disabled' => false, 'class' => '', 'field', 'label'])

<div class="{{ $class }}">
        <x-shipments::form.label field="{{$field}}" :label="$label" />

        <x-shipments::form.select field="{{$field}}">
            {{ $slot }}
        </x-shipments::form.select>
</div>
