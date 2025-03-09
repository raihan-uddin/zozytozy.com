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
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Collection</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <!-- get parent category -->
                                @if($category && $category->menus->isNotEmpty())
                                    <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('category.products',  $category->menus->first()->slug ) }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">{{ $category->menus->first()->name }}</a></li>
                                    <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                @endif
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">{{ $category->name }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Category section -->
    {{-- <section class="section-category pt-[50px] max-[1199px]:pt-[35px] mb-[24px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-category-6-colum owl-carousel">
                        @foreach ($allCategories as $singleCategory )
                        <div class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1]"  title="{{ $singleCategory->name }}" data-aos="flip-left" data-aos-duration="1000" data-aos-delay="200">
                            <div class="category-image mb-[12px]">
                                <img src="{{ $singleCategory->image ? asset('storage/'.$singleCategory->image) : asset('images/icons/natural-product.png') }}" alt="{{$singleCategory->name}}" class="w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px]">
                            </div>
                            <div class="category-sub-contact">
                                <h5 class="mb-[2px] text-[16px] font-quicksand text-[#3d4750] font-semibold tracking-[0.03rem] leading-[1.2] line-clamp-1"><a href="{{ route('category.products', $singleCategory->slug) }}" class="font-Poppins text-[16px] font-medium leading-[1.2] tracking-[0.03rem] text-[#3d4750] capitalize">{{ $singleCategory->name }}</a></h5>
                                <p class="font-Poppins text-[13px] text-[#686e7d] leading-[25px] font-light tracking-[0.03rem]">{{ $singleCategory->products_count }} items</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Shop section -->
    <section class="section-shop pb-[50px] max-[1199px]:pb-[35px]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full px-[12px]">
                <div class="bb-shop-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#000000cc] z-[17]"></div>
                <div class="bb-shop-sidebar transition-all duration-[0.3s] ease-in-out w-[300px] h-screen p-[0] fixed top-[0] left-[0] z-[17] translate-x-[-100%] bg-[#fff] overflow-auto">
                    <div class="sidebar-filter-title p-[15px] flex justify-between items-center">
                        <h5 class="font-quicksand text-[18px] font-bold tracking-[0.03rem] leading-[1.2] text-[#3d4750]">Filters</h5>
                        <a class="filter-close transition-all duration-[0.3s] ease-in-out font-Poppins leading-[28px] tracking-[0.03rem] text-[22px] font-medium text-[#ff0000]" href="javascript:void(0)">×</a>
                    </div>
                    <div class="bb-shop-wrap bg-[#f8f8fb] border-[1px] border-solid border-[#eee]">
                        <div class="bb-sidebar-block p-[20px] border-b-[1px] border-solid border-[#eee]">
                            <div class="bb-sidebar-title mb-[20px]">
                                <h3 class="font-quicksand text-[18px] tracking-[0.03rem] leading-[1.2] font-bold text-[#3d4750]">Category</h3>
                            </div>
                            <div class="bb-sidebar-contact">
                                <ul>
                                    @foreach ($allCategories as $singleCategory )
                                        <li class="relative block mb-[14px]">
                                            <div class="bb-sidebar-block-item relative">
                                                <input type="checkbox" class="w-full h-[calc(100%-5px)] absolute opacity-[0] cursor-pointer z-[999] top-[50%] left-[0] translate-y-[-50%]">
                                                <a href="javascript:void(0)" class="ml-[30px] block text-[#777] text-[14px] leading-[20px] font-normal capitalize cursor-pointer">{{ $singleCategory->name }}</a>
                                                <span class="checked absolute top-[0] left-[0] h-[18px] w-[18px] bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[5px] overflow-hidden"></span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full">
                    <div class="bb-shop-pro-inner">
                        <div class="flex flex-wrap mx-[-12px] mb-[-24px]">
                            <div class="w-full px-[12px]">
                                <div class="bb-pro-list-top mb-[24px] rounded-[20px] flex bg-[#f8f8fb] border-[1px] border-solid border-[#eee] justify-between">
                                    <div class="flex flex-wrap w-full">
                                        <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                            <div class="bb-bl-btn py-[10px] flex max-[420px]:justify-center">
                                                <button type="button" class="grid-btn btn-filter h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent mr-[5px]" title="filter">
                                                    <i class="ri-equalizer-2-line text-[20px]"></i>
                                                </button>
                                                <button type="button" class="grid-btn btn-grid-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent mr-[5px] active" title="grid">
                                                    <i class="ri-apps-line text-[20px]"></i>
                                                </button>
                                                <button type="button" class="grid-btn btn-list-100 h-[38px] w-[38px] flex justify-center items-center border-[0] p-[5px] bg-transparent" title="grid">
                                                    <i class="ri-list-unordered text-[20px]"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-[50%] px-[12px] max-[420px]:w-full">
                                            <div class="bb-select-inner h-full py-[10px] flex items-center justify-end max-[420px]:justify-center">
                                                <form method="GET" action="{{ route('category.products', $category->slug) }}" id="sortForm" class="flex">
                                                    <div class="custom-select w-[130px] mr-[30px] flex justify-end text-[#777]  items-center text-[14px] relative max-[420px]:w-[100px] max-[420px]:justify-left">
                                                        <x-select  name="sort_by">
                                                            <option disabled {{ request('sort_by') ? '' : 'selected' }}>Sort by</option>
                                                            <option value="position" {{ request('sort_by') == 'position' ? 'selected' : '' }}>Position</option>
                                                            <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>Name, A to Z</option>
                                                            <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>Name, Z to A</option>
                                                            <option value="price_asc" {{ request('sort_by') == 'price_asc' ? 'selected' : '' }}>Price, low to high</option>
                                                            <option value="price_desc" {{ request('sort_by') == 'price_desc' ? 'selected' : '' }}>Price, high to low</option>
                                                            <option value="newest" {{ request('sort_by') == 'newest' ? 'selected' : '' }}>Newest</option>
                                                            <option value="oldest" {{ request('sort_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                                        </x-select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($products->isEmpty())
                                <div class="w-full text-center py-4 text-lg text-gray-600">
                                    <p>No products found.</p>
                                </div>
                            @else
                                @foreach ($products as $product)
                                    <div class="min-[992px]:w-[25%] min-[768px]:w-[33.33%] w-[50%] max-[480px]:w-full px-[12px] mb-[24px] pro-bb-content" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                                        <x-product-thumb :product="$product" />
                                    </div>
                                @endforeach
                            
                                <div class="w-full px-[12px]">
                                    <div class="bb-pro-pagination mb-[24px] flex justify-between max-[575px]:flex-col max-[575px]:items-center">
                                        <p class="font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem] max-[575px]:mb-[10px]">
                                            Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} of {{ $products->total() }} item(s)
                                        </p>
                                        <ul class="flex">
                                            {{-- Previous Page Link --}}
                                            @if (!$products->onFirstPage())
                                                <li class="leading-[28px] mr-[6px]">
                                                    <a href="{{ $products->previousPageUrl() }}" class="transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#fff] leading-[30px] bg-[#3d4750] font-Poppins tracking-[0.03rem] text-[15px] flex text-center align-top justify-center items-center rounded-[10px] border-[1px] border-solid border-[#eee]">
                                                        <i class="ri-arrow-left-s-line transition-all duration-[0.3s] ease-in-out mr-[10px] text-[16px] w-[8px] text-[#fff]"></i> Prev
                                                    </a>
                                                </li>
                                            @endif

                                            {{-- Pagination Links --}}
                                            @foreach ($products->links()->elements[0] as $page => $url)
                                                @if ($page == $products->currentPage())
                                                    <li class="leading-[28px] mr-[6px] active">
                                                        <span class="transition-all duration-[0.3s] ease-in-out w-[32px] h-[32px] font-light text-[#fff] leading-[32px] bg-[#3d4750] font-Poppins tracking-[0.03rem] text-[15px] flex text-center align-top justify-center items-center rounded-[10px] border-[1px] border-solid border-[#3d4750]">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="leading-[28px] mr-[6px]">
                                                        <a href="{{ $url }}" class="transition-all duration-[0.3s] ease-in-out w-[32px] h-[32px] font-light text-[#777] leading-[32px] bg-[#f8f8fb] font-Poppins tracking-[0.03rem] text-[15px] flex text-center align-top justify-center items-center rounded-[10px] border-[1px] border-solid border-[#eee] hover:bg-[#3d4750] hover:text-[#fff]">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            {{-- Next Page Link --}}
                                            @if ($products->hasMorePages())
                                                <li class="leading-[28px]">
                                                    <a href="{{ $products->nextPageUrl() }}" class="next transition-all duration-[0.3s] ease-in-out w-[auto] h-[32px] px-[13px] font-light text-[#fff] leading-[30px] bg-[#3d4750] font-Poppins tracking-[0.03rem] text-[15px] flex text-center align-top justify-center items-center rounded-[10px] border-[1px] border-solid border-[#eee]">
                                                        Next <i class="ri-arrow-right-s-line transition-all duration-[0.3s] ease-in-out ml-[10px] text-[16px] w-[8px] text-[#fff]"></i>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    @include('frontend.partials.services')
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
       // on chege sort by form submit
         $('#sortForm select').on('change', function () {
                console.log('change');
              $('#sortForm').submit();
         });
    });
</script>



</script>
@endpush