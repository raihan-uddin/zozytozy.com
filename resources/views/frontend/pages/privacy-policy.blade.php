@php use App\Helpers\SettingsHelper; @endphp
@extends('frontend.layouts.default')
@section('title', 'Privacy Policy')

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Privacy Policy</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Privacy Policy</li>
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
                        <h1 class="text-4xl font-bold text-center mb-6 text-[#4A5568]">Privacy Policy</h1>
        
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                This privacy policy has been compiled to better serve those who are concerned with how their ‘Personally identifiable information’ (PII) is being used online. PII, as used in US privacy law and information security, is information that can be used on its own or with other information to identify, contact, or locate a single person, or to identify an individual in context. Please read our privacy policy carefully to get a clear understanding of how we collect, use, protect or otherwise handle your Personally Identifiable Information in accordance with our website.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">What Personal Information Do We Collect?</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                When ordering or registering on our site, you may be asked to enter your name, email address, mailing address, phone number, or other details to help you with your experience.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">When Do We Collect Information?</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We collect information from you when you register on our site, place an order, subscribe to a newsletter, fill out a form, or enter information on our site.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">How Do We Use Your Information?</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We may use the information we collect from you when you register, make a purchase, sign up for our newsletter, respond to a survey or marketing communication, surf the website, or use certain other site features in the following ways:
                            </p>
                            <ul class="list-disc list-inside mb-4 space-y-2 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                <li>To personalize user’s experience and deliver content and product offerings in which you are most interested.</li>
                                <li>To improve our website in order to better serve you.</li>
                                <li>To respond to your customer service requests more efficiently.</li>
                                <li>To administer a contest, promotion, survey, or other site feature.</li>
                                <li>To quickly process your transactions.</li>
                                <li>To send periodic emails regarding your order or other products and services.</li>
                            </ul>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">How Do We Protect Visitor Information?</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems and are required to keep the information confidential. Additionally, all sensitive/credit information you supply is encrypted via Secure Socket Layer (SSL) technology.
                            </p>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We implement a variety of security measures when a user places an order to maintain the safety of your personal information. All transactions are processed through a gateway provider and are not stored or processed on our servers.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Do We Use Cookies?</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Yes. Cookies are small files that a site or its service provider transfers to your computer's hard drive through your web browser (if you allow) that enables the site's or service provider's systems to recognize your browser and capture and remember certain information. We use cookies to help us remember and process the items in your shopping cart, understand your preferences, and compile aggregate data about site traffic and interactions.
                            </p>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You can choose to have your computer warn you each time a cookie is being sent, or you can turn off all cookies through your browser settings. If you disable cookies, some features will be disabled, but you can still place orders.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Third Party Disclosure</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We do not sell, trade, or otherwise transfer your personally identifiable information to outside parties.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">California Online Privacy Protection Act</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                According to CalOPPA, we agree to the following: Users can visit our site anonymously. Once this privacy policy is created, we will add a link to it on our home page or the first significant page after entering our website. Users will be notified of any privacy policy changes on our Privacy Policy Page.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Children's Online Privacy Protection Act</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We do not specifically market to children under 13.
                            </p>

                            <h2 class="text-3xl font-semibold mt-8 mb-4 text-[#2D3748]">Contacting Us</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                If you have any questions regarding this privacy policy, please contact us using the information below.
                            </p>
                            <address class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                <strong>{{ config('app.name') ?? 'Raihan Uddin' }}</strong><br>
                                @if (SettingsHelper::get('site_address'))
                                    {{ SettingsHelper::get('site_address', 'Dhaka, Bangladesh') }} <br>
                                @endif
                                @if(SettingsHelper::get('site_phone'))
                                    Tel: <tel>{{ SettingsHelper::get('site_phone', '+8801680527922') }}</tel><br>
                                @endif
                                @if(SettingsHelper::get('site_email'))
                                    E-mail: <a href="mailto:{{ SettingsHelper::get('site_email', 'raihanuddin2@yahoo.com') }}" class="text-blue-500 underline">{{ SettingsHelper::get('site_email', 'raihanuddin2@yahoo.com') }}</a>
                                @endif
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('frontend.partials.services')
@endsection