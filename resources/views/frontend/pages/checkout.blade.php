@extends('frontend.layouts.default')

@section('title', $pageTitle)

@push('styles')
    <style>
        /* Define the animation for the spinner */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Define scale animation for zoom effect */
        @keyframes zoom {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.2); /* Scale up to 120% */
            }
        }

        /* Class to apply the spin animation */
        .animate-spin {
            animation: spin 1s linear infinite; /* Adjust duration and easing as needed */
        }

        /* Class to apply the zoom animation */
        .animate-zoom {
            animation: zoom 1s ease-in-out infinite; /* Adjust duration and easing as needed */
        }

    </style>

@endpush

@section('content')

    <!-- Breadcrumb -->
    <section
        class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">
                                Checkout</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a
                                        href="{{ route('home') }}"
                                        class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a>
                                </li>
                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i>
                                </li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">
                                    Cart
                                </li>
                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i>
                                </li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">
                                    Checkout
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Form -->
    <section class="section-cart py-10 max-lg:py-8">
        <div class="container mx-auto max-w-screen-xl px-4 grid gap-8 lg:grid-cols-2">

            <!-- Left Side: Delivery, Shipping, and Payment Options -->
            <div class="space-y-6">
                <!-- Delivery Information -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Delivery Information</h3>
                    <form class="space-y-4"
                          autocomplete="off"
                    >
                        <div class="grid gap-4">
                            {{-- phone number with us phone validation --}}
                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" required/>
                                <div class="w-full">
                                    <x-text-input
                                        type="tel"
                                        class="w-full"
                                        placeholder="US Phone Number"
                                        required
                                        autocomplete="off"
                                        name="phone_number"
                                        id="phone"
                                    />
                                </div>
                                <span class="text-red-500 text-xs mt-1 phone_error"></span>
                            </div>
                            <!-- Country Search and Select -->
                            <div class="relative">
                                <x-input-label for="shipping_country_id" :value="__('Country')" required/>
                                <x-select id="shipping_country_id" name="shipping_country_id" class="w-full" required>
                                    @foreach ($countries as $country)
                                        <option
                                            data-country={{ $country }} value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </x-select>
                                <span class="text-red-500 text-xs mt-1 shipping_country_id_error"></span>
                            </div>
                            <div>
                                <x-input-label for="shipping_full_name" :value="__('Full Name')" required/>
                                <x-text-input type="text" name="shipping_full_name" id="shipping_full_name"
                                            placeholder="Full Name" required/>
                                <span class="text-red-500 text-xs mt-1 shipping_full_name_error"></span>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="shipping_address" :value="__('Address')" required/>
                                    <x-text-input type="text" name="shipping_address" id="shipping_address"
                                                placeholder="Address Line 1" required/>
                                    <span class="text-red-500 text-xs mt-1 shipping_address_error"></span>
                                </div>

                                <div>
                                    <x-input-label for="shipping_address2" :value="__('Address Line 2')"/>
                                    <x-text-input type="text" name="shipping_address2" id="shipping_address2"
                                                  placeholder="Apartment, suite, etc."/>
                                    <span class="text-red-500 text-xs mt-1 address2_error"></span>
                                </div>
                            </div>

                            <div class="grid gap-4 lg:grid-cols-3">
                                <div>
                                    <x-input-label for="shipping_city" :value="__('City')" required/>
                                    <x-text-input type="text" name="shipping_city" id="shipping_city" placeholder="City"
                                                  required/>
                                    <span class="text-red-500 text-xs mt-1 shipping_city_error"></span>
                                </div>
                                <div class="relative">
                                    <x-input-label for="shipping_state_id" :value="__('State')" required/>
                                    <x-select name="shipping_state_id" id="shipping_state_id" class="w-full" required>
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option data-state="{{ $state }}"
                                                    value="{{ $state->id }}">{{ $state->state }}</option>
                                        @endforeach
                                    </x-select>
                                    <span class="text-red-500 text-xs mt-1 shipping_state_id_error"></span>
                                </div>
                                <div>
                                    <x-input-label for="zip_code" :value="__('Zip Code')" required/>
                                    <x-text-input type="text" name="zip_code" placeholder="Zip Code" id="zip-code-input"
                                                  required/>
                                    <span class="text-red-500 text-xs mt-1 zip_code_error"></span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Shipping Method -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Shipping Method</h3>
                    <div class="space-y-2 shipping-method hidden">
                        <!-- Economy Shipping Option -->
                        <div class="flex justify-between items-center text-gray-800 font-semibold">
                            <input type="radio" name="shipping_method" value="economy" id="economy-radio"
                                    checked 
                                   class="peer">
                            <span class="title"></span>
                            <span class="delivery-charge"></span>
                        </div>

                        {{-- Pickup from store --}}
                        <div class="flex justify-between items-center text-gray-800 font-semibold">
                            <input type="radio" name="shipping_method" value="pickup" id="pickup-radio"
                                   class="peer">
                            <span class="title-store-pickup">Store Pickup</span>
                            <span class="delivery-charge-store-pickup">Free</span>
                        </div>
                    </div>
                </div>

                <!-- Payment Options -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Payment Options</h3>
                    <div class="space-y-4">
                        <label
                            class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 transition-all duration-200">
                            <!-- Custom Radio Button -->
                            <div class="relative">
                                <input
                                    type="radio"
                                    name="payment_option"
                                    value="card"
                                    checked
                                    id="card-radio"
                                    class="absolute opacity-0 peer"
                                >
                                <!-- Circle around radio button -->
                                <div
                                    class="h-6 w-6 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-600 peer-checked:bg-blue-600">
                                    <div class="h-3 w-3 rounded-full bg-white peer-checked:bg-white"></div>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <div class="flex items-center space-x-2">
                                <!-- Card Icon -->
                                <img src="{{ asset('images/icons/credit-card.svg') }}" alt="Credit Card"
                                     class="w-6 h-6">
                                <!-- Text -->
                                <span class="text-lg font-semibold text-gray-800">Pay with card</span>
                            </div>
                        </label>

                        <div class="flex items-center mt-4">
                            <input type="checkbox"
                                   id="billing-address-checkbox"
                                   class="form-checkbox text-blue-600 focus:ring-blue-500"
                                   checked
                            >
                            <label for="billing-address-checkbox" class="ml-2 text-gray-700">Use shipping address as
                                billing address</label>
                        </div>
                    </div>
                </div>

                <!-- Billing Address Section -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md mt-6 billing-section hidden">
                    <x-input-label for="billing_address" :value="__('Billing Address')" required/>
                    <div class="grid gap-4">
                        <!-- Country Search and Select -->
                        <div class="relative">
                            <x-input-label for="billing_country_id" :value="__('Country')" required/>
                            <x-select id="billing_country_id" name="billing_country_id" class="w-full" required>
                                @foreach ($countries as $country)
                                    <option
                                        data-country={{ $country }} value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </x-select>
                            <span class="text-red-500 text-xs mt-1 billing_country_id_error"></span>
                        </div>

                        <div>
                            <x-input-label for="billing_full_name" :value="__('Full Name')" required/>
                            <x-text-input type="text" id="billing_full_name" name="billing_full_name"
                                          placeholder="Full Name"/>
                            <span class="text-red-500 text-xs mt-1 billing_full_name_error"></span>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <x-input-label for="billing_address" :value="__('Address')" required/>
                                <x-text-input type="text" id="billing_address" name="billing_address"
                                              placeholder="Address Line 1"/>
                                <span class="text-red-500 text-xs mt-1 billing_address_error"></span>
                            </div>

                            <div>
                                <x-input-label for="billing_address2" :value="__('Address Line 2')"/>
                                <x-text-input type="text" id="billing_address2" name="billing_address2"
                                              placeholder="Apartment, suite, etc. (optional)"/>
                                <span class="text-red-500 text-xs mt-1 billing_address2_error"></span>
                            </div>
                        </div>

                        <div class="grid gap-4 lg:grid-cols-3">
                            <div>
                                <x-input-label for="billing_city" :value="__('City')" required/>
                                <x-text-input type="text" id="billing_city" name="billing_city" placeholder="City"/>
                                <span class="text-red-500 text-xs mt-1 billing_shipping_city_error"></span>
                            </div>

                            <!-- State Search and Select -->
                            <div class="relative">
                                <x-input-label for="billing_state_id" :value="__('State')" required/>
                                <x-select name="billing_state_id" id="billing_state_id" class="w-full" required>
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option data-state="{{ $state }}"
                                                value="{{ $state->id }}">{{ $state->state }}</option>
                                    @endforeach
                                </x-select>
                                <span class="text-red-500 text-xs mt-1 billing_state_error"></span>
                            </div>
                            <div>
                                <x-input-label for="billing_zip_code" :value="__('Zip Code')" required/>
                                <x-text-input type="text" name="billing_zip_code" placeholder="Zip Code"
                                            id="billing-zip-code-input"/>
                                <span class="text-red-500 text-xs mt-1 billing_zip_code_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Order Summary</h3>
                <div class="space-y-4 mb-4">
                    <div class="cart-items">
                        <!-- Cart Items will be appended here -->
                    </div>
                </div>

                <!-- Coupon Section -->
                <div class="space-y-4 mb-4">
                    <div>
                        <label for="coupon-input" class="block text-gray-700 font-medium mb-1">Apply Coupon</label>
                        <div class="flex flex-wrap space-y-2 sm:space-y-0 sm:space-x-2">
                            <input
                                type="text"
                                id="coupon-input"
                                placeholder="Enter coupon code"
                                class="w-full sm:flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300"
                            />
                            <button
                                class="w-full sm:w-auto px-4 py-2 bg-gradient-to-r from-green-400 to-green-500 text-white font-bold rounded-md shadow-md hover:shadow-lg transform transition-transform duration-200 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50"
                                onclick="applyCoupon()"
                            >
                                Apply
                            </button>
                        </div>
                        <div id="coupon-message" class="text-sm mt-2 hidden"></div>
                    </div>
                </div>

                @if($coupons->count() > 0)
                <!-- Coupons List -->
                <div class="mb-4">
                    <h4 class="text-lg font-semibold text-gray-700 mb-4">Available Coupons</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($coupons as $coupon)
                        <div class="flex items-center p-3 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-150 ease-in-out">
                            <!-- Icon -->
                            <img src="{{ asset('images/icons/tag.png') }}" alt="Coupon Code" class="w-6 h-6 flex-shrink-0">
                            <!-- Coupon Code -->
                            <div class="ml-3 flex-1 text-sm font-semibold text-gray-700">
                                <button onclick="copyToClipboard('{{ $coupon->code }}')" class="focus:outline-none group">
                                    <span class="group-hover:underline">{{ $coupon->code }}</span>
                                </button>
                            </div>
                            <!-- Discount Badge -->
                            <span class="px-3 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full ml-auto">
                                @if($coupon->type == 'fixed')
                                    ${{ number_format($coupon->value) }}
                                @else
                                    {{ number_format($coupon->value) }}% OFF
                                @endif
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>                
                @endif

                <!-- Pricing Summary -->
                <div class="space-y-1 text-gray-700 cart-summary">
                    <div class="flex justify-between">
                        <span>Subtotal <span class="text-xs text-gray-500"></span></span>
                        <span class='subtotal'></span>
                    </div>
                    <div class="flex justify-between">
                        <span>
                            Discount
                            <span class="text-xs text-gray-500 coupon-code"></span>
                        </span>
                        <span class='coupon-discount'>0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax
                            <span class="text-xs text-gray-500 tax-rate"></span>
                        </span>
                        <span class="tax-total">0</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span class='delivery-charge'>0</span>
                    </div>
                    <div class="flex justify-between font-semibold text-gray-800">
                        <span>Total</span>
                        <span class='grand-total'>0</span>
                    </div>
                </div>

                <!-- Place Order Button -->
                <div class="mt-4">
                    <button
                        class="w-full p-3 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-md font-bold shadow-md hover:shadow-lg transform transition-transform duration-200 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                        <span class="flex items-center justify-center btn-place-order ">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h18M3 12h18m-9 9h9M3 21h18M3 6h9"/>
                            </svg>
                            Place Order
                        </span>
                        <span class="flex items-center justify-center btn-spinner hidden">
                            <svg class="animate-spin animate-zoom w-5 h-5 mr-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 1 0 16 0A8 8 0 0 0 4 12z"></path>
                            </svg>
                            Processing...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @include('frontend.partials.services')
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        let cartTotal = 0;
        let economyDeliveryCharge = 0;
        let cartTotalWithDiscount = 0;
        let grandTotal = 0;
        let deliveryCharge = 0;
        let taxAmount = 0;
        let total_items = 0;
        let couponDiscount = 0;
        let cartSubmit = false;
        // Get the CSRF token from the meta tag
        let token = $('meta[name="csrf-token"]').attr('content');

        // get the cart items from local storage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // get the note from local storage
        let note = localStorage.getItem('note') || '';


        // Get the cart items from local storage and display them in the cart-items div
        // check if the cart is empty
        function checkCart() {
            if (cart.length === 0) {
                // if cart is empty, show a message
                $('.cart-items').html('<p class="text-gray-700">No items in cart</p>');
            } else {
                // if cart is not empty, loop through the cart items
                cart.forEach(function (item) {
                    cartTotal += item.price * item.qty;
                    total_items++;
                    // append the cart items to the cart-items div
                    $('.cart-items').append(`
                        <div class="flex items center space-x-4 border-b border-gray-200 pb-2">
                            <div class="relative w-16 h-16 flex-shrink-0">
                                <img src="/storage/${item.image}" alt="Product Image" class="w-full h-full object-cover rounded-lg shadow-sm">
                                <span class="absolute top-0 right-0 bg-gray-700 text-white text-xs font-semibold px-2 rounded-full">${item.qty}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-800 font-medium whitespace-nowrap overflow-hidden  text-ellipsis truncate"><a href="${item.url}">${item.title}</a></p>
                                    <p class="text-gray-800 font-semibold">$${(item.price * item.qty).toFixed(2)}</p>
                                </div>
                                <p class="text-gray-600 text-sm">${item?.variant?.size ? 'Size: ' + item?.variant?.size : ''}</p>
                                <p class="text-gray-600 text-sm">${item?.variant?.color ? 'Color: ' + item?.variant?.color : ''}</p>
                            </div>
                        </div>
                    `);
                });
            }
        }

        /**
         * Validate zip code
         * @param {string} zipCode
         */
            $("#zip-code-input").on('blur', function () {
            let zipCode = $(this).val();
            if (!zipCode) {
                $('.zip_code_error').text('Zip code is required');
                return;
            }
            let stateData = $('#shipping_state_id option:selected').data('state');
            if (stateData) {
                let zipCodePattern = stateData.zip_code_pattern;
                if (!validateZipCode(zipCode, zipCodePattern)) {
                    $('.zip_code_error').text('Invalid zip code');
                } else {
                    $('.zip_code_error').text('');
                }
            } else {
                $('.zip_code_error').text('Please select a state');
            }
        });

        // Calculate the delivery charges when the state is changed
        $("#shipping_state_id").on('change', function () {
            let zipCode = $('#zip-code-input').val();
            let stateData = $('#shipping_state_id option:selected').data('state');

            calculateTax(calculateSubTotal());
            if (stateData) {
                let zipCodePattern = stateData.zip_code_pattern;
                if (!validateZipCode(zipCode, zipCodePattern)) {
                    $('.zip_code_error').text('Invalid zip code');
                } else {
                    $('.zip_code_error').text('');
                }
            } else {
                $('.zip_code_error').text('Please select a state');
            }
        });

        /**
         * Validate zip code & Calculate the delivery charges based on the zip code
         */
        function validateZipCode(zipcode, zipCodePattern) {
            if (!zipCodePattern) {
                return true;
            }
            zipCodePattern = formatZipCodePattern(zipCodePattern);

            let regex = new RegExp(zipCodePattern);
            if (!regex.test(zipcode)) {
                return false;
            }

            calculateDeliveryCharges();
            return true;
        }

        // Function to format regex patterns
        function formatZipCodePattern(pattern) {
            return pattern
                .split('|')         // Split by `|`
                .map(part => `^${part.replace(/^\^/, '').replace(/\$$/, '')}$`) // Add ^ and $ to each part
                .join('|');         // Join the parts back with `|`
        }

        // on shipping method change
        $("input[name='shipping_method']").on('change', function () {
            let shippingMethod = $("input[name='shipping_method']:checked").val();
            if (shippingMethod === 'pickup') {
                $('.cart-summary .delivery-charge').text('Free');
                deliveryCharge = 0;
                calculateGrandTotal();
            } else {
                deliveryCharge = economyDeliveryCharge;
                calculateDeliveryCharges();
            }
        });
        
        // calculate delivery charges based on the zip code
        function calculateDeliveryCharges() {
            // get the value from shipping method radio
            let shippingMethod = $("input[name='shipping_method']:checked").val();
            // zip code
            let zipCode = $("#zip-code-input").val();
            if (cartTotal >= 200) {
                cartSubmit = true;
                $('.shipping-method').removeClass('hidden').addClass('show');
                $('.shipping-method .title').text('Economy: 5 to 8 business days');
                $('.shipping-method .delivery-charge').text('Free');
                $('.cart-summary .delivery-charge').text('Free');
            } else {
                $.ajax({
                    url: "{{ route('shipping.economy.charge') }}",
                    type: "POST",
                    data: {
                        zip_code: zipCode,
                        cart: cart
                    },
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function (response) {
                        if (response.success) {
                            $('.shipping-method .title').text('Economy: 5 to 8 business days');
                            $('.shipping-method .delivery-charge').text('$' + response.charge);
                            $('.cart-summary .delivery-charge').text('$' + response.charge);
                            deliveryCharge = response.charge;
                            economyDeliveryCharge = response.charge;
                            cartSubmit = true;
                            calculateGrandTotal();
                        }
                    },
                    beforeSend: function () {
                        $('.shipping-method').removeClass('hidden').addClass('show');
                        $('.shipping-method .title').text('Calculating Please wait...');
                        $('.shipping-method .delivery-charge').text('');
                        $('.cart-summary .delivery-charge').text('calculating...');
                        deliveryCharge = 0;
                        cartSubmit = false;
                    },
                    error: function (error) {
                        $('.shipping-method').addClass('hidden');
                        $('.shipping-method .title').text('');
                        $('.shipping-method .delivery-charge').text('');
                        $('.cart-summary .delivery-charge').text('');
                        deliveryCharge = 0;
                        cartSubmit = false;
                    }
                });
            }
        }

        //Use shipping address as billing address
        $('#billing-address-checkbox').on('change', function () {
            if ($(this).is(':checked')) {
                $('.billing-section').removeClass('show').addClass('hidden');
                $('#billing_full_name').val($('#shipping_full_name').val());
                $('#billing_address').val($('#shipping_address').val());
                $('#billing_address2').val($('#shipping_address2').val());
                $('#billing_city').val($('#shipping_city').val());
                $('#billing_country_id').val($('#shipping_country_id').val());
                $('#billing_state_id').val($('#shipping_state_id').val());
                $('#billing_zip_code').val($('#zip-code-input').val());
            } else {
                $('.billing-section').removeClass('hidden').addClass('show');
                $('#billing_full_name').val('');
                $('#billing_address').val('');
                $('#billing_address2').val('');
                $('#billing_city').val('');
                $('#billing_country_id').val('');
                $('#billing_state_id').val('');
                $('#billing_zip_code').val('');
            }
        });

        // calculate cart sub total
        function calculateSubTotal() {
            let subTotal = 0;
            cart.forEach(function (item) {
                subTotal += item.price * item.qty;
            });
            $(".subtotal").text("$" + subTotal.toFixed(2));

            calculateTax();
            calculateGrandTotal();
            return subTotal;
        }

        // calculate tax
        function calculateTax() {
            let stateData = $('#shipping_state_id option:selected').data('state');
            calculateGrandTotal();
            if (stateData) {
                let taxRate = stateData.tax_rate;
                $(".tax-rate").text(`(${taxRate}%)`);
                // Calculate the tax amount
                let actualAmount = cartTotal - couponDiscount;
                const stateTaxAmount = actualAmount * (taxRate / 100);
                taxAmount = parseFloat(stateTaxAmount);
                $(".tax-total").text("$" + stateTaxAmount.toFixed(2));
                return stateTaxAmount;
            } else {
                return 0;
            }
        }

        function calculateGrandTotal() {
            let grandTotal = (cartTotal - couponDiscount) + taxAmount + deliveryCharge;
            $(".grand-total").text("$" + grandTotal.toFixed(2));
        }

        function copyToClipboard(code) {
            navigator.clipboard.writeText(code).then(function () {
                toastr.success('Coupon code copied to clipboard');
            }, function (err) {
                toastr.error('Failed to copy coupon code');
            });
        }

        
        function applyCoupon() {
            const couponCode = $('#coupon-input').val().trim(); // Get the coupon input value
            if (!couponCode) {
                toastr.error('Please enter a coupon code');
                return;
            }

            $.ajax({
                url: "{{ route('apply.coupon') }}",
                type: "POST",
                data: {
                    coupon_code: couponCode,
                    cart: cart,
                    subtotal: cartTotal
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    if (response.success) {
                        couponDiscount = response.discount_amount;
                        cartTotalWithDiscount = cartTotal - couponDiscount;
                        // update the coupon discount
                        $('.coupon-discount').text('$' + response.discount_amount);
                        // show the coupon code
                        $('.coupon-code').text('(' +response.coupon_code + ')');

                        // Display a success message using toastr
                        toastr.success(response.message);

                        let subtotal = calculateSubTotal();
                        
                        // calculate tax   
                        calculateTax(subtotal);
                        
                        // Update the grand total
                        calculateGrandTotal(subtotal);
                        // Update the coupon message
                        $('#coupon-message').text(response.message).removeClass('hidden');
                    }
                },
                beforeSend: function () {
                    $('#coupon-message').text('').addClass('hidden');
                    $('.coupon-code').text('');
                    $('.coupon-discount').text('calculating...');
                },
                error: function (error) {
                    if (error.responseJSON && error.responseJSON.errors) {
                        // Loop through all the validation errors and display them using toastr
                        for (const [key, messages] of Object.entries(error.responseJSON.errors)) {
                            messages.forEach(function (message) {
                                toastr.error(message);
                            });
                        }
                    } else {
                        // Display a generic error if validation errors are not available
                        toastr.error('An error occurred. Please try again later.');
                    }
                    $('.coupon-code').text('');
                    $('.coupon-discount').text('0');
                }
            });
        }

        $(document).ready(function () {
            // Call the checkCart function
            checkCart();
            calculateSubTotal();
        });


        // Place Order ajax submission & must be validated
        $('.btn-place-order').on('click', function (e) {
            console.log('Place order button clicked');
            e.preventDefault();
            let phone = $('#phone').val();
            let shippingCountryId = $('#shipping_country_id').val();
            let shippingFullName = $('#shipping_full_name').val();
            let shippingAddress = $('#shipping_address').val();
            let shippingAddress2 = $('#shipping_address2').val();
            let shippingCity = $('#shipping_city').val();
            let shippingStateId = $('#shipping_state_id').val();
            let zipCode = $('#zip-code-input').val();
            let billingCountryId = $('#billing_country_id').val();
            let billingFullName = $('#billing_full_name').val();
            let billingAddress = $('#billing_address').val();
            let billingCity = $('#billing_city').val();
            let billingStateId = $('#billing_state_id').val();
            let billingZipCode = $('#billing-zip-code-input').val();
            let paymentOption = $('input[name="payment_option"]:checked').val();
            let billingAddressCheckbox = $('#billing-address-checkbox').is(':checked');
            let couponCode = $('#coupon-input').val();
            let billingAddressSection = $('.billing-section').hasClass('show');
            let shippingMethod = $("input[name='shipping_method']:checked").val();
            let errors = false;
            // console.log('validation started');
            //----------------------- Validation Start -----------------------//
            // Validate phone number
            if (!phone) {
                $('.phone_error').text('Phone number is required');
                toastr.error('Phone number is required');
                errors = true;
                return;
            } else {
                $('.phone_error').text('');
            }

            // Validate shipping country
            if (!shippingCountryId) {
                $('.shipping_country_id_error').text('Country is required');
                toastr.error('Country is required');
                errors = true;
                return;
            } else {
                $('.shipping_country_id_error').text('');
            }

            // Validate shipping full name
            if (!shippingFullName) {
                $('.shipping_full_name_error').text('Full name is required');
                toastr.error('Full name is required');
                errors = true;
                return;
            } else {
                $('.shipping_full_name_error').text('');
            }

            // Validate shipping address
            if (!shippingAddress) {
                $('.shipping_address_error').text('Address is required');
                toastr.error('Address is required');
                errors = true;
                return;
            } else {
                $('.shipping_address_error').text('');
            }

            // Validate shipping city
            if (!shippingCity) {
                $('.shipping_city_error').text('City is required');
                toastr.error('City is required');
                errors = true;
                return;
            } else {
                $('.shipping_city_error').text('');
            }

            // Validate shipping state
            if (!shippingStateId) {
                $('.shipping_state_id_error').text('State is required');
                toastr.error('State is required');
                errors = true;
                return;
            } else {
                $('.shipping_state_id_error').text('');
            }

            // Validate shipping zip code
            if (!zipCode) {
                $('.zip_code_error').text('Zip code is required');
                toastr.error('Zip code is required');
                errors = true;
                return;
            } else {
                $('.zip_code_error').text('');
            }

            // Validate billing country
            if (billingAddressSection && !billingCountryId) {
                $('.billing_country_id_error').text('Country is required');
                toastr.error('Country is required');
                errors = true;
                return;
            } else {
                $('.billing_country_id_error').text('');
            }

            // Validate billing full name
            if (billingAddressSection && !billingFullName) {
                $('.billing_full_name_error').text('Full name is required');
                toastr.error('Full name is required');
                errors = true;
                return;
            } else {
                $('.billing_full_name_error').text('');
            }

            // Validate billing address
            if (billingAddressSection && !billingAddress) {
                $('.billing_address_error').text('Address is required');
                toastr.error('Address is required');
                errors = true;
                return;
            } else {
                $('.billing_address_error').text('');
            }

            // Validate billing city
            if (billingAddressSection && !billingCity) {
                $('.billing_city_error').text('City is required');
                toastr.error('City is required');
                errors = true;
                return;
            } else {
                $('.billing_city_error').text('');
            }

            // Validate billing state
            if (billingAddressSection && !billingStateId) {
                $('.billing_state_error').text('State is required');
                toastr.error('State is required');
                errors = true;
                return;
            } else {
                $('.billing_state_error').text('');
            }

            // Validate billing zip code
            if (billingAddressSection && !billingZipCode) {
                $('.billing_zip_code_error').text('Zip code is required');
                toastr.error('Zip code is required');
                errors = true;
                return;
            } else {
                $('.billing_zip_code_error').text('');
            }

            if (!cartSubmit) {
                toastr.error('Please wait while we calculate the delivery charges');
                return;
            }

            if (errors) {
                console.log('Validation errors');
                return;
            }
            // console.log('Validation passed');
            //----------------------- Validation End -----------------------//

            $.ajax({
                url: "{{ route('submit.order') }}",
                type: "POST",
                data: {
                    phone: phone,
                    shipping_country_id: shippingCountryId,
                    shipping_full_name: shippingFullName,
                    shipping_address: shippingAddress,
                    shipping_address2: shippingAddress2,
                    shipping_city: shippingCity,
                    shipping_state_id: shippingStateId,
                    zip_code: zipCode,
                    billing_country_id: billingCountryId,
                    billing_full_name: billingFullName,
                    billing_address: billingAddress,
                    billing_city: billingCity,
                    billing_state_id: billingStateId,
                    billing_zip_code: billingZipCode,
                    payment_option: paymentOption,
                    billing_address_checkbox: billingAddressCheckbox ? 1 : 0,
                    shipping_method: shippingMethod,
                    cart: cart,
                    tax_amount: taxAmount,
                    delivery_charge: deliveryCharge,
                    coupon_code: couponCode,
                    discount_amount: couponDiscount,
                    total_items: total_items,
                    subtotal: cartTotal,
                    total: cartTotal + taxAmount + deliveryCharge,
                    notes: note
                },
                headers: {
                    'X-CSRF-TOKEN': token
                },
                success: function (response) {
                    if (response.success) {
                        // Redirect to the order success page
                        window.location.href = response.url;
                    } else {
                        // Display a generic error if validation errors are not available
                        toastr.error('An error occurred. Please try again later.');
                        $('.btn-place-order').removeClass('hidden');
                        $('.btn-spinner').addClass('hidden');
                    }
                },
                beforeSend: function () {
                    $('.btn-place-order').addClass('hidden');
                    $('.btn-spinner').removeClass('hidden');
                },
                error: function (error) {
                    $('.btn-place-order').removeClass('hidden');
                    $('.btn-spinner').addClass('hidden');
                    if (error.responseJSON && error.responseJSON.errors) {
                        // Loop through all the validation errors and display them using toastr
                        for (const [key, messages] of Object.entries(error.responseJSON.errors)) {
                            messages.forEach(function (message) {
                                $(`.${key}_error`).text(message);
                                toastr.error(message);
                            });
                        }
                    } else {
                        // Display a generic error if validation errors are not available
                        toastr.error('An error occurred. Please try again later.');
                    }
                }
            });
        });
    </script>
@endpush
