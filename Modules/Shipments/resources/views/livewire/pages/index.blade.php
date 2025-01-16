<div>
    @if($isModalOpen)
        <livewire:shipments::components.shipment-modal-component />
    @endif

    <section class="py-3">
        <div class="mx-auto max-w-screen-2xl px-4 lg:px-12">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="border-b dark:border-gray-700 mx-4">
                    <div class="flex items-center justify-between space-x-4 pt-3">
                        <div class="flex-1 flex items-center space-x-3">
                            <h5 class="dark:text-white font-semibold">All shipments</h5>
                        </div>
                        <div class="flex-shrink-0 flex flex-row items-center justify-end space-x-3">
                            {{ $shipments->links() }}
                        </div>
                    </div>
                    <div class="flex flex-col-reverse md:flex-row items-center justify-between md:space-x-4 py-3">
                        {{-- <div class="w-full lg:w-2/3 flex flex-col space-y-3 md:space-y-0 md:flex-row md:items-center">
                            <livewire:shipments::components.search-component />
                        </div> --}}
                        <div class="w-full md:w-auto flex flex-col md:flex-row mb-3 md:mb-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                            <button type="button" wire:click="openModal" class="flex items-center justify-center text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                Add new shipment label
                            </button>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3 min-w-[1rem]">ID</th>
                                <th scope="col" class="px-4 py-3 min-w-[10rem]">
                                    Order number
                                </th>
                                <th scope="col" class="px-4 py-3 min-w-[7rem]">
                                    Name
                                </th>
                                <th scope="col" class="px-4 py-3 min-w-[6rem]">
                                    Company name
                                </th>
                                <th scope="col" class="px-4 py-3 min-w-[7rem]">
                                    Billing address
                                </th>
                                <th scope="col" class="px-4 py-3 min-w-[12rem]">
                                    Delivery address
                                </th>
                                <th scope="col" class="px-4 py-3 min-w-[7rem]">

                                </th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shipments as $key => $shipment)
                            <tr wire:key="{{$key}}" class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <th scope="row" class="px-4 py-3">
                                    {{ $shipment->id }}
                                </th>
                                <td class="px-4 py-3">{{ $shipment->order_number }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shipment->billing_name }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $shipment->delivery_company_name }}</td>

                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$shipment->billing_company}} <br>
                                    {{ $shipment->billing_street }} {{$shipment->billing_housenumber}} <br>
                                    {{ $shipment->billing_zipcode }} {{$shipment->billing_city}} <br>
                                    {{ $shipment->billing_country }}
                                </td>

                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$shipment->delivery_company}} <br>
                                    {{ $shipment->delivery_street }} {{$shipment->delivery_housenumber}} <br>
                                    {{ $shipment->delivery_zipcode }} {{$shipment->delivery_city}} <br>
                                    {{ $shipment->delivery_country }}
                                </td>

                                <td class="px-4 py-3 whitespace-nowrap">
                                    <button wire:click="download({{$shipment->id}})" class="bg-green-100 hover:bg-green-50 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:hover:bg-green-700 dark:text-green-300 rounded-full">Download PDF</button>
                                </td>

                                <td class="px-4 py-3">
                                    <button type="button"
                                    wire:click="delete({{$shipment->id}})"
                                    wire:confirm.prompt="Are you sure?\n\nType DELETE to confirm|DELETE"
                                    class="inline-flex items-center p-1 text-sm font-medium text-center text-red-500 hover:text-red-800 hover:bg-red-200 dark:hover:bg-red-700 rounded-lg focus:outline-none dark:text-red-400 dark:hover:text-red-100">
                                        Delete
                                    </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 px-4 pt-3 pb-4" aria-label="Table navigation">
                    <div class="flex items-center space-x-5">
                        {{ $shipments->links(data: ['scrollTo' => false] ) }}
                </div>
            </div>

        </div>
    </section>
</div>
