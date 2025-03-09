{{-- 
@extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('frontend.layouts.default')
@section('title', 'Not Found')

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
                                <a href="{{ route('home') }}"
                                    class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Not Found</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

{{-- show not found with imogi --}}
<section class="py-[50px] max-[1199px]:py-[35px]">
    <div
        class="flex flex-wrap justify-between items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full mb-[-24px]">
            <div class="w-full mb-[24px]">
                <div class="bb-about-contact h-full flex flex-col justify-center">
                    <div class="section-title pb-[12px] px-[12px] flex justify-start max-[991px]:flex-col max-[991px]:justify-center max-[991px]:text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                        <div class="section-detail max-[991px]:mb-[12px]">
                            <h2 class="bb-title font-quicksand tracking-[0.03rem] mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] inline capitalize leading-[1] max-[767px]:text-[23px]">Not Found <span class="text-[#6c7fd8]">😢</span></h2>
                        </div>
                    </div>
                    <div class="about-inner-contact px-[12px] mb-[14px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <h4 class="font-quicksand tracking-[0.03rem] leading-[1.2] mb-[20px] text-[18px] text-[#3d4750] font-bold italic">Sorry, the page you are looking for could not be found.</h4>
                        <p class="font-Poppins mb-[16px] text-[14px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">Please check the URL in the address bar and try again. If you believe this is an error, please contact us.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')

@endsection

