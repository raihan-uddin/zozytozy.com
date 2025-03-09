@extends('frontend.layouts.default')

@section('title', $pageTitle)

@push('styles')
<style>
    /* Define the animation for the spinner */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
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
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Checkout</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Cart</li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Checkout</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart -->
    <!-- Checkout Form -->
    <section class="section-cart py-10 max-lg:py-8" x-data="checkoutHandler()" x-init="loadCart()">
        <div class="container mx-auto max-w-screen-xl px-4 grid gap-8 lg:grid-cols-2">
            
            <!-- Left Side: Delivery, Shipping, and Payment Options -->
            <div class="space-y-6">
                <!-- Delivery Information -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md"  x-data="{ clearForm() { $refs.form.reset() } }" x-init="clearForm()">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Delivery Information</h3>
                    <form class="space-y-4"
                    autocomplete="false"
                    x-ref="form"
                    x-on:submit.prevent="placeOrder"
                    x-on:keydown.enter.prevent="placeOrder"
                    x-on:keydown.escape="showShippingCountryDropdown = false; showShippingStateDropdown = false; showBillingCountryDropdown = false; showBillingStateDropdown = false"
                    x-on:click.away="showShippingCountryDropdown = false; showShippingStateDropdown = false; showBillingCountryDropdown = false; showBillingStateDropdown = false"
                    x-on:keydown.tab="showShippingCountryDropdown = false; showShippingStateDropdown = false; showBillingCountryDropdown = false; showBillingStateDropdown = false"
                    >
                        <div class="grid gap-4">
                            {{-- phone number with us phone validation --}}
                            <div>
                                <x-input-label for="phone_number" :value="__('Phone Number')" required/>
                                <x-text-input 
                                    type="tel"
                                    placeholder="Phone Number" 
                                    required 
                                    autocomplete="false"
                                    pattern="^\(\d{3}\) \d{3}-\d{4}$" 
                                    title="Format: (123) 456-7890"
                                    x-model="phoneNumber" 
                                    @input="validatePhoneNumber" />
                                
                                <span class="text-red-500" x-show="phoneError" x-text="phoneErrorMessage"></span>
                            </div>
                            <!-- Country Search and Select -->
                            <div class="relative">
                                <x-input-label for="shipping_country_id" :value="__('Country')" required/>
                                <x-text-input 
                                    type="text"
                                    placeholder="Select Country" 
                                    required 
                                    x-model="shippingCountryFilter" 
                                    autocomplete="false"
                                    @focus="showShippingCountryDropdown = true"
                                    @input="shippingCountrySelectHandler"
                                    @blur="verifyShippingCountrySelection"
                                    @click.away="showShippingCountryDropdown = false" />
                                <input type="hidden" name="shipping_country_id" x-model="shipping_country_id">
                                
                                <!-- Country List -->
                                <div 
                                    class="absolute bg-white border border-gray-300 rounded-lg mt-1 w-full z-10 shadow-lg transition-opacity duration-150 ease-in-out" 
                                    x-show="showShippingCountryDropdown && filteredShippingCountries.length > 0"
                                    x-transition:enter="transition-opacity duration-150"
                                    x-transition:leave="transition-opacity duration-150"
                                    style="display: none;"
                                    >
                                    <template x-for="country in filteredShippingCountries" :key="country.id">
                                        <div
                                            class="p-3 hover:bg-gradient-to-r hover:from-blue-400 hover:to-purple-500 hover:text-white cursor-pointer transition-all duration-200 rounded-md flex items-center space-x-2"
                                            @click="selectShippingCountry(country); showShippingCountryDropdown = false"
                                        >
                                            <!-- Optional Country Flag (Example using emoji flag, replace with actual icons if available) -->
                                            <span x-text="country.iso_3166_2 === 'US' ? '🇺🇸' : '🌍'" class="text-lg"></span>
                                            <span x-text="country.name" class="font-medium"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <x-input-label for="shipping_full_name" :value="__('Full Name')" required/>
                                <x-text-input
                                    type="text" 
                                    placeholder="Full Name" 
                                    required  
                                    x-model="shippingFullName" />
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="shipping_address" :value="__('Address')" required/>
                                    <x-text-input
                                        type="text" 
                                        placeholder="Address Line 1" 
                                        required  
                                        x-ref="addressInput" 
                                        x-model="shippingAddress" />
                                    <span class="text-red-500 text-xs mt-1" x-show="addressError" x-text="addressErrorMessage"></span>
                                </div>
                                
                                <div>
                                    <x-input-label for="shipping_address2" :value="__('Address Line 2')"/>
                                    <x-text-input
                                        type="text" 
                                        placeholder="Apartment, suite, etc." 
                                        x-model="shippingAddress2" />
                                </div>
                            </div>
                            
                            <div class="grid gap-4 lg:grid-cols-3">
                                <div>
                                    <x-input-label for="shipping_city" :value="__('City')" required/>
                                    <x-text-input
                                        type="text" 
                                        placeholder="City" 
                                        required  
                                        x-model="shippingCity" />
                                </div>
                                <div class="relative">
                                    <x-input-label for="shipping_state_id" :value="__('State')" required/>
                                    <x-text-input
                                        type="text" 
                                        placeholder="Select State" 
                                        x-model="shippingStateFilter" 
                                        @focus="showShippingStateDropdown = true"
                                        @input="shippingStateSelectHandler"
                                        @blur="verifyShippingStateSelection"
                                        @click.away="showShippingStateDropdown = false" />
                                    <input type="hidden" name="shipping_state_id" x-model="selectedShippingStateId">
                                    <!-- State List -->
                                    <div 
                                        class="absolute bg-white border border-gray-200 rounded-lg shadow-lg mt-1 w-full z-10 transition-opacity duration-150 ease-in-out" 
                                        x-show="showShippingStateDropdown && filteredShippingStates.length > 0"
                                        x-transition:enter="transition-opacity duration-150"
                                        x-transition:leave="transition-opacity duration-150"
                                        style="display: none;"
                                        >
                                        <template x-for="state in filteredShippingStates" :key="state.id">
                                            <div
                                                class="p-2 hover:bg-gradient-to-r hover:from-purple-400 hover:to-blue-500 hover:text-white cursor-pointer transition-all duration-200 rounded-md"
                                                @click="selectShippingState(state); showShippingStateDropdown = false"
                                                x-text="state.state"
                                            ></div>
                                        </template>
                                    
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="zip_code" :value="__('Zip Code')" required/>
                                    <x-text-input
                                        type="text" 
                                        placeholder="Zip Code" 
                                        id="zip-code-input"
                                        required  
                                        x-model="shippingZip" 
                                        @input="validateZip" 
                                        @blur="validateZip" />
                                    <span id="zip-code-error" class="text-red-500 text-xs mt-1 hidden">Invalid Zip Code format.</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Shipping Method -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Shipping Method</h3>
                    <div class="space-y-2">
                        <!-- Store Pickup Option -->
                        <div class="flex justify-between items-center hidden">
                                <label class="text-gray-800 font-medium">
                                    <input 
                                        type="checkbox" 
                                        name="shipping_method" 
                                        value="store_pickup" 
                                        id="store_pickup" 
                                        class="h-5 w-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                        onclick="toggleShippingMethod(this)"
                                    >
                                    Pickup In-Store
                                </label>
                                <p class="text-gray-800 font-semibold">Free</p>
                        </div>
                        
                        <!-- Economy Shipping Option -->
                        <div class="flex justify-between items-center" hidden>
                            <label class="text-gray-800 font-medium">
                                <input type="checkbox" 
                                    name="shipping_method" 
                                    value="economy" 
                                    id="economy" 
                                    class="h-5 w-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                    onclick="toggleShippingMethod(this)"
                                    checked
                                >
                                Economy: 5 to 8 business days
                            </label>
                            <div>
                                <p class="text-gray-800 font-semibold" x-text="`$${shipping}`" x-show="shipping != 0"></p>
                                <p class="text-gray-800 font-semibold" x-text="shipping === 0 ? 'Free' : ''" x-show="shipping === 0"></p>
                            </div>
                        </div>
                    </div>                    
                </div>

                <!-- Payment Options -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-xl font-semibold text-gray-700 mb-4">Payment Options</h3>
                    <div class="space-y-4">
                        <label class="flex items-center space-x-3 p-4 border border-gray-300 rounded-lg shadow-lg cursor-pointer hover:bg-gray-50 transition-all duration-200">
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
                                <div class="h-6 w-6 border-2 border-gray-300 rounded-full flex items-center justify-center peer-checked:border-blue-600 peer-checked:bg-blue-600">
                                    <div class="h-3 w-3 rounded-full bg-white peer-checked:bg-white"></div>
                                </div>
                            </div>

                            <!-- Payment Info -->
                            <div class="flex items-center space-x-2">
                                <!-- Card Icon -->
                                    <img src="{{ asset('images/icons/credit-card.svg') }}" alt="Credit Card" class="w-6 h-6">
                                <!-- Text -->
                                <span class="text-lg font-semibold text-gray-800">Pay with card</span>
                            </div>
                        </label>

                        <div class="flex items-center mt-4">
                            <input type="checkbox" 
                                id="billing-address-checkbox" 
                                class="form-checkbox text-blue-600 focus:ring-blue-500" 
                                x-model="useShippingAsBilling"
                                @change="useShippingAsBillingHandler"
                                >
                            <label for="billing-address-checkbox" class="ml-2 text-gray-700">Use shipping address as billing address</label>
                        </div>
                    </div>
                </div>

                <!-- Billing Address Section -->
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md mt-6" x-show="!useShippingAsBilling">
                    <x-input-label for="billing_full_name" :value="__('Billing Address')" required/>
                    <div class="grid gap-4">
                        <!-- Country Search and Select -->
                        <div class="relative">
                            <label class="block text-gray-600 text-sm mb-1">Country</label>
                            <input
                                type="text"
                                class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Select Country"
                                x-model="billingCountryFilter"
                                @focus="showBillingCountryDropdown = true"
                                @input="billingCountrySelectHandler"
                                @blur="verifyBillingCountrySelection"
                                @click.away="showBillingCountryDropdown = false"
                            />
                            <input type="hidden" name="billing_country_id" x-model="selectedBillingCountryId">
                            <!-- Country List -->
                            <div 
                                class="absolute bg-white border border-gray-300 rounded-lg mt-1 w-full z-10 shadow-lg transition-opacity duration-150 ease-in-out" 
                                x-show="showBillingCountryDropdown && filteredShippingCountries.length > 0"
                                x-transition:enter="transition-opacity duration-150"
                                x-transition:leave="transition-opacity duration-150"
                                style="display: none;"
                            >
                                <template x-for="country in filteredShippingCountries" :key="country.id">
                                    <div
                                        class="p-3 hover:bg-gradient-to-r hover:from-blue-400 hover:to-purple-500 hover:text-white cursor-pointer transition-all duration-200 rounded-md flex items-center space-x-2"
                                        @click="selectBillingCountry(country); showBillingCountryDropdown = false"
                                    >
                                        <!-- Optional Country Flag -->
                                        <span x-text="country.iso_3166_2 === 'US' ? '🇺🇸' : '🌍'" class="text-lg"></span>
                                        <span x-text="country.name" class="font-medium"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div>
                            <x-input-label for="billing_full_name" :value="__('Full Name')" required/>
                            <input type="text" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Full Name" required x-ref="billingFullNameInput" x-model="billingFullName"> 
                        </div>

                        <div>
                            <x-input-label for="billing_address" :value="__('Address')" required/>
                            <input type="text" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Address Line 1" required x-ref="billingAddressInput" x-model="billingAddress">
                            <input type="text" class="w-full mt-2 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Apartment, suite, etc. (optional)" x-model="billingAddress2">
                        </div>

                        <div class="grid gap-4 lg:grid-cols-3">
                            <div>
                                <x-input-label for="billing_city" :value="__('City')" required/>
                                <input type="text" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="City" required x-model="billingCity">
                            </div>

                            <!-- State Search and Select -->
                            <div class="relative">
                                <x-input-label for="billing_state_id" :value="__('State')" required/>
                                <input
                                    type="text"
                                    class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Select State"
                                    x-model="billingStateFilter"
                                    @focus="showBillingStateDropdown = true"
                                    @click="showBillingStateDropdown = true" 
                                    @input="billingStateSelectHandler"
                                    @blur="verifyBillingStateSelection"
                                    @click.away="showBillingStateDropdown = false"
                                />
                                <!-- State List -->
                                <div 
                                class="absolute bg-white border border-gray-200 rounded-lg shadow-lg mt-1 w-full z-10 transition-opacity duration-150 ease-in-out" 
                                    x-show="showBillingStateDropdown && filteredShippingStates.length > 0"
                                    x-transition:enter="transition-opacity duration-150"
                                    x-transition:leave="transition-opacity duration-150"
                                    style="display: none;"
                                >
                                    <template x-for="state in filteredShippingStates" :key="state.id">
                                        <div
                                            class="p-3 hover:bg-gradient-to-r hover:from-green-400 hover:to-blue-500 hover:text-white cursor-pointer transition-all duration-200 rounded-md flex items-center"
                                            @click="selectBillingState(state); showBillingStateDropdown = false"
                                        >
                                            <span x-text="state.state" class="font-medium"></span>
                                        </div>
                                    </template>
                                </div>
                            </div>
                            <div>
                                <x-input-label for="billing_zip_code" :value="__('Zip Code')" required/>
                                <input type="text" class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Zip Code" required
                                    id="billing-zip-code-input"
                                >
                                <span id="billing-zip-code-error" class="text-red-500 text-sm mt-1 hidden"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Right Side: Order Summary -->
            <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Order Summary</h3>
                <div class="space-y-4 mb-4">
                    <!-- Product Items -->
                    <template x-for="(item, index) in cart" :key="index">
                        <div class="flex items-center space-x-4 border-b border-gray-200 pb-2">
                            <!-- Product Image & Quantity Badge -->
                            <div class="relative w-16 h-16 flex-shrink-0">
                                <img :src="`/storage/${item.image}`" alt="Product Image" class="w-full h-full object-cover rounded-lg shadow-sm">
                                <span class="absolute top-0 right-0 bg-gray-700 text-white text-xs font-semibold px-2 rounded-full" x-text="item.qty"></span>
                            </div>
                            
                            <!-- Product Details -->
                            <div class="flex-1">
                                <div class="flex justify-between items-center">
                                    <p class="text-gray-800 font-medium truncate" x-text="item.title"></p>
                                    <p class="text-gray-800 font-semibold" x-text="`$${(item.price * item.qty).toFixed(2)}`"></p>
                                </div>
                                <!-- Variant Info (if available) -->
                                <p class="text-gray-600 text-sm" x-show="item?.variant?.size" x-text="'Size: ' + item?.variant?.size"></p>
                                <p class="text-gray-600 text-sm" x-show="item?.variant?.color" x-text="'Color: ' + item?.variant?.color"></p>
                            </div>
                        </div>
                    </template>
                    <!-- Coupon Code Input -->
                    {{-- <div class="mt-4">
                        <label class="block text-gray-600 text-sm mb-1">Coupon Code</label>
                        <div class="flex">
                            <input type="text" 
                                class="w-full p-2 border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Enter coupon code" x-model="couponCode">
                            <button @click="applyCoupon" class="ml-2 p-2 bg-blue-500 text-white rounded">Apply</button>
                        </div>
                        <span x-show="discount > 0" class="text-green-500 mt-1">Discount: -$</span>
                    </div> --}}
                </div>
    
                <!-- Pricing Summary -->
                <div class="space-y-1 text-gray-700">
                    <div class="flex justify-between">
                        <span>Subtotal <span class="text-xs text-gray-500" x-text="`(${productCount} items)`"></span></span>
                        <span x-text="`$${subtotal.toFixed(2)}`"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Tax 
                            <span class="text-xs text-gray-500" x-text="`(${taxRate}%)`"></span>
                        </span>
                        <span x-text="`$${taxTotal.toFixed(2)}`"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span x-text="`$${shipping}`"></span>
                    </div>
                    <div class="flex justify-between font-semibold text-gray-800">
                        <span>Total</span>
                        <span x-text="`$${grandTotal}`"></span>
                    </div>
                </div>

                <!-- Place Order Button -->
                <div x-data="{ loading: false }" class="mt-4">
                    <button @click="loading = true; placeOrder()" 
                        class="w-full p-3 bg-gradient-to-r from-blue-400 to-blue-500 text-white rounded-md font-bold shadow-md hover:shadow-lg transform transition-transform duration-200 ease-in-out hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-50">
                        <span class="flex items-center justify-center" x-show="!loading">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 12h18m-9 9h9M3 21h18M3 6h9" />
                            </svg>
                            Place Order
                        </span>
                        <span class="flex items-center justify-center" x-show="loading">
                            <svg class="animate-spin animate-zoom w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 1 0 16 0A8 8 0 0 0 4 12z"></path>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>


