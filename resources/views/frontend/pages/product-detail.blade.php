@extends('frontend.layouts.default')

@section('title', $pageTitle)

@section('content')
    <!-- Breadcrumb -->
    <section
        class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">

                        <div class="min-[768px]:w-[100%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]">
                                    <a href="{{ route('home') }}"
                                        class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a>
                                </li>
                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i>
                                </li>
                                <li
                                    class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">
                                    <a href="{{ route('category.products', $product->categories->first()->slug) }}"
                                        class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">{{ $product->categories->first()->name }}</a>
                                </li>

                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i>
                                </li>
                                <li
                                    class="bb-breadcrumb-item font-Poppins  text-ellipsis truncate text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">
                                    <a href="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}"
                                        class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">{{ $product->name }}</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- product page -->
    <section class="section-product py-[50px] max-[1199px]:py-[35px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-single-pro mb-[24px] single-product-info">
                        <div class="flex flex-wrap mx-[-12px]">
                            <div class="min-[992px]:w-[41.66%] w-full px-[12px] mb-[24px]">
                                <div
                                    class="single-pro-slider sticky top-[0] p-[15px] border-[1px] border-solid border-[#eee] rounded-[24px] max-[991px]:max-w-[500px] max-[991px]:m-auto">
                                    <div class="single-product-cover">
                                        @if($product->images)

                                        @foreach($product->images as $image)
                                        <div class="single-slide zoom-image-hover rounded-tl-[15px] rounded-tr-[15px]">
                                            <img class="img-responsive rounded-tl-[15px] rounded-tr-[15px] lozad"
                                                data-src="{{ asset($image->image_url) }}" alt="{{ $product->name }}"
                                                {{-- src="{{ asset($image->image_url) }}" alt="{{ $product->name }}" --}}
                                                alt="{{ $product->name }}"
                                                >
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="single-slide zoom-image-hover rounded-tl-[15px] rounded-tr-[15px]">
                                            <img class="img-responsive rounded-tl-[15px] rounded-tr-[15px] lozad"
                                            data-src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}"
                                                {{-- src="{{ asset($product->featured_image) }}" alt="{{ $product->name }}" --}}
                                                alt="{{ $product->name }}"
                                                >
                                        </div>
                                        @endif
                                    </div>
                                    <div class="single-nav-thumb w-full overflow-hidden">
                                        @if($product->images)
                                        @foreach($product->images as $image)
                                        <div class="single-slide px-[10px] block">
                                            <img class="img-responsive border-[1px] border-solid border-transparent transition-all duration-[0.3s] ease delay-[0s] cursor-pointer rounded-[15px] lozad"
                                                data-src="{{ asset($image->image_url) }}" alt="{{ $product->name }}"
                                                {{-- src="{{ asset($image->image_url) }}" alt="{{ $product->name }}" --}}
                                                alt="{{ $product->name }}"
                                                >
                                        </div>
                                        @endforeach
                                        @else
                                        <div class="single-slide px-[10px] block">
                                            <img class="img-responsive border-[1px] border-solid border-transparent transition-all duration-[0.3s] ease delay-[0s] cursor-pointer rounded-[15px] lozad"
                                                data-src="{{ asset($product->featured_image) }}"
                                                {{-- src="{{ asset('storage/'. $product->featured_image) }}" --}}
                                                alt="{{ $product->name }}">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="min-[992px]:w-[58.33%] w-full px-[12px] mb-[24px]">
                                <div class="bb-single-pro-contact w-fit	">
                                    <div class="bb-sub-title mb-[20px]">
                                        <h4
                                            class="font-quicksand text-[22px] tracking-[0.03rem] font-bold leading-[1.2] text-[#3d4750]">
                                            {{ $product->name }}
                                        </h4>
                                    </div>
                                    <div class="bb-single-rating mb-[12px]">
                                        <span class="bb-pro-rating mr-[10px]">
                                            <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                            <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                            <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                            <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                            <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                            <!-- <i class="ri-star-line float-left text-[15px] mr-[3px] text-[#777]"></i> -->
                                        </span>
                                        <span class="bb-read-review">
                                            |&nbsp;&nbsp;<a href="#bb-spt-nav-review"
                                                class="font-Poppins text-[15px] font-light leading-[28px] tracking-[0.03rem] text-[#6c7fd8]">0
                                                Ratings</a>
                                        </span>
                                    </div>
                                    <p class="font-Poppins text-[15px] font-light leading-[28px] tracking-[0.03rem]  ">
                                        {{ Str::limit(html_entity_decode(strip_tags($product->full_description)), 240) }}
                                    </p>
                                    <div class="bb-single-price-wrap flex justify-between py-[10px]">
                                        <div class="bb-single-price py-[15px]">
                                            <div class="price mb-[8px]">
                                                <h5 class="font-quicksand leading-[1.2] tracking-[0.03rem] text-[20px] font-extrabold text-[#3d4750]">
                                                    ${{  $product->discount_price > 0 ? number_format($product->discount_price, 2) :number_format($product->price, 2)   }}
                                                    @if($product->discount_price > 0)
                                                    @php
                                                        $discount = 100 - (($product->discount_price / $product->price) * 100);
                                                    @endphp
                                                    <span class="text-[#3d4750] text-[20px]">
                                                        -{{ number_format($discount, 0) }}%
                                                    </span>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div class="mrp">
                                                <p
                                                    class="font-Poppins text-[16px] font-light text-[#686e7d] leading-[28px] tracking-[0.03rem]">
                                                    M.R.P. : <span
                                                        class="text-[15px] line-through">${{  number_format($product->price , 2) }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="bb-single-price py-[15px]">
                                            <div class="sku mb-[8px]">
                                                <h5
                                                    class="font-quicksand text-[18px] font-extrabold leading-[1.2] tracking-[0.03rem] text-[#3d4750]">
                                                    SKU#: {{ $product->sku }}</h5>
                                            </div>
                                            <div class="stock">
                                                @if($product->stock_quantity > 0 || $product->allow_out_of_stock_orders > 0 || $product->in_stock > 0)
                                                <span class="text-[18px] text-[#6c7fd8]">In stock</span>
                                                @else
                                                <span class="text-[18px] text-[#f44336]">Out of stock</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($product->variants)
                                        @php
                                            // Group by unique sizes with price information
                                            $sizeVariants = $product->variants->filter(function ($variant) {
                                                return !empty($variant['size']);
                                            })->unique('size');

                                            // Group by unique colors with price information
                                            $colorVariants = $product->variants->filter(function ($variant) {
                                                return !empty($variant['color']);
                                            })->unique('color');
                                        @endphp
                                        @if(count($sizeVariants) > 0)
                                            <div class="bb-single-pro-weight size-variant mb-[24px]">
                                                <div class="pro-title mb-[12px]">
                                                    <h4
                                                        class="font-quicksand leading-[1.2] tracking-[0.03rem] text-[16px] font-bold uppercase text-[#3d4750]">
                                                        Size</h4>
                                                </div>
                                                <div class="bb-pro-variation-contant">
                                                    <ul class="flex flex-wrap m-[-2px]">
                                                        @foreach($sizeVariants as $key => $variant)
                                                            @php
                                                                $activeClass = $key == 0 ? 'active-variation final-variant-selection' : '';
                                                            @endphp
                                                            <li class="my-[10px] mx-[2px] py-[2px] px-[15px] border-[1px] border-solid border-[#eee] rounded-[10px] cursor-pointer size-option {{ $activeClass }} "
                                                                data-tooltip="{{ $variant->size }}"
                                                                title="{{ $variant->size }}"
                                                                data-size="{{$variant}}">
                                                                <span
                                                                    class="font-Poppins text-[#686e7d] font-light text-[14px] leading-[28px] tracking-[0.03rem]">{{ $variant->size }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                        @if(count($colorVariants) > 0)
                                            <div class="bb-single-pro-weight color-variant  mb-[24px]">
                                                <div class="pro-title mb-[12px]">
                                                    <h4
                                                        class="font-quicksand leading-[1.2] tracking-[0.03rem] text-[16px] font-bold uppercase text-[#3d4750]">
                                                        Color</h4>
                                                </div>
                                                <div class="bb-pro-variation-contant">
                                                    <ul class="flex flex-wrap m-[-2px]">
                                                        @foreach($colorVariants as $key => $variant)
                                                        @php
                                                        $activeClass = $key == 0 ? 'active-variation final-variant-selection' : '';
                                                        @endphp
                                                        <li class="my-[10px] mx-[2px] py-[2px] px-[15px] border-[1px] border-solid border-[#eee] rounded-[10px] cursor-pointer color-option {{ $activeClass }}"
                                                            data-tooltip="{{ $variant->color }}"
                                                            title="{{ $variant->color }}"
                                                            data-color="{{$variant}}">
                                                            <span
                                                                class="font-Poppins text-[#686e7d] font-light text-[14px] leading-[28px] tracking-[0.03rem]">{{ $variant->color }}</span>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                    <div class="bb-single-qty flex flex-wrap m-[-2px]">
                                        @if($product->stock_quantity > 0 || $product->allow_out_of_stock_orders > 0 || $product->in_stock > 0)
                                            <div
                                                class="qty-plus-minus m-[2px] w-[85px] h-[40px] py-[7px] border-[1px] border-solid border-[#eee] overflow-hidden relative flex items-center justify-between bg-[#fff] rounded-[10px]">
                                                <input
                                                    class="qty-input text-[#777] float-left text-[14px] h-auto m-[0] p-[0] text-center w-[32px] outline-[0] font-normal leading-[35px] rounded-[10px]"
                                                    type="text" name="bb-qtybtn" value="1">
                                            </div>
                                            <!-- add to cart -->
                                            <div class="bb-single-cart m-[2px]">
                                                <button type="button"
                                                    data-product="{{ $product }}"
                                                    data-url="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}"
                                                    class="add-to-cart bb-btn-2 transition-all duration-[0.3s] ease-in-out h-[40px] flex font-Poppins leading-[28px] tracking-[0.03rem] py-[6px] px-[25px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]">
                                                    Add To Cart
                                                </button>
                                            </div>
                                        @endif
                                        <!-- view cart -->
                                        <div class="bb-single-cart m-[2px]">
                                            <a href="{{ route('cart') }}"
                                                class="bb-btn-2 transition-all duration-[0.3s] ease-in-out h-[40px] flex font-Poppins leading-[28px] tracking-[0.03rem] py-[6px] px-[25px] text-[14px] font-normal text-[#fff] bg-[#3d4750] rounded-[10px] border-[1px] border-solid border-[#3d4750] hover:bg-transparent hover:border-[#6c7fd8] hover:text-[#6c7fd8]">
                                                View Cart
                                            </a>
                                        </div>
                                        {{-- <ul class="bb-pro-actions my-[2px] flex">
                                            <li class="bb-btn-group">
                                                <a href="javascript:void(0)" title="heart"
                                                    class="transition-all duration-[0.3s] ease-in-out w-[40px] h-[40px] mx-[2px] flex items-center justify-center text-[#fff] bg-[#fff] hover:bg-[#6c7fd8] border-[1px] border-solid border-[#eee] rounded-[10px]">
                                                    <i class="ri-heart-line text-[16px] leading-[10px] text-[#777]"></i>
                                                </a>
                                            </li>
                                        </ul> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bb-single-pro-tab">
                        <div class="bb-pro-tab mb-[24px]">
                            <ul class="bb-pro-tab-nav flex flex-wrap mx-[-20px] max-[991px]:justify-center" id="ProTab">
                                <li class="nav-item relative leading-[28px]">
                                    <a class="nav-link px-[20px] font-Poppins text-[16px] text-[#686e7d] font-medium capitalize leading-[28px] tracking-[0.03rem] block active"
                                        href="#detail">Detail</a>
                                </li>
                                <li class="nav-item relative leading-[28px]">
                                    <a class="nav-link px-[20px] font-Poppins text-[16px] text-[#686e7d] font-medium capitalize leading-[28px] tracking-[0.03rem] block"
                                        href="#information">Information</a>
                                </li>
                                <li class="nav-item relative leading-[28px]">
                                    <a class="nav-link px-[20px] font-Poppins text-[16px] text-[#686e7d] font-medium capitalize leading-[28px] tracking-[0.03rem] block"
                                        href="#reviews">Reviews</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pro-pane" id="detail">
                                <div class="bb-inner-tabs border-[1px] border-solid border-[#eee] p-[15px] rounded-[20px]">
                                    <div class="bb-details">
                                        <p
                                            class="mb-[12px] font-Poppins text-[#686e7d] leading-[28px] tracking-[0.03rem] font-light">
                                            {!! $product->full_description !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pro-pane" id="information">
                                <div class="bb-inner-tabs border-[1px] border-solid border-[#eee] p-[15px] rounded-[20px]">
                                    <div class="information">
                                        {!! $product->full_description !!}
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pro-pane" id="reviews">
                                <div class="bb-inner-tabs border-[1px] border-solid border-[#eee] p-[15px] rounded-[20px]">
                                    <div class="bb-reviews">
                                        <!-- <div class="reviews-bb-box flex mb-[24px] max-[575px]:flex-col">
                                                <div class="inner-image mr-[12px] max-[575px]:mr-[0] max-[575px]:mb-[12px]">
                                                    <img src="assets/img/reviews/1.jpg" alt="img-1"
                                                        class="w-[50px] h-[50px] max-w-[50px] rounded-[10px]">
                                                </div>
                                                <div class="inner-contact">
                                                    <h4 class="font-quicksand leading-[1.2] tracking-[0.03rem] mb-[5px] text-[16px] font-bold text-[#3d4750]">
                                                        Mariya Lykra</h4>
                                                    <div class="bb-pro-rating flex">
                                                        <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                        <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                        <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                        <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                        <i class="ri-star-line float-left text-[15px] mr-[3px] text-[#777]"></i>
                                                    </div>
                                                    <p class="font-Poppins text-[14px] leading-[26px] font-light tracking-[0.03rem] text-[#686e7d]">
                                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo,
                                                        hic expedita asperiores eos neque cumque impedit quam, placeat
                                                        laudantium soluta repellendus possimus a distinctio voluptate
                                                        veritatis nostrum perspiciatis est! Commodi!</p>
                                                </div>
                                            </div> -->
                                    </div>
                                    <div class="bb-reviews-form">
                                        <h3
                                            class="font-quicksand tracking-[0.03rem] leading-[1.2] mb-[8px] text-[20px] font-bold text-[#3d4750]">
                                            Add a Review</h3>
                                        <div class="bb-review-rating flex mb-[12px]">
                                            <span
                                                class="pr-[10px] font-Poppins text-[15px] font-semibold leading-[26px] tracking-[0.02rem] text-[#3d4750]">Your
                                                ratting :</span>
                                            <div class="bb-pro-rating">
                                                <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                <i class="ri-star-fill float-left text-[15px] mr-[3px] text-[#fea99a]"></i>
                                                <i class="ri-star-line float-left text-[15px] mr-[3px] text-[#777]"></i>
                                            </div>
                                        </div>
                                        <form action="#">
                                            <div class="input-box mb-[24px]">
                                                <input type="text" placeholder="Name" name="your-name"
                                                    class="w-full h-[50px] border-[1px] border-solid border-[#eee] pl-[20px] outline-[0] text-[14px] font-normal text-[#777] rounded-[20px] p-[10px]">
                                            </div>
                                            <div class="input-box mb-[24px]">
                                                <input type="email" placeholder="Email" name="your-email"
                                                    class="w-full h-[50px] border-[1px] border-solid border-[#eee] pl-[20px] outline-[0] text-[14px] font-normal text-[#777] rounded-[20px] p-[10px]">
                                            </div>
                                            <div class="input-box mb-[24px]">
                                                <textarea name="your-comment" placeholder="Enter Your Comment"
                                                    class="w-full h-[100px] border-[1px] border-solid border-[#eee] py-[20px] pl-[20px] pr-[10px] outline-[0] text-[14px] font-normal text-[#777] rounded-[20px] p-[10px]"></textarea>
                                            </div>
                                            <div class="input-button">
                                                <a href="javascript:void(0)"
                                                    class="bb-btn-2 transition-all duration-[0.3s] ease-in-out h-[40px] inline-flex font-Poppins leading-[28px] tracking-[0.03rem] py-[4px] px-[15px] text-[14px] font-normal text-[#fff] bg-[#6c7fd8] rounded-[10px] border-[1px] border-solid border-[#6c7fd8] hover:bg-transparent hover:border-[#3d4750] hover:text-[#3d4750]">View
                                                    Cart</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related product section -->
    <section class="section-related-product py-[50px] max-[1199px]:py-[35px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="section-title mb-[20px] pb-[20px] z-[5] relative flex flex-col items-center text-center max-[991px]:pb-[0]"
                        data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="section-detail max-[991px]:mb-[12px]">
                            <h2
                                class="bb-title font-quicksand mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] relative inline capitalize leading-[1] tracking-[0.03rem] max-[767px]:text-[23px]">
                                Related <span class="text-[#6c7fd8]">Product</span></h2>
                            <p
                                class="font-Poppins max-w-[400px] mt-[10px] text-[14px] text-[#686e7d] leading-[18px] font-light tracking-[0.03rem] max-[991px]:mx-[auto]">
                                Browse The Collection of Top Products.</p>
                        </div>
                    </div>
                </div>
                <div class="w-full px-[12px]">
                    <div class="bb-deal-slider m-[-12px]">
                        <div class="bb-deal-block owl-carousel">
                            @foreach ($relatedProducts as $product )
                            <div class="bb-deal-card p-[12px]" data-aos="fade-up" data-aos-duration="1000"
                                data-aos-delay="200">
                                <x-product-thumb :product="$product" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('frontend.partials.services')
@endsection
@push('scripts')
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": "{{ $product->name }}",
        "image": "{{ asset('storage/' . $product->featured_image) }}",
        "description": "{{ $product->short_description }}",
        "sku": "{{ $product->sku }}",
        "offers": {
        "@type": "Offer",
        "url": "{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}",
        "priceCurrency": "USD",
        "price": "{{ $product->price }}",
        "itemCondition": "https://schema.org/NewCondition",
        "availability": "https://schema.org/InStock"
        }
    }
</script>
    
<script>
$(document).ready(function() {
    let selectedSizePrice = 0;
    let selectedColorPrice = 0;
    let selectedSku = "{{ $product->sku }}";

    // Function to update displayed price
    function updatePrice() {
        let totalPrice = Math.max(selectedSizePrice, selectedColorPrice); // Choose the higher price
        // Update the price
        $('.price h5').text('$' + totalPrice.toFixed(2));

        // update the sku
        $('.sku h5').text('SKU#: ' + selectedSku);
    }

    // Function to set the active option
    function setActiveOption() {
        // Reset all active classes
        $('.size-option, .color-option').removeClass('active-variation final-variant-selection');

        // Find the minimum price option and set it as active
        let minSizePrice = Infinity;
        let minColorPrice = Infinity;

        // Find the minimum price for size options
        $('.size-option').each(function() {
            let currentElement = $(this);
            let sizeData = currentElement.data('size');
            let price = parseFloat(sizeData.price); // Get the price
            if (price < minSizePrice) {
                selectedSku = sizeData.sku;
                minSizePrice = price; // Update minSizePrice
            }
        });

        // Find the minimum price for color options
        $('.color-option').each(function() {
            let currentElement = $(this);
            let colorData = currentElement.data('color');
            let price = parseFloat(colorData.price); // Get the price
            if (price < minColorPrice) {
                selectedSku = colorData.sku;
                minColorPrice = price; // Update minColorPrice
            }
        });

        let activeSku = "{{ $product->sku }}";
        // Set active classes for size options with the lowest prices
        $('.size-option').filter(function() {
            let sizeData = $(this).data('size');
            activeSku = sizeData.sku;
            return parseFloat(sizeData.price) === minSizePrice; // Check if price is equal to minSizePrice
        }).first().addClass('active-variation final-variant-selection');

        // Set active classes for color options with the lowest prices
        $('.color-option').filter(function() {
            let colorData = $(this).data('color');
            activeSku = colorData.sku;
            return parseFloat(colorData.price) === minColorPrice; // Check if price is equal to minColorPrice
        }).first().addClass('active-variation final-variant-selection');
        
        // get the selected size and color sku
        selectedSku = activeSku;
    }

    // Event listener for size selection
    $('.size-option').on('click', function() {
        let sizeData = $(this).data('size');
        selectedSku = sizeData.sku;
        selectedSizePrice = parseFloat(sizeData.price); // Get the price
        updatePrice();
    });

    // Event listener for color selection
    $('.color-option').on('click', function() {
        let colorData = $(this).data('color');
        selectedSku = colorData.sku;
        selectedColorPrice = parseFloat(colorData.price); // Get the price
        updatePrice();
    });


    // Initial call to set the active option
    setActiveOption();
});

$(document).ready(function() {
    $(".qty-input").on("change", function() {
        let value = $(this).val();
        if (value < 1) {
            $(this).val(1);
        }
    });
});
</script>
@endpush