@props(['disabled' => false, 'class' => '', 'field', 'label'])

<div class="{{ $class }}">
    <div class="relative z-0">
        <x-shipments::form.input field="{{$field}}" />
        <x-shipments::form.label field="{{$field}}" :label="$label" />
    </div>
    <x-shipments::form.error field="form.{{$field}}" class="mt-2" />
</div>