<script>
    function toggleShippingMethod(clickedCheckbox) {
        const checkboxes = document.querySelectorAll('input[name="shipping_method"]');
        checkboxes.forEach(checkbox => {
            if (checkbox !== clickedCheckbox) {
                checkbox.checked = false;
            }
        });
    }
</script>

<script>
    function checkoutHandler() {
    return {

        // form fields
        shipping_country_id: null,
        shippingFullName: '',
        shippingAddress: '',
        shippingAddress2: '',
        shippingCity: '',
        selectedShippingStateId: null,
        shippingZip: '',
        billingFullName: '',
        billingAddress: '',
        billingAddress2: '',
        billingCity: '',
        selectedBillingCountryId: null,
        selectedBillingStateId: null,
        selectedShippingMethod : 'store_pickup',
        billingZip: '',
        phoneNumber: '',
        
        cart: [],
        subtotal: 0,
        taxRate: 0,
        taxTotal: 0,
        shipping: 0,
        productCount: 0,
        grandTotal: 0,
        couponCode: '',
        discount: 0,

        useShippingAsBilling: true,

        // Country & State Data
        countries: @json($countries),
        states: @json($states),

        // Country & State Filters for shipping
        showShippingCountryDropdown: false,
        showShippingStateDropdown: false,
        filteredShippingCountries: [],
        shippingCountryFilter: '',
        selectedShippingCountry: null,
        filteredShippingStates: [],
        shippingStateFilter: '',
        selectedShippingState: null,
        addressErrorMessage: '',
        addressError: false,

        // Country & State Filters for billing
        showBillingCountryDropdown: false,
        showBillingStateDropdown: false,
        billingCountryFilter: '',
        billingStateFilter: '',
        selectedBillingCountry: null,
        filteredBillingCountries: [],
        selectedBillingState: null,
        filteredBillingStates: [],
        selectedBillingStateId: null,

        phoneError: false,
        phoneErrorMessage: '',

        // Initialize cart data and totals
        loadCart() {
            this.cart = JSON.parse(localStorage.getItem("cart")) || [];
            this.filteredShippingCountries = this.countries;
            this.filteredShippingStates = this.states.filter(state => state.shipping_country_id === this?.selectedShippingCountry?.id);
            this.updateCartTotals();
            this.useShippingAsBillingHandler();
        },

        // Calculate subtotal, tax, shipping, and grand total
        updateCartTotals() {
            // Calculate subtotal
            this.subtotal = this.cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
            this.calculateShipping();
            // Calculate tax total, ensuring it's treated as a number
            this.taxTotal = parseFloat((this.subtotal * this.taxRate / 100).toFixed(2));
            
            // Calculate grand total and ensure it's also a number
            this.grandTotal = (this.subtotal + this.taxTotal + this.shipping).toFixed(2);
            this.calculateProductCount();
        },

        // Count the total number of items in the cart
        calculateProductCount() {
            this.productCount = this.cart.reduce((acc, item) => acc + item.qty, 0);
            document.querySelector('.bb-cart-count').innerText = this.productCount;
        },

        // Handle country selection and filter states accordingly
        shippingCountrySelectHandler() {
            this.filteredShippingCountries = this.countries.filter(country =>
                country.name.toLowerCase().includes(this.shippingCountryFilter.toLowerCase())
            );
        },

        selectShippingCountry(country) {
            this.selectedShippingCountry = country;
            this.shippingCountryFilter = country.name;
            this.shipping_country_id = country.id;
            this.filteredShippingStates = this.states;
        },

        verifyShippingCountrySelection() {
            const matchingCountry = this.countries.find(
                country => country.name.toLowerCase() === this.shippingCountryFilter.toLowerCase()
            );
            if (matchingCountry) {
                this.selectShippingCountry(matchingCountry);
            } else {
                this.shippingCountryFilter = '';
                this.selectedShippingCountry = null;
                this.shipping_country_id = null;
            }
        },

        // Handle state selection, setting delivery fee, tax, and zip validation
        shippingStateSelectHandler() {
            this.filteredShippingStates = this.states.filter(state =>
                state.state.toLowerCase().includes(this.shippingStateFilter.toLowerCase())
            );
        },

        selectShippingState(state) {
            this.selectedShippingState = state;
            this.shippingStateFilter = state.state;
            this.selectedShippingStateId = state.id;
            this.shipping = parseFloat(state.delivery_fee) || 0;
            this.taxRate = state.tax_rate || 0;
            this.updateCartTotals();
            this.validateZip();
            this.economyShippingCharge();
        },

        verifyShippingStateSelection() {
            const matchingState = this.states.find(
                state => state.state.toLowerCase() === this.shippingStateFilter.toLowerCase()
            );
            if (matchingState) {
                this.selectShippingState(matchingState);
            } else {
                this.shippingStateFilter = '';
                this.selectedShippingState = null;
                this.shipping = 0;
                this.updateCartTotals();
            }
        },

        calculateShipping() {
            if(this.selectedShippingMethod === 'store_pickup') {
                this.shipping = 0;
            } else{
                if (this.subtotal >= 200) {
                    this.shipping = 0;
                } else {
                    // get the selected state and set the delivery fee
                    if (this.selectedShippingState) {
                        this.economyShippingCharge();
                    }
                }
            }
        },
        economyShippingCharge() {
             // Prepare the payload with required data
            const payload = {
                subtotal: this.subtotal,
                state_id: this.selectedShippingStateId,
                zip_code: this.shippingZip,
                country_id: this.shipping_country_id,
                city: this.shippingCity,
                cart: this.cart,
            };

            fetch('/shipping/economy-charge', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(payload),
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch economy delivery charge');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    if (data.total_price !== undefined) {
                        this.shipping = parseFloat(data.total_price);
                        this.updateCartTotals();
                    } else {
                        console.error('Invalid response format:', data);
                    }
                })
                .catch(error => {
                    this.shipping = 0;
                    console.error('Error fetching economy delivery charge:', error);
                });
        },

        // Validate the zip code based on selected state's pattern
        validateZip() {
            const zipCodeInput = document.getElementById('zip-code-input');
            const zipCodeError = document.getElementById('zip-code-error');
            const zipCode = zipCodeInput ? zipCodeInput.value : '';
            this.economyShippingCharge();
            if (this.selectedShippingState && this.selectedShippingState.zip_code_pattern) {
                const rawPattern = this.selectedShippingState.zip_code_pattern;
                const formattedPattern = `^(${rawPattern})$`;
                const zipCodePattern = new RegExp(formattedPattern);
                if (!zipCodePattern.test(zipCode)) {
                    /// show error message and prevent form submission if invalid
                    zipCodeError.classList.remove('hidden');
                    //  change the border color to red
                    zipCodeInput.classList.add('border-red-400');
                    // change the focus ring color to red
                    zipCodeInput.classList.add('focus:border-red-400');
                    // modify the message
                    zipCodeError.innerText = 'Please enter a valid zip code.';
                    // prevent form submission
                    return false;
                    
                } else {
                    zipCodeError.classList.add('hidden');
                    zipCodeInput.classList.remove('border-red-400');
                    zipCodeInput.classList.remove('focus:border-red-400');
                }
            }
        },

        // Handle billing country selection and filter states accordingly
        billingCountrySelectHandler() {
            this.filteredBillingCountries = this.countries.filter(country =>
                country.name.toLowerCase().includes(this.billingCountryFilter.toLowerCase())
            );
        },

        selectBillingCountry(country) {
            this.selectedBillingCountry = country;
            this.billingCountryFilter = country.name;
            this.selectedBillingCountryId = country.id;
            this.filteredBillingStates = this.states.filter(state => state.shipping_country_id === country.id);
        },
        
        verifyBillingCountrySelection() {
            const matchingCountry = this.countries.find(
                country => country.name.toLowerCase() === this.billingCountryFilter.toLowerCase()
            );
            if (matchingCountry) {
                this.selectBillingCountry(matchingCountry);
            } else {
                this.billingCountryFilter = '';
                this.selectedBillingCountry = null;
                this.selectedBillingCountryId = null;
            }
        },

        // Handle billing state selection
        billingStateSelectHandler() {
            this.filteredBillingStates = this.states.filter(state =>
                state.state.toLowerCase().includes(this.billingStateFilter.toLowerCase())
            );
        },

        selectBillingState(state) {
            this.selectedBillingState = state;
            this.billingStateFilter = state.state;
            this.selectedBillingStateId = state.id;
        },

        useShippingAsBillingHandler() {
            if (this.useShippingAsBilling) {
                this.billingFullName = this.shippingFullName;
                this.billingAddress = this.shippingAddress;
                this.billingAddress2 = this.shippingAddress2;
                this.billingCity = this.shippingCity;
                this.selectedBillingCountry = this.selectedShippingCountry;
                this.selectedBillingCountryId = this.shipping_country_id;
                this.selectedBillingState = this.selectedShippingState;
                this.selectedBillingStateId = this.selectedShippingStateId;
                this.billingZip = this.shippingZip;
            }
        },

        validatePhoneNumber() {
            // Regex for US phone number validation
            const phoneRegex = /^\+?1? ?\d{10}$|^\(\d{3}\) \d{3}-\d{4}$/; 
            // Explanation:
            // ^\+?1? ? matches an optional + followed by an optional 1 and an optional space
            // \d{10} matches exactly 10 digits 
            // | separates this pattern from the next
            // ^\(\d{3}\) \d{3}-\d{4}$ matches the format (123) 456-7890

            if (this.phoneNumber.match(phoneRegex)) {
                this.phoneError = false;
                this.phoneErrorMessage = '';
            } else {
                this.phoneError = true;
                this.phoneErrorMessage = 'Please enter a valid phone number in the format (123) 456-7890';
            }
        },
            
        // submit the form
        placeOrder() {
            const orderData = {
                cart: this.cart,
                shipping: this.shipping,
                tax_rate: this.taxRate,
                tax_amount: this.taxTotal,
                total: this.grandTotal,
                shipping_fullname: this.shippingFullName,
                shipping_address: this.shippingAddress,
                shipping_address2: this.shippingAddress2,
                shipping_city: this.shippingCity,
                shipping_state: this.selectedShippingState,
                shipping_state_id: this.selectedShippingStateId,
                shipping_zip: this.shippingZip,
                shipping_country: this.selectedShippingCountry,
                shipping_country_id: this.shipping_country_id,
                phone: this.phoneNumber,
                use_shipping_as_billing: this.useShippingAsBilling,
                billing_name: this.billingFullName,
                billing_address: this.billingAddress,
                billing_address2: this.billingAddress2,
                billing_city: this.billingCity,
                billing_state: this.selectedBillingState,
                billing_zip: this.billingZip,
                billing_country: this.selectedBillingCountry,
                payment_method: 'stripe',
                shipping_method: this.selectedShippingMethod,
                total_items: this.productCount,
                discount_amount: 0, //todo: calculate discount
                subtotal: this.subtotal,
                shipping_cost: this.shipping,
                total: this.grandTotal,
                notes: localStorage.getItem('orderNote'),
                ip_address: '{{ request()->ip() }}',
                user_agent: navigator.userAgent,
            }

            fetch('{{ route('submit.order') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // CSRF token
                },
                body: JSON.stringify(orderData), // Ensure orderData has all required fields
            })
            .then(response => {
                // Check if the response is not OK
                if (!response.ok) {
                    return response.json().then(errorData => {
                        // Handle validation errors
                        throw new Error(JSON.stringify(errorData.errors));
                    });
                }
                return response.json(); // Return the response data if OK
            })
            .then(data => {
                console.log('Order submitted successfully:', data.message);
                // Redirect to Stripe Checkout
                if (data.url) {
                    window.location.href = data.url; // Redirect to the Stripe session URL
                } else {
                    console.error('No URL returned for Stripe checkout.');
                    toastr.error('Failed to retrieve payment link. Please try again.', 'Error');
                }

            })
            .catch(error => {
                this.loading = false; 
                // Handle errors here, including validation errors
                try {
                    const errors = JSON.parse(error.message);
                    console.error('Validation errors:', errors);
                    
                    // Display the first error in toast notification
                    const firstErrorMessage = Object.values(errors)[0][0]; // Get the first error message
                    toastr.error(firstErrorMessage, 'Validation Error'); // Display the toast notification
                } catch (e) {
                    console.error('There was a problem with your order:', error);
                    toastr.error('Failed to submit order. Please try again.', 'Error');
                }
            });

        }
    }
}
</script>
@endpush