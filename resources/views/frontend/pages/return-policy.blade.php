@php use App\Helpers\SettingsHelper; @endphp
@extends('frontend.layouts.default')
@section('title', 'Return Policy')

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Delivery</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Returns, Exchanges & Refunds</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section-about py-[50px] max-[1199px]:py-[35px]">
        <div class="flex flex-wrap justify-between items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full mb-[-24px]">
                <div class="w-full mb-[24px]">
                    <div class="bb-about-contact h-full flex flex-col justify-center">
                        <div class="about-inner-contact px-[12px] mb-[14px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                        <h1 class="text-3xl font-semibold mb-6 text-center">Returns, Exchanges & Refunds</h1>

                        <p class="text-gray-600 text-lg mb-4 font-light leading-7 tracking-wide">Effective Date: 10/10/2024</p>
                            <h2 class="text-2xl font-semibold mb-4">Thank you for shopping at {{ parse_url(config('app.url'), PHP_URL_HOST) }}.</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Once an order has shipped, we do not accept returns or exchanges.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Purchases Made Through Retailers</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Please contact the store you purchased from for a return or exchange. We are unable to provide a return or exchange for a purchase made through a retailer.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Canceling An Order</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Although we do not accept any returns or exchanges, you may cancel an order before it ships from our facility if it has not been packed or staged for shipping.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Damaged or Defective Products</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Damaged or defective products may be returned to {{ parse_url(config('app.url'), PHP_URL_HOST) }} after contacting us at <a href="mailto:{{ SettingsHelper::get('site_email') }}" class="text-blue-500 hover:underline">{{ SettingsHelper::get('site_email') }}</a>. Please submit photo images of the damaged or defective product.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Lost or Stolen Packages</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                If the tracking shows the package was delivered but you did not receive it, we recommend contacting the carrier directly. {{ config('app.name') }} is not responsible for lost or stolen packages once confirmed delivered to the address provided during checkout. Please have your tracking number ready for the carrier.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Shipping Lead Time</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                All orders have a lead time of 1-2 business days before shipping. Orders placed during a holiday or promotion will have an approximate lead time of 3-4 business days. Shipping method applies once the order has shipped.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">Contact Us</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                If you have any questions about our return policy or your order, please contact us at <a href="mailto:{{ SettingsHelper::get('site_email') }} class="text-blue-500 hover:underline">{{ SettingsHelper::get('site_email') }}</a> or via the information below:
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                {{ config('app.name') }} <br>
                                {{ SettingsHelper::get('site_address') }} <br>
                                Tel: <a href="tel:215-238-1112" class="text-blue-500 hover:underline">{{ SettingsHelper::get('site_phone') }}</a> <br>
                                E-mail: <a href="mailto:{{ SettingsHelper::get('site_email') }}" class="text-blue-500 hover:underline">{{ SettingsHelper::get('site_email') }}</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('frontend.partials.services')
@endsection