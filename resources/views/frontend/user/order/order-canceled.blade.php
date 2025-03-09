@extends('frontend.layouts.default')
@section('title', 'Order Canceled')

@section('content')
 <!-- Breadcrumb -->
 <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
    <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
        <div class="flex flex-wrap w-full">
            <div class="w-full px-[12px]">
                <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Order Failed</h2>
                    </div>
                    <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                        <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                            <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                            <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                            <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Order Failed</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="bg-gradient-to-r py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 rounded-lg shadow-lg">
    <div class="flex flex-col justify-center items-center">
        <h3 class="text-5xl font-extrabold mb-4 text-center text-[#6c7fd8]">🚫 Your Order Has Been Canceled</h3>
        <p class="mb-6 text-lg font-medium leading-7 text-center text-[#6c7fd8]">
            We’re sorry to inform you that your order has been canceled.
        </p>

        <div class="bg-white rounded-lg p-8 shadow-md w-full max-w-md mx-auto text-center">
            <h4 class="text-2xl font-semibold text-gray-800 mb-4">What to Do Next</h4>
            <p class="text-gray-600 mb-6">
                If you have any questions or need assistance, please reach out to our support team.
            </p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-red-600 text-white font-semibold rounded-md hover:bg-red-500 transition duration-200">
                Return to Home
            </a>
        </div>

        <p class="text-lg text-[#6c7fd8] font-light text-center mt-6">
            We appreciate your understanding! 😊
        </p>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Optional: clear cart from local storage
    // window.addEventListener('load', function() {
    //     localStorage.removeItem('cart');
    //     localStorage.removeItem('orderNote');
    // });
</script>
@endpush
