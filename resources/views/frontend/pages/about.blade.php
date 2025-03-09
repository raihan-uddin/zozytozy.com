@extends('frontend.layouts.default')
@section('title', 'About Us')

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">About Us</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('dashboard') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">About Us</li>
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
                        <div class="section-title pb-[12px] px-[12px] flex justify-start max-[991px]:flex-col max-[991px]:justify-center max-[991px]:text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                            <div class="section-detail max-[991px]:mb-[12px]">
                                <h2 class="bb-title font-quicksand tracking-[0.03rem] mb-[0] p-[0] text-[25px] font-bold text-[#3d4750] inline capitalize leading-[1] max-[767px]:text-[23px]">About  <span class="text-[#6c7fd8]">{{ config('app.name') ?? 'Raihan Uddin' }}</span></h2>
                            </div>
                        </div>
                        <div class="about-inner-contact px-[12px] mb-[14px]" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                            <h4 class="font-quicksand tracking-[0.03rem] leading-[1.2] mb-[20px] text-[18px] text-[#3d4750] font-bold italic">Natural Beauty Skin Care, just a click Away.</h4>
                            <p class="font-Poppins mb-[16px] text-[14px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]"></p>
                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Welcome to {{ config('app.name') ?? 'Raihan Uddin' }}, where the beauty of nature harmonizes with the art of self-care. We believe that everyone deserves to feel radiant and confident in their own skin. Our mission is to help you embrace that beauty by harnessing the power of nature. At {{ config('app.name') ?? 'Raihan Uddin' }}, we promote a holistic approach to beauty—encouraging you to pause, indulge in self-care, and rediscover the joy of nurturing yourself.
                            </p>

                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Our journey began with a heartfelt desire: to craft products that are both gentle on the skin and remarkably effective. More than mere products, we offer transformative experiences. Each {{ config('app.name') ?? 'Raihan Uddin' }} creation invites you to reconnect with yourself, inhale deeply, and let the stresses of the day fade away. From deeply nourishing shea butter to revitalizing tea tree oil, every ingredient is thoughtfully selected for its unique benefits. We prioritize your safety by avoiding harsh chemicals and synthetic additives, ensuring you receive products that are both safe and effective.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Our Mission</h2>
                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Our mission is to deliver the finest nature-extracted products while positively impacting the planet. We believe that through natural ingredients and sustainable practices, we can foster a healthier world and a more beautiful future for all.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Our Values</h2>
                            <ul class="list-disc list-inside mb-4 space-y-4">
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Quality:</strong> We are dedicated to using only the highest quality ingredients in our formulations.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Sustainability:</strong> Our commitment to eco-friendly practices and fair trade is at the core of what we do.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Community:</strong> We value giving back and supporting the communities we serve.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Innovation:</strong> We continually seek new ways to enhance our products and services.</li>
                            </ul>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Our Products</h2>
                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Explore our diverse range of botanical offerings, including:
                            </p>
                            <ul class="list-disc list-inside mb-4 space-y-2">
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide">Skincare products</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide">Haircare products</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide">Body care products</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide">Home fragrance products</li>
                            </ul>
                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We also curate a variety of gift sets and bundles, perfect for finding thoughtful gifts for your loved ones.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">What Sets Us Apart</h2>
                            <ul class="list-disc list-inside mb-4 space-y-4">
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Premium Ingredients:</strong> We utilize only the finest natural ingredients in all our products.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Sustainable Practices:</strong> Our commitment to sustainability drives our eco-friendly solutions across all operations.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Blending Tradition and Science:</strong> We merge ancient wisdom with modern science to create gentle, effective formulations.</li>
                                <li class="text-lg text-gray-600 font-light leading-7 tracking-wide"><strong>Exceptional Customer Care:</strong> We prioritize outstanding customer service for all our clients.</li>
                            </ul>

                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We invite you to join us on our mission to cultivate a healthier planet and a more beautiful future for everyone. Stay connected with us on social media for the latest updates and exclusive offers.
                            </p>

                            <p class="mb-6 text-lg text-gray-600 font-light leading-7 tracking-wide font-bold">
                                Thank you for choosing {{ config('app.name') ?? 'Raihan Uddin' }}!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
