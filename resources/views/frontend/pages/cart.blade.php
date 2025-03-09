@extends('frontend.layouts.default')

@section('title', $pageTitle)

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Cart</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Cart</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart -->
    <section class="section-cart py-[50px] max-[1199px]:py-[35px]" x-data="cartHandler()" x-init="loadCart()" >
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full mb-[-24px]">

                <div class="min-[992px]:w-[66.66%] w-full px-[12px] mb-[24px]">
                    <div class="bb-cart-table border-[1px] border-solid border-[#eee] rounded-[20px] overflow-hidden max-[1399px]:overflow-y-auto" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <div class="overflow-x-auto">
                            <table class="w-full max-[1399px]:w-[780px]">
                                <thead>
                                    <tr class="border-b-[1px] border-solid border-[#eee]">
                                        <th class="font-Poppins p-[12px] text-left text-[16px] font-medium text-[#3d4750] leading-[26px] tracking-[0.02rem] capitalize">Product</th>
                                        <th class="font-Poppins p-[12px] text-left text-[16px] font-medium text-[#3d4750] leading-[26px] tracking-[0.02rem] capitalize">Price</th>
                                        <th class="font-Poppins p-[12px] text-left text-[16px] font-medium text-[#3d4750] leading-[26px] tracking-[0.02rem] capitalize">Quantity</th>
                                        <th class="font-Poppins p-[12px] text-left text-[16px] font-medium text-[#3d4750] leading-[26px] tracking-[0.02rem] capitalize">Total</th>
                                        <th class="font-Poppins p-[12px] text-left text-[16px] font-medium text-[#3d4750] leading-[26px] tracking-[0.02rem] capitalize"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in cart" :key="index">
                                        <tr class="border-b-[1px] border-solid border-[#eee]">
                                            <td class="p-[12px]">
                                                <a :href="item.url">
                                                    <div class="Product-cart flex items-center">
                                                        <!-- Product Image -->
                                                        <img 
                                                            :src="`/storage/${item.image}`" 
                                                            :alt="item.title || 'Product Image'" 
                                                            class="w-[70px] h-[70px] object-contain border border-solid border-[#eee] rounded-[10px]"
                                                        >
                                                        
                                                        <!-- Product Details -->
                                                        <div class="ml-[10px]">
                                                            <!-- Product Title -->
                                                            <span 
                                                                class="font-Poppins text-[14px] font-normal leading-[28px] tracking-[0.03rem] text-[#686e7d]" 
                                                                x-text="item.title"
                                                            ></span>
                                                    
                                                            <!-- Optional Variant Details -->
                                                            <div class="mt-[5px]">
                                                                <!-- Optional Size -->
                                                                <template x-if="item.variant?.size">
                                                                    <span class="font-Poppins text-[12px] font-normal leading-[20px] tracking-[0.03rem] text-[#686e7d]">
                                                                        Size: <span class="font-bold" x-text="item.variant.size"></span>
                                                                    </span>
                                                                </template>
                                                    
                                                                <!-- Optional Color -->
                                                                <template x-if="item.variant?.color">
                                                                    <span class="font-Poppins text-[12px] font-normal leading-[20px] tracking-[0.03rem] text-[#686e7d]">
                                                                        Color: <span class="font-bold" x-text="item.variant.color"></span>
                                                                    </span>
                                                                </template>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </a>
                                            </td>
                                            <td class="p-[12px]">
                                                <span class="price font-Poppins text-[15px] font-medium leading-[26px] tracking-[0.02rem] text-[#686e7d]" x-text="`$${item.price.toFixed(2)}`"></span>
                                            </td>
                                            <td class="p-[12px]">
                                                <input class="qty-input text-[#777] float-left text-[14px] h-[auto] m-[0] p-[0] text-center w-[60px] outline-[0] font-normal leading-[35px] rounded-[10px]" type="number" name="bb-qtybtn"  min="1" x-model.number="item.qty" @change="updateCart()" @input="updateCart()">
                                            </td>
                                            <td class="p-[12px]">
                                                <span class="price font-Poppins text-[15px] font-medium leading-[26px] tracking-[0.02rem] text-[#686e7d]" x-text="`$${(item.price * item.qty).toFixed(2)}`"></span>
                                            </td>
                                            <td class="p-[12px]">
                                                <div class="pro-remove">
                                                    <a href="javascript:void(0)" @click="removeItem(index)">
                                                        <i class="ri-delete-bin-line transition-all duration-[0.3s] ease-in-out text-[20px] text-[#686e7d] hover:text-[#ff0000]"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                    <tr x-show="cart.length == 0">
                                        <td colspan="5" class="text-center p-[8px] font-Poppins text-[15px] font-normal leading-[26px] tracking-[0.02rem] text-[#686e7d]">
                                            <span>No items in cart <i class="ri-sad-line text-[20px] text-[#686e7d]"></i></span>    
                                        </td> 
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                    
                </div>
                <div class="min-[992px]:w-[33.33%] w-full px-[12px] mb-[24px]">
                    <div class="bb-cart-sidebar-block p-[20px] bg-[#f8f8fb] border-[1px] border-solid border-[#eee] rounded-[20px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="bb-sb-title mb-[20px]">
                            <h3 class="font-quicksand tracking-[0.03rem] leading-[1.2] text-[20px] font-bold text-[#3d4750]">Summary</h3>
                        </div>
                        <div class="bb-sb-note mb-[20px]"  x-data="{
                                note: '',
                                loadNote() {
                                    this.note = localStorage.getItem('orderNote') || '';
                                },
                                saveNote() {
                                    localStorage.setItem('orderNote', this.note);
                                }
                            }" 
                            x-init="loadNote()" 
                            x-effect="saveNote()"
                        >
                            <textarea 
                            class="w-full h-[150px] p-[10px] text-[14px] font-normal text-[#777] border-[1px] border-solid border-[#eee] outline-[0] rounded-[10px]" 
                            placeholder="Add a note to your order"
                            x-model="note"
                            maxlength="300"
                            ></textarea>
                            <div class="text-right mt-1 text-[12px] text-[#686e7d]">
                                <span x-text="`${note.length}/300`"></span>  <!-- Character counter -->
                            </div>
                        </div>
                        <div class="bb-sb-blok-contact">
                            <div class="bb-cart-summary">
                                <div class="inner-summary">
                                    <ul>
                                        <li class="mb-[12px] flex justify-between leading-[28px]">
                                            <span class="text-left font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] text-[#686e7d] font-medium">Sub-Total</span>
                                            <span class="text-right font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] text-[#686e7d] font-semibold"  x-text="`$${subtotal.toFixed(2)}`"></span>
                                        </li>
                                        <li class="mb-[12px] flex justify-between leading-[28px]">
                                            <span class="text-left font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] text-[#686e7d] font-medium">Delivery Charges</span>
                                            <span class="text-right font-Poppins leading-[28px] tracking-[0.03rem] text-[8px] text-[#686e7d] font-semibold">Shipping & taxes calculated at checkout</span>
                                        </li>
                                        {{-- <li class="mb-[12px] flex justify-between leading-[28px]">
                                            <span class="text-left font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] text-[#686e7d] font-medium">Coupon Discount</span>
                                            <span class="text-right font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] text-[#686e7d] font-semibold">
                                                <a class="bb-coupon drop-coupon font-Poppins leading-[28px] tracking-[0.03rem] text-[14px] font-medium text-[#ff0000] cursor-pointer">Apply Coupon</a>
                                            </span>
                                        </li> --}}
                                        {{-- <li class="mb-[12px] flex justify-between leading-[28px]">
                                            <div class="coupon-down-box w-full">
                                                <form method="post" class="relative mb-[15px]">
                                                    <input class="bb-coupon w-full p-[10px] text-[14px] font-normal text-[#686e7d] border-[1px] border-solid border-[#eee] outline-[0] rounded-[10px]" type="text" placeholder="Enter Your coupon Code" name="bb-coupon" required>
                                                    <button class="bb-btn-2 transition-all duration-[0.3s] ease-in-out my-[8px] mr-[8px] flex justify-center items-center absolute right-[0] top-[0] bottom-[0] font-Poppins leading-[28px] tracking-[0.03rem] py-[2px] px-[12px] text-[13px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]" type="submit">Apply</button>
                                                </form>
                                            </div>
                                        </li> --}}
                                    </ul>
                                </div>
                                <div class="summary-total border-t-[1px] border-solid border-[#eee] pt-[15px]">
                                    <ul class="mb-[0]">
                                        <li class="mb-[6px] flex justify-between">
                                            <span class="text-left font-Poppins text-[16px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Total Amount</span>
                                            <span class="text-right font-Poppins text-[16px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]"  x-text="`$${subtotal.toFixed(2)}`"></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('checkout') }}" class="bb-btn-2 mt-[24px] inline-flex items-center justify-center check-btn transition-all duration-[0.3s] ease-in-out font-Poppins leading-[28px] tracking-[0.03rem] py-[8px] px-[20px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">Check Out</a>
                </div>
            </div>
        </div>
    </section>


    @include('frontend.partials.services')
@endsection

@push('scripts')
    
<script>
    function cartHandler() {
        return {
            cart: [],
            subtotal: 0,
            loadCart() {                
                this.cart = JSON.parse(localStorage.getItem("cart")) || [];
                this.calculateTotal();
            },
            updateCart() {
                this.cart.forEach(item => {
                    if (item.qty < 1) {
                        item.qty = 1; // Set minimum quantity to 1
                    }
                });
                localStorage.setItem("cart", JSON.stringify(this.cart));
                this.calculateTotal();
            },
            removeItem(index) {
                this.cart.splice(index, 1);
                this.updateCart();
                this.calculateProductCount();
                // call the updateCartCount() method from the parent component
            },
            calculateTotal() {
                this.subtotal = this.cart.reduce((acc, item) => acc + (item.price * item.qty), 0);
            },
            calculateProductCount() {
                // change .bb-cart-count text
                let productCount =  this.cart.reduce((acc, item) => acc + item.qty, 0);
                document.querySelector('.bb-cart-count').innerText = productCount;
            }
        }
    }
</script>
@endpush