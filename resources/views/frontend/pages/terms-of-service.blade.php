@php use App\Helpers\SettingsHelper; @endphp
@extends('frontend.layouts.default')
@section('title', 'Terms of Service')

@section('content')

    <!-- Breadcrumb -->
    <section class="section-breadcrumb mb-[50px] max-[1199px]:mb-[35px] border-b-[1px] border-solid border-[#eee] bg-[#f8f8fb]">
        <div class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="flex flex-wrap w-full bb-breadcrumb-inner m-[0] py-[20px] items-center">
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">Terms of Service</h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a href="{{ route('home') }}" class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a></li>
                                <li class="text-[14px] font-normal px-[5px]"><i class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i></li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">Terms of Service</li>
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
                        <h1 class="text-4xl font-bold text-center mb-6 text-[#4A5568]">Terms of Service</h1>
                            
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                This website is operated by {{ config('app.name') ?? 'Raihan Uddin' }}. Throughout the site, the terms “we”, “us” and “our” refer to {{ config('app.name') ?? 'Raihan Uddin' }}. {{ config('app.name') ?? 'Raihan Uddin' }} offers this website, including all information, tools and services available from this site to you, the user, conditioned upon your acceptance of all terms, conditions, policies and notices stated here.
                            </p>
                            
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                By visiting our site and/or purchasing something from us, you engage in our “Service” and agree to be bound by the following terms and conditions (“Terms of Service”, “Terms”), including those additional terms and conditions and policies referenced herein and/or available by hyperlink. These Terms of Service apply to all users of the site, including without limitation users who are browsers, vendors, customers, merchants, and/or contributors of content.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Please read these Terms of Service carefully before accessing or using our website. By accessing or using any part of the site, you agree to be bound by these Terms of Service. If you do not agree to all the terms and conditions of this agreement, then you may not access the website or use any services. If these Terms of Service are considered an offer, acceptance is expressly limited to these Terms of Service.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">ONLINE STORE TERMS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                By agreeing to these Terms of Service, you represent that you are at least the age of majority in your state or province of residence, or that you are the age of majority in your state or province of residence and you have given us your consent to allow any of your minor dependents to use this site.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You may not use our products for any illegal or unauthorized purpose nor may you, in the use of the Service, violate any laws in your jurisdiction (including but not limited to copyright laws).
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You must not transmit any worms or viruses or any code of a destructive nature.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                A breach or violation of any of the Terms will result in an immediate termination of your Services.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">GENERAL CONDITIONS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We reserve the right to refuse service to anyone for any reason at any time.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You understand that your content (not including credit card information), may be transferred encrypted and involve (a) transmissions over various networks; and (b) changes to conform and adapt to technical requirements of connecting networks or devices. Credit card information is always encrypted during transfer over networks.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You agree not to reproduce, duplicate, copy, sell, resell or exploit any portion of the Service, use of the Service, or access to the Service or any contact on the website through which the service is provided, without express written permission by us.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                The headings used in this agreement are included for convenience only and will not limit or otherwise affect these Terms.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">ACCURACY, COMPLETENESS AND TIMELINESS OF INFORMATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We are not responsible if information made available on this site is not accurate, complete or current. The material on this site is provided for general information only and should not be relied upon or used as the sole basis for making decisions without consulting primary, more accurate, more complete or more timely sources of information. Any reliance on the material on this site is at your own risk.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                This site may contain certain historical information. Historical information, necessarily, is not current and is provided for your reference only. We reserve the right to modify the contents of this site at any time, but we have no obligation to update any information on our site. You agree that it is your responsibility to monitor changes to our site.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">MODIFICATIONS TO THE SERVICE AND PRICES</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Prices for our products are subject to change without notice.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We reserve the right at any time to modify or discontinue the Service (or any part or content thereof) without notice at any time.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We shall not be liable to you or to any third-party for any modification, price change, suspension or discontinuance of the Service.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">PRODUCTS OR SERVICES</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Certain products or services may be available exclusively online through the website. These products or services may have limited quantities and are subject to return or exchange only according to our Return Policy.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We have made every effort to display as accurately as possible the colors and images of our products that appear at the store. We cannot guarantee that your computer monitor’s display of any color will be accurate.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We reserve the right, but are not obligated, to limit the sales of our products or Services to any person, geographic region or jurisdiction. We may exercise this right on a case-by-case basis. We reserve the right to limit the quantities of any products or services that we offer. All descriptions of products or product pricing are subject to change at any time without notice, at the sole discretion of us. We reserve the right to discontinue any product at any time. Any offer for any product or service made on this site is void where prohibited.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We do not warrant that the quality of any products, services, information, or other material purchased or obtained by you will meet your expectations, or that any errors in the Service will be corrected.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Our Fragrance oil/Perfumed body oils listed in this website are inspired by the designer perfumes, which are the trademarks of their respective owners. We do not have any associations with them nor are we claiming that the perfumes oils are designed by them.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">ACCURACY OF BILLING AND ACCOUNT INFORMATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We reserve the right to refuse any order you place with us. We may, in our sole discretion, limit or cancel quantities purchased per person, per household or per order. These restrictions may include orders placed by or under the same customer account, the same credit card, and/or orders that use the same billing and/or shipping address. In the event that we make a change to or cancel an order, we may attempt to notify you by contacting the e-mail and/or billing address/phone number provided at the time the order was made. We reserve the right to limit or prohibit orders that, in our sole judgment, appear to be placed by dealers, resellers or distributors.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You agree to provide current, complete and accurate purchase and account information for all purchases made at our store. You agree to promptly update your account and other information, including your email address and credit card numbers and expiration dates, so that we can complete your transactions and contact you as needed.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                For more detail, please review our Returns Policy.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">OPTIONAL TOOLS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We may provide you with access to third-party tools over which we neither monitor nor have any control nor input.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You acknowledge and agree that we provide access to such tools "as is" and "as available" without any warranties, representations or conditions of any kind and without any endorsement. We shall have no liability whatsoever arising from or relating to your use of optional third-party tools.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Any use by you of optional tools offered through the site is entirely at your own risk and discretion, and you should ensure that you are familiar with and approve of the terms on which tools are provided by the relevant third-party provider(s).
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">THIRD-PARTY LINKS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Certain content, products and services available via our Service may include materials from third-parties.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Third-party links on this site may direct you to third-party websites that are not affiliated with us. We are not responsible for examining or evaluating the content or accuracy and we do not warrant and will not have any liability or responsibility for any third-party materials or websites, or for any other materials, products, or services of third-parties.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We are not liable for any harm or damages related to the purchase or use of goods, services, resources, content, or any other transactions made in connection with any third-party websites. Please review carefully the third-party's policies and practices and make sure you understand them before you engage in any transaction. Complaints, claims, concerns, or questions regarding third-party products should be directed to the third-party.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">USER COMMENTS, FEEDBACK AND OTHER SUBMISSIONS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                If, at our request, you send certain specific submissions (for example contest entries) or without a request from us you send creative ideas, suggestions, proposals, plans, or other materials, whether online, by email, by postal mail, or otherwise (collectively, 'comments'), you agree that we may, at any time, without restriction, edit, copy, publish, distribute, translate and otherwise use in any medium any comments that you forward to us. We are and shall be under no obligation (1) to maintain any comments in confidence; (2) to pay compensation for any comments; or (3) to respond to any comments.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We may, but have no obligation to, monitor, edit or remove content that we determine in our sole discretion are unlawful, offensive, threatening, defamatory, pornographic, obscene or otherwise objectionable or violates any party’s intellectual property or these Terms of Service.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">PERSONAL INFORMATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Your submission of personal information through the store is governed by our Privacy Policy. To view our Privacy Policy.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">ERRORS, INACCURACIES AND OMISSIONS</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Occasionally there may be information on our site or in the Service that contains typographical errors, inaccuracies or omissions that may relate to product descriptions, pricing, promotions, offers, product shipping charges, transit times and availability. We reserve the right to correct any errors, inaccuracies or omissions, and to change or update information or cancel orders if any information in the Service or on any related website is inaccurate at any time without prior notice (including after you have submitted your order).
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We undertake no obligation to update, amend or clarify information in the Service or on any related website, including without limitation, pricing information, except as required by law. No specified update or refresh date applied in the Service should be taken to indicate that all information in the Service or on any related website has been modified or updated.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">PROHIBITED USES</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                In addition to other prohibitions as set forth in the Terms of Service, you are prohibited from using the site or its content: (a) for any unlawful purpose; (b) to solicit others to perform or participate in any unlawful acts; (c) to violate any international, federal, provincial or state regulations, rules, laws, or local ordinances; (d) to infringe upon or violate our intellectual property rights or the intellectual property rights of others; (e) to harass, abuse, insult, harm, defame, slander, disparage, intimidate, or discriminate based on gender, sexual orientation, religion, ethnicity, race, age, national origin, or disability; (f) to submit false or misleading information; (g) to upload or transmit viruses or any other type of malicious code that will or may be used in any way that will affect the functionality or operation of the Service or of any related website, other websites, or the Internet; (h) to collect or track the personal information of others; (i) to spam, phish, pharm, pretext, spider, crawl, or scrape; (j) for any obscene or immoral purpose; or (k) to interfere with or circumvent the security features of the Service or any related website, other websites, or the Internet. We reserve the right to terminate your use of the Service or any related website for violating any of the prohibited uses.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">DISCLAIMER OF WARRANTIES; LIMITATION OF LIABILITY</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We do not guarantee, represent or warrant that your use of our service will be uninterrupted, timely, secure or error-free.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                We do not warrant that the results that may be obtained from the use of the service will be accurate or reliable.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You agree that from time to time we may remove the service for indefinite periods of time or cancel the service at any time, without notice to you.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You expressly agree that your use of, or inability to use, the service is at your sole risk. The service and all products and services delivered to you through the service are (except as expressly stated by us) provided 'as is' and 'as available' for your use, without any representation, warranties or conditions of any kind, either express or implied, including all implied warranties or conditions of merchantability, quality, fitness for a particular purpose, durability, title, and non-infringement.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                In no case shall {{ config('app.name') ?? 'Raihan Uddin' }}, our directors, officers, employees, affiliates, agents, contractors, interns, suppliers, service providers or licensors be liable for any injury, loss, claim, or any direct, indirect, incidental, punitive, special, or consequential damages of any kind, including, without limitation lost profits, lost revenue, loss of savings, loss of data, replacement costs, or any similar damages, whether based in contract, tort (including negligence), strict liability or otherwise, arising from your use of any of the service or any products procured using the service, or for any other claim related in any way to your use of the service or any product, including, but not limited to, any errors or omissions in any content, or any loss or damage of any kind incurred as a result of your use of the service or any content (or product) posted, transmitted, or otherwise made available via the service, even if advised of their possibility. Because some states or jurisdictions do not allow the exclusion or the limitation of liability for consequential or incidental damages, in such states or jurisdictions, our liability shall be limited to the maximum extent permitted by law.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">INDEMNIFICATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You agree to indemnify, defend and hold harmless {{ config('app.name') ?? 'Raihan Uddin' }} and our parent, subsidiaries, affiliates, partners, officers, directors, agents, contractors, licensors, service providers, sub-contractors, suppliers, interns and employees, harmless from any claim or demand, including reasonable attorneys’ fees, made by any third-party due to or arising out of your breach of these Terms of Service or the documents they incorporate by reference, or your violation of any law or the rights of a third-party.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">SEVERABILITY</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                In the event that any provision of these Terms of Service is determined to be unlawful, void or unenforceable, such provision shall nonetheless be enforceable to the fullest extent permitted by applicable law, and the unenforceable portion shall be deemed to be severed from these Terms of Service, such determination shall not affect the validity and enforceability of any other remaining provisions.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">TERMINATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                The obligations and liabilities of the parties incurred prior to the termination date shall survive the termination of this agreement for all purposes.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                These Terms of Service are effective unless and until terminated by either you or us. You may terminate these Terms of Service at any time by notifying us that you no longer wish to use our Services, or when you cease using our site.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                If in our sole judgment you fail, or we suspect that you have failed, to comply with any term or provision of these Terms of Service, we also may terminate this agreement at any time without notice and you will remain liable for all amounts due up to and including the date of termination; and/or accordingly may deny you access to our Services (or any part thereof).
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">ENTIRE AGREEMENT</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                The failure of us to exercise or enforce any right or provision of these Terms of Service shall not constitute a waiver of such right or provision.
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                These Terms of Service and any policies or operating rules posted by us on this site or in respect to the Service constitutes the entire agreement and understanding between you and us and govern your use of the Service, superseding any prior or contemporaneous agreements, communications and proposals, whether oral or written, between you and us (including, but not limited to, any prior versions of the Terms of Service).
                            </p>

                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Any ambiguities in the interpretation of these Terms of Service shall not be construed against the drafting party.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">GOVERNING LAW</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                These Terms of Service and any separate agreements whereby we provide you Services shall be governed by and construed in accordance with the laws of the State of [Your State].
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">CHANGES TO TERMS OF SERVICE</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                You can review the most current version of the Terms of Service at any time on this page. We reserve the right, at our sole discretion, to update, change or replace any part of these Terms of Service by posting updates and changes to our website. It is your responsibility to check our website periodically for changes. Your continued use of or access to our website or the Service following the posting of any changes to these Terms of Service constitutes acceptance of those changes.
                            </p>

                            <h2 class="text-2xl font-semibold mb-4">CONTACT INFORMATION</h2>
                            <p class="mb-4 text-lg text-gray-600 font-light leading-7 tracking-wide">
                                Questions about the Terms of Service should be sent to us at {{ SettingsHelper::get('site_email', 'raihanuddin2@yahoo.com') }}.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('frontend.partials.services')
@endsection