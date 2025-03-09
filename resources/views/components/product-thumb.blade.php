<div class="bb-pro-box single-product-info bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[20px]">
    <div
        class="bb-pro-img overflow-hidden relative border-b-[1px] border-solid border-[#eee] z-[4]">

            <a href="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}">
                <div
                    class="inner-img relative block overflow-hidden pointer-events-none rounded-t-[20px] aspect-square ">
                    <img class="main-img transition-all duration-[0.3s] ease-in-out w-full  h-full object-contain lozad"
                        {{-- src="{{ asset('storage/' . $product->featured_image) }}" --}}
                        data-src="{{ asset('storage/' . $product->featured_image) }}"
                        alt="{{ $product->name }}">
                    <img class="hover-img transition-all duration-[0.3s] ease-in-out absolute z-[2] top-[0] left-[0] opacity-[0] w-full h-full object-contain lozad"
                        {{-- src="{{ asset('storage/' . $product->featured_image) }}" --}}
                        data-src="{{ asset('storage/' . $product->featured_image) }}"
                        alt="{{ $product->name }}">
                </div>
            </a>
            <ul
                class="bb-pro-actions transition-all duration-[0.3s] ease-in-out my-[0] mx-[auto] absolute z-[9] left-[0] right-[0] bottom-[0] flex flex-row items-center justify-center opacity-[0]">
                {{-- <li
                    class="bb-btn-group transition-all duration-[0.3s] ease-in-out w-[35px] h-[35px] mx-[2px] flex items-center justify-center text-[#fff] bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[10px]">
                    <a href="javascript:void(0)" title="Wishlist"
                        class="w-[35px] h-[35px] flex items-center justify-center">
                        <i
                            class="ri-heart-line transition-all duration-[0.3s] ease-in-out text-[18px] text-[#777] leading-[10px]"></i>
                    </a>
                </li> --}}
                <li
                    class="bb-btn-group transition-all duration-[0.3s] ease-in-out w-[35px] h-[35px] mx-[2px] flex items-center justify-center text-[#fff] bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[10px]">
                    <a href="javascript:void(0)" title="Quick View"
                        class="bb-modal-toggle w-[35px] h-[35px] flex items-center justify-center">
                        <i
                            class="ri-eye-line transition-all duration-[0.3s] ease-in-out text-[18px] text-[#777] leading-[10px]"></i>
                    </a>
                </li>
                @if($product->stock_quantity > 0 || $product->allow_out_of_stock_orders > 0 || $product->in_stock > 0)
                <li
                    class="bb-btn-group add-to-cart-thumb transition-all duration-[0.3s] ease-in-out w-[35px] h-[35px] mx-[2px] flex items-center justify-center text-[#fff] bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[10px]"  
                    data-product="{{ $product }}"
                    data-url="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}">
                    <a href="javascript:void(0)" title="Add To Cart"
                        class="w-[35px] h-[35px] flex items-center justify-center">
                        <i
                            class="ri-shopping-bag-4-line transition-all duration-[0.3s] ease-in-out text-[18px] text-[#777] leading-[10px]"></i>
                    </a>
                </li>
                @endif
            </ul>
    </div>
    <div class="bb-pro-contact p-[20px]">
        <div class="bb-pro-subtitle mb-[8px] flex flex-wrap justify-between">
            <a href="{{ route('category.products', $product->categories->first()->slug) }}"
                class="transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] leading-[16px] text-[#777] font-light tracking-[0.03rem]">
                {{ $product->categories->first()->name }}
            </a>
            <span class="bb-pro-rating">
                <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                <i class="ri-star-line float-left text-[15px] mr-[3px] leading-[18px] text-[#777]"></i>
            </span>
        </div>
        <h4 class="bb-pro-title mb-[8px] text-[16px] leading-[18px]"
            title="{{ $product->name }}">
            <a href="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}"
                class="transition-all duration-[0.3s] ease-in-out font-quicksand w-full block whitespace-nowrap overflow-hidden text-ellipsis text-[15px] leading-[18px] text-[#3d4750] font-semibold tracking-[0.03rem]">{{
                $product->name }}</a>
        </h4>
        <div class="bb-price flex flex-wrap justify-between" data-product="{{ $product }}">
            <div class="inner-price mx-[-3px]">
                <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">
                    {{$product->discount_price ?? $product->price }}
                </span>
                @if($product->discount_price)
                <span class="old-price px-[3px] text-[14px] text-[#686e7d] line-through">
                    ${{$product->price }}
                </span>
                @endif
                @if(!$product->in_stock)
                    <span class="item-left px-[3px] text-[14px] text-[#ff2020]">Out Of Stock</span>
                @endif
                @if($product->variants)
                    @php
                        // Group by unique sizes with price information
                        $sizeVariants = $product->variants->filter(function ($variant) {
                            return !empty($variant['size']);
                        })->unique('size')->values(); // Ensure the collection is indexed from 0

                        // Convert the collection to a JSON-encoded array of objects
                        $sizeVariantsJson = $sizeVariants->toJson();

                        // Group by unique colors with price information
                        $colorVariants = $product->variants->filter(function ($variant) {
                            return !empty($variant['color']);
                        })->unique('color')->values(); // Ensure the collection is indexed from 0

                        // Convert the collection to a JSON-encoded array of objects
                        $colorVariantsJson = $colorVariants->toJson();
                    @endphp
                    @if(count($sizeVariants) > 0)
                        <span class="hidden thumb-size-variants" data-size="{{$sizeVariantsJson}}"></span>
                    @endif
                    @if(count($colorVariants) > 0)
                        <span class="hidden thumb-color-variants" data-color="{{$colorVariantsJson}}"></span>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
