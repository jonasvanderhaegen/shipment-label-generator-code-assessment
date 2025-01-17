<html lang="en">

<head>
    <title>Invoice</title>
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="#" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <h2 class="text-m font-semibold text-gray-900 dark:text-white">Shipment summary</h2>
            <h5 class="text-xs font-semibold text-gray-900 dark:text-white">Combination product: {{ $shipment->combination->name }}</h5>
            <a href="{{ $shipment->api_tracking_url }}" class="text-xs text-gray-900 dark:text-white">Tracking url: {{ $shipment->api_tracking_url }}</a>


            <div class="mt-8 space-y-6 md:space-y-8">
                <div class="grid gap-6 md:gap-8 grid-cols-2">

                    <div
                        class="space-y-4 border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                        <h4 class="text-s font-semibold text-gray-900 dark:text-white">Billing information</h4>

                        <dl>
                            <dt class="text-xs font-medium text-gray-900 dark:text-white">{{ $shipment->billing_name }}</dt>
                            <dt class="text-xs font-medium text-gray-900 dark:text-white">{{ $shipment->billing_company_name }}</dt>
                            <dd class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">{{ $shipment->billing_street }} {{ $shipment->billing_housenumber }}<br>
                                {{ $shipment->billing_zipcode }} {{ $shipment->billing_city }}<br>{{ $shipment->billing_country }}</dd>
                        </dl>

                    </div>

                    <div
                        class="space-y-4 border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                        <h4 class="text-s font-semibold text-gray-900 dark:text-white">Delivery information</h4>

                        <dl>
                            <dt class="text-xs font-medium text-gray-900 dark:text-white">{{ $shipment->delivery_name }}</dt>
                            <dt class="text-xs font-medium text-gray-900 dark:text-white">{{ $shipment->delivery_company_name }}</dt>
                            <dd class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">{{ $shipment->delivery_street }} {{ $shipment->delivery_housenumber }}<br>
                                {{ $shipment->delivery_zipcode }} {{ $shipment->delivery_city }}<br>{{ $shipment->delivery_country }}</dd>
                        </dl>

                    </div>

                    {{-- <div
                        class="space-y-4 border border-gray-200 bg-white p-6 dark:border-gray-700 dark:bg-gray-800">
                        <h4 class="text-s font-semibold text-gray-900 dark:text-white">Tracking</h4>
                        <p class="text-xs font-medium text-gray-900 dark:text-white">id: {{ $shipment->api_tracking_id }}</p>

                    </div> --}}
                </div>

                <div
                    class="divide-y divide-gray-200 border border-gray-200 bg-white dark:divide-gray-700 dark:border-gray-700 dark:bg-gray-800">


                        <div class="relative overflow-x-auto">
                            <table class="w-full text-xs text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-2 text-xs">
                                            Name
                                        </th>
                                        <th scope="col" class="px-4 py-2 text-xs">
                                            SKU
                                        </th>
                                        <th scope="col" class="px-4 py-2 text-xs">
                                            Amount
                                        </th>
                                        <th scope="col" class="px-4 py-2 text-xs">
                                            Check
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order_lines as $line)
                                    <tr class="bg-white text-xs border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 text-xs font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $line['name'] }}
                                        </th>
                                        <td class="px-4 py-2 text-xs">
                                            {{ $line['sku'] }}
                                        </td>
                                        <td class="px-4 py-2 text-xs">
                                            {{ $line['amount_ordered'] }}
                                        </td>
                                        <td class="px-4 py-2">
                                            <input id="terms" type="checkbox" value="" class="w-8 h-8 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </form>
    </section>

</body>

</html>
