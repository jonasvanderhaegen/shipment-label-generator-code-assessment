@props(['disabled' => false, 'field'])

<select

wire:loading.delay.long.attr="disabled"
wire:model.live.debounce.200ms="form.{{$field}}"
id="{{$field}}"
name="{{$field}}"
{{ $disabled ? 'disabled' : '' }}

class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-white dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
    {{ $slot }}
</select>
