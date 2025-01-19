
<div>

    <div id="createUserAccordionModal" tabindex="-1" aria-hidden="false" class="overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full flex">
        <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <form wire:submit.prevent="save" class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-between items-center py-4 px-4 rounded-t sm:px-5" wire:loading.delay.long.class="opacity-20">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        @if($progression) Success! @else {{ __('shipments::modal.title') }} @endif
                    </h3>

                    <div class="flex items-center space-x-2">

                        @if(!$progression)
                        <button type="button" wire:click="fillFieldsWithFakeData"
                            class="text-gray-400 bg-yellow-600 hover:bg-yellow-500 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-yellow-600 dark:hover:text-white">
                            <span>Fill fields with fake data</span>
                        </button>
                        @endif

                        <button type="button" wire:click="close" wire:loading.delay.long.attr="disabled"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-2 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                </div>

                @if($progression)

                    <div class="mx-auto max-w-3xl space-y-6 sm:space-y-8 px-5 py-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Your file is ready for shipment</h2>

                        {{-- TODO: STEPS FOR PROGRESS, low prio --}}

                        {{-- <ol class="relative border-s border-gray-200 dark:border-gray-700">
                            <li class="mb-10 ms-6">
                                <span class="absolute -start-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-primary-100 ring-8 ring-white dark:bg-primary-900 dark:ring-gray-900">
                                <svg class="h-3 w-3 text-primary-800 dark:text-primary-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                                </span>
                                <span class="inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                                <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                02 February 2024
                                </span>
                                <h3 class="mb-0.5 mt-2 text-lg font-semibold text-primary-800 dark:text-primary-300">Your request has been registered</h3>
                                <p class="text-base font-normal text-primary-700 dark:text-primary-300">Shipment created!</p>
                            </li>

                            <li class="mb-10 ms-6">
                                <span class="absolute -start-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-800 dark:ring-gray-900">
                                <svg class="h-3 w-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                                </span>
                                <h3 class="mb-1.5 text-lg font-semibold leading-none text-gray-900 dark:text-white">Pick up product from the address</h3>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">Estimated time 2 February 2024 - 5 February 2024.</p>
                            </li>

                            <li class="mb-10 ms-6">
                                <span class="absolute -start-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-800 dark:ring-gray-900">
                                <svg class="h-3 w-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                                </span>
                                <h3 class="mb-1.5 text-lg font-semibold leading-none text-gray-900 dark:text-white">Product check</h3>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">We will carefully check the product and inform you as soon as possible if you are eligible for a refund.</p>
                            </li>

                            <li class="ms-6">
                                <span class="absolute -start-2.5 flex h-5 w-5 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white dark:bg-gray-800 dark:ring-gray-900">
                                <svg class="h-3 w-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                </svg>
                                </span>
                                <h3 class="mb-1.5 text-lg font-semibold leading-none text-gray-900 dark:text-white">Refund the amount</h3>
                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">We will return the amount depending on the option chosen.</p>
                            </li>
                        </ol> --}}

                        <div class="sm:flex items-center sm:space-x-4 space-y-4 sm:space-y-0">

                        <button type="button" wire:click="downloadOnParent" class="w-full sm:w-auto flex justify-center items-center rounded-lg bg-green-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-900">

                            <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                              </svg>


                            Download pdf file
                        </button>

                        </div>
                    </div>

                @else

                    <div id="accordion-collapse" wire:loading.delay.long.class="opacity-20">

                        <h2 wire:loading.delay.long.class="opacity-20">
                            <button type="button" @if($form->isOrderInfoValid()) wire:click="toggleSection(1)" @else disabled @endif wire:loading.delay.long.attr="disabled" class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-gray-50 sm:px-5 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 disabled:opacity-40">
                                <span>{{__('shipments::modal.section1.title')}}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 {{ $openSection === 1 ? 'rotate-180' : '' }} shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>

                        <div {{ $openSection === 1 ? '' : 'hidden' }} wire:loading.delay.long.class="opacity-20">
                            <div class="p-8 border-gray-200 sm:p-5 dark:border-gray-700">
                                <!-- Inputs -->
                                <div class="grid pt-6 gap-4 sm:grid-cols-2">

                                    <x-shipments::form.regular-text-component field="brand_id" label="form.brand_id" />
                                    <x-shipments::form.regular-text-component field="company_id" label="form.company_id" />
                                    <x-shipments::form.regular-text-component field="order_number" label="form.order_number" />

                                    <div class="col-span-2">

                                        <button
                                            type="button"
                                            @if($form->isOrderInfoValid()) wire:click="toggleSection(2)" @else disabled @endif
                                            class="w-full text-white inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            {{__('shipments::modal.section1.button')}}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <h2 wire:loading.delay.long.class="opacity-20">
                            <button type="button" @if($form->isOrderInfoValid()) wire:click="toggleSection(2)" @else disabled @endif wire:loading.delay.long.attr="disabled" class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-blue-500 border-t border-gray-200 sm:px-5 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 disabled:opacity-40">
                                <span>{{__('shipments::modal.section2.title')}}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 {{ $openSection === 2 ? 'rotate-180' : '' }} shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>

                        <div {{ $openSection === 2 ? '' : 'hidden' }} wire:loading.delay.long.class="opacity-20">
                            <div class="p-8 border-gray-200 sm:p-5 dark:border-gray-700">
                                <div class="grid pt-6 gap-4 sm:grid-cols-2">

                                    <x-shipments::form.regular-text-component class="col-span-2" field="billing_company_name" label="form.company_name" />
                                    <x-shipments::form.regular-text-component class="col-span-2" field="billing_name" label="form.name" />

                                    <x-shipments::form.regular-text-component class="col-span-1" field="billing_street" label="form.street" />
                                    <x-shipments::form.regular-text-component class="col-span-1 sm:col-span-1" field="billing_housenumber" label="form.housenumber" />


                                    <x-shipments::form.regular-text-component class="col-span-1" field="billing_zipcode" label="form.zipcode" />
                                    <x-shipments::form.regular-text-component class="col-span-1 sm:col-span-1" field="billing_city" label="form.city" />


                                    <x-shipments::form.select-component class="col-span-2" field="billing_country" label="form.country">
                                        @foreach ($countries as $country => $value)
                                            <option wire:key="delivery_{{$value}}" value="{{$value}}">{{$country}}</option>
                                        @endforeach
                                    </x-shipments::form.select-component>

                                    <div class="col-span-2">
                                        <button
                                        type="button"
                                        @if($form->isOrderInfoValid() && $form->isBillingValid()) wire:click="toggleSection(3)" @else disabled @endif
                                        class="w-full text-white inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        {{__('shipments::modal.section2.button')}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2 wire:loading.delay.long.class="opacity-20">
                            <button type="button" @if($form->isOrderInfoValid() && $form->isBillingValid()) wire:click="toggleSection(3)" @else disabled @endif wire:loading.delay.long.attr="disabled" class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-blue-500 border-t border-gray-200 sm:px-5 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 disabled:opacity-40">
                                <span>{{__('shipments::modal.section3.title')}}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 {{ $openSection === 3 ? 'rotate-180' : '' }} shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>

                        <div {{ $openSection === 3 ? '' : 'hidden' }} wire:loading.delay.long.class="opacity-20">
                            <div class="p-8 border-gray-200 sm:p-5 dark:border-gray-700">
                                <!-- Inputs -->
                                <div class="grid pt-6 gap-4 sm:grid-cols-2">

                                    <x-shipments::form.regular-text-component class="col-span-2" field="delivery_company_name" label="form.company_name" />
                                    <x-shipments::form.regular-text-component class="col-span-2" field="delivery_name" label="form.name" />

                                    <x-shipments::form.regular-text-component class="col-span-1" field="delivery_street" label="form.street" />
                                    <x-shipments::form.regular-text-component class="col-span-1 sm:col-span-1" field="delivery_housenumber" label="form.housenumber" />


                                    <x-shipments::form.regular-text-component class="col-span-1" field="delivery_zipcode" label="form.zipcode" />
                                    <x-shipments::form.regular-text-component class="col-span-1 sm:col-span-1" field="delivery_city" label="form.city" />

                                    <x-shipments::form.select-component class="col-span-2" field="delivery_country" label="form.country">
                                        @foreach ($countries as $country => $value)
                                            <option wire:key="delivery_{{$value}}" value="{{$value}}">{{$country}}</option>
                                        @endforeach
                                    </x-shipments::form.select-component>

                                    <div class="col-span-2">
                                        <button
                                        type="button"
                                        @if($form->isOrderInfoValid() && $form->isBillingValid() && $form->isDeliveryValid()) wire:click="toggleSection(4)" @else disabled @endif
                                        class="w-full text-white inline-flex items-center justify-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        {{__('shipments::modal.section3.button')}}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <h2 wire:loading.delay.long.class="opacity-20">
                            <button type="button" @if($form->isOrderInfoValid() && $form->isBillingValid() && $form->isDeliveryValid()) wire:click="toggleSection(4)" @else disabled @endif wire:loading.delay.long.attr="disabled" class="flex justify-between items-center py-4 px-4 w-full font-medium leading-none text-left text-gray-900 bg-blue-500 border-t border-gray-200 sm:px-5 dark:border-gray-700 dark:text-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 disabled:opacity-40">
                                <span>{{__('shipments::modal.section4.title')}}</span>
                                <svg data-accordion-icon="" class="w-6 h-6 {{ $openSection === 4 ? 'rotate-180' : '' }} shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                        </h2>

                        <div {{ $openSection === 4 ? '' : 'hidden' }} wire:loading.delay.long.class="opacity-20">
                            <div class="p-8 border-gray-200 sm:p-5 dark:border-gray-700">
                                <x-shipments::form.radio-list-component label="form.combination_id">
                                    @foreach($this->deliveryOptions() as $option)
                                        <x-shipments::form.radio wire:key="{{$option->id}}" field="combination_id" :value="$option->id" :name="$option->name" />
                                    @endforeach
                                </x-shipments::form.radio-list-component>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center py-4 px-4 space-x-4 sm:px-5" wire:loading.delay.long.class="opacity-20">
                        <button @if($form->isOrderInfoValid() && $form->isBillingValid() && $form->isDeliveryValid()) type="submit" @else type="button" disabled @endif wire:loading.delay.long.attr="disabled"
                            type="submit" class="w-full text-white inline-flex items-center justify-center bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 disabled:bg-green-400 dark:disabled:bg-green-300 disabled:opacity-75">
                            <svg class="-ml-1 w-5 h-5 sm:mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            {{__('shipments::modal.buttons.submit')}}
                        </button>
                        <button wire:click="close" wire:loading.delay.long.attr="disabled" type="button" class="w-full inline-flex justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            {{__('shipments::modal.buttons.discard')}}
                        </button>
                    </div>
                @endif
            </form>
        </div>


    <div role="status" class="absolute -translate-x-1/2 -translate-y-1/2 top-2/4 left-1/2 hidden" wire:loading.delay.long.class.remove="hidden">
        <svg aria-hidden="true" class="w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/><path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/></svg>
        <span class="sr-only">Loading...</span>
    </div>


    </div>

    <div modal-backdrop="" wire:click="close" class="bg-gray-900 bg-opacity-50 dark:bg-opacity-80 fixed inset-0 z-40"></div>

</div>
