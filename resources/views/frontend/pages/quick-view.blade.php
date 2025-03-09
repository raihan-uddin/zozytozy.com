<div class="modal-body mx-[-12px] max-[767px]:mx-[0]">
    <div class="flex flex-wrap mx-[-12px] mb-[-24px]">
        <div class="min-[768px]:w-[41.66%] min-[576px]:w-full px-[12px] mb-[24px]">
            <div class="single-pro-img single-pro-img-no-sidebar h-full border-[1px] border-solid border-[#eee] overflow-hidden rounded-[20px]">
                <div class="single-product-scroll h-full">
                    <div class="single-slide zoom-image-hover h-full bg-[#fff] flex items-center  aspect-square ">
                        <img class="img-responsive max-w-full block object-cover" src="{{ asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="min-[768px]:w-[58.33%] min-[576px]:w-full px-[12px] mb-[24px] single-product-info">
            <div class="quickview-pro-content">
                <h5 class="bb-quick-title">
                    <a href="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}" class="font-Poppins tracking-[0.03rem] mb-[10px] block text-[#3d4750] text-[20px] leading-[30px] font-medium">{{ $product->name }}</a>
                </h5>
                <div class="bb-pro-rating flex mb-[10px]">
                    <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                    <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                    <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                    <i class="ri-star-fill float-left text-[15px] mr-[3px] leading-[18px] text-[#fea99a]"></i>
                    <i class="ri-star-line float-left text-[15px] mr-[3px] leading-[18px] text-[#777]"></i>
                </div>
                <div class="bb-quickview-desc mb-[10px] text-[15px] leading-[24px] text-[#777] font-light line-clamp-5">
                    {{ Str::limit(html_entity_decode(strip_tags($product->full_description)), 240) }}
                </div>
                <div class="bb-quickview-price pt-[5px] pb-[10px] flex items-center justify-left">
                    <span class="new-price px-[3px] text-[16px] text-[#686e7d] font-bold">${{$product->discount_price ?? $product->price }}</span>
                    @if($product->discount_price)
                        <span class="old-price px-[3px] text-[14px] text-[#686e7d] line-through">${{ $product->price }}</span>
                    @endif
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
                        <div class="size-variant">
                            <div class="pro-title mb-[12px]">
                                <h4
                                    class="font-quicksand leading-[1.2] tracking-[0.03rem] text-[14px] font-bold uppercase text-[#3d4750]">
                                    Size</h4>
                            </div>
                            <div class="bb-pro-variation mt-[15px] mb-[25px]">
                                <ul class="flex flex-wrap m-[-2px]">
                                    @foreach($sizeVariants as $key => $variant)
                                        @php
                                            $activeClass = $key == 0 ? ' active final-variant-selection ' : '';
                                        @endphp
                                        <li class="h-[22px] m-[2px] py-[2px] px-[8px] cursor-pointer border-[1px] border-solid border-[#eee] text-[#777] flex items-center justify-center text-[12px] leading-[22px] rounded-[20px] font-normal {{ $activeClass }} "
                                            data-tooltip="{{ $variant->size }}"
                                            title="{{ $variant->size }}"
                                            data-size="{{$variant}}"
                                        >
                                            <a href="javascript:void(0)" class="bb-opt-sz font-Poppins text-[12px] leading-[22px] font-normal text-[#777] tracking-[0.03rem]" data-tooltip="{{ $variant->size }}">{{ $variant->size }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    @if (count($colorVariants)> 0)
                        <div class="color-variant">
                            <div class="pro-title mb-[12px]">
                                <h4
                                    class="font-quicksand leading-[1.2] tracking-[0.03rem] text-[14px] font-bold uppercase text-[#3d4750]">
                                    Color</h4>
                            </div>
                            <div class="bb-pro-variation mt-[15px] mb-[25px]">
                                <ul class="flex flex-wrap m-[-2px]">
                                    @foreach($colorVariants as $key => $variant)
                                        @php
                                            $activeClass = $key == 0 ? ' active final-variant-selection ' : '';
                                        @endphp
                                        <li class="h-[22px] m-[2px] py-[2px] px-[8px] cursor-pointer border-[1px] border-solid border-[#eee] text-[#777] flex items-center justify-center text-[12px] leading-[22px] rounded-[20px] font-normal {{ $activeClass }} "
                                        data-tooltip="{{ $variant->color }}"
                                        title="{{ $variant->color }}"
                                        data-color="{{$variant}}"
                                        >
                                            <a href="javascript:void(0)" class="bb-opt-sz font-Poppins text-[12px] leading-[22px] font-normal text-[#777] tracking-[0.03rem]" data-tooltip="{{ $variant->color }}">{{ $variant->color }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="bb-quickview-qty flex max-[360px]:justify-center">
                    <div class="qty-plus-minus w-[85px] h-[40px] py-[7px] border-[1px] border-solid border-[#eee] overflow-hidden relative flex items-center justify-between bg-[#fff] rounded-[10px] max-[360px]:m-[auto]">
                        <input class="qty-input text-[#777 float-left text-[14px] h-auto m-[0] p-[0] text-center w-full outline-[0] font-normal leading-[35px] rounded-[10px]" type="number" name="bb-qtybtn" value="1">
                    </div>
                    <div class="bb-quickview-cart ml-[4px] max-[360px]:mt-[15px] max-[360px]:ml-[0] max-[360px]:flex max-[360px]:justify-center">
                        <button type="button" class="bb-btn-1 add-to-cart-modal transition-all duration-[0.3s] ease-in-out font-Poppins h-[40px] leading-[28px] tracking-[0.03rem] py-[3px] px-[20px] text-[14px] font-normal text-[#3d4750] bg-transparent rounded-[10px] border-[1px] border-solid border-[#3d4750] hover:bg-[#6c7fd8] hover:border-[#6c7fd8] hover:text-[#fff]"
                        data-product="{{ $product }}"
                        data-url="{{ route('product.detail', [$product->categories->first()->slug, $product->slug]) }}"
                        >
                            <i class="ri-shopping-bag-line pr-[8px]"></i>Add To Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("body .zoom-image-hover").zoom();
    $(".qty-input").on("change", function() {
        var qty = $(this).val();
        if (isNaN(qty) || qty <= 0) {
            $(this).val(1);
        }
    });
</script>