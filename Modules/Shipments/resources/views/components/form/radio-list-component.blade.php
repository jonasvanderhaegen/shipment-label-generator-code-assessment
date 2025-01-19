@props([ 'label' ])

<div>
    <h3 class="mb-5 text-lg font-medium text-gray-900 dark:text-white">{{ __("shipments::$label") }}</h3>
    <ul class="grid w-full gap-6 md:grid-cols-2">
        {!! $slot !!}
    </ul>
</div>
