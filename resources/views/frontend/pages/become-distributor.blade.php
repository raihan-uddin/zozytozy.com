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
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <h2 class="bb-breadcrumb-title font-quicksand tracking-[0.03rem] leading-[1.2] text-[16px] font-bold text-[#3d4750] max-[767px]:text-center max-[767px]:mb-[10px]">
                                Become a Wholesaler
                            </h2>
                        </div>
                        <div class="min-[768px]:w-[50%] min-[576px]:w-full w-full px-[12px]">
                            <ul class="bb-breadcrumb-list mx-[-5px] flex justify-end max-[767px]:justify-center">
                                <li class="bb-breadcrumb-item text-[14px] font-normal px-[5px]"><a
                                        href="{{ route('dashboard') }}"
                                        class="font-Poppins text-[14px] leading-[28px] tracking-[0.03rem] font-semibold text-[#686e7d]">Home</a>
                                </li>
                                <li class="text-[14px] font-normal px-[5px]"><i
                                        class="ri-arrow-right-double-fill text-[14px] font-semibold leading-[28px]"></i>
                                </li>
                                <li class="bb-breadcrumb-item font-Poppins text-[#686e7d] text-[14px] leading-[28px] font-normal tracking-[0.03rem] px-[5px] active">
                                    Become a Wholesaler
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Section -->
    <section class="w-full flex justify-center items-center py-8">
        <div class="bg-[#ffffff] p-6 rounded-lg shadow-lg w-[400px] border border-[#d4cdb8]">
            <h2 class="text-center text-2xl font-bold text-[#4a4a4a] mb-4">Go Ahead!</h2>
            <p class="text-center text-sm text-[#4a4a4a] mb-6">
                Complete the form to give us some information. Get in touch with us at this number between<br>
                9am to 7pm: 312-533-6604
            </p>
            <form action="{{ route('distributor.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <x-input type="text" name="first_name" placeholder="First name" />
                    @error('name')
                        <x-input-error :messages="$message" />
                    @enderror
                </div>
                <div>
                    <x-input type="email" name="email" placeholder="Email" />
                    @error('email')
                        <x-input-error :messages="$message" />
                    @enderror
                </div>
                <div class="relative">
                    <x-input type="text" name="phone" placeholder="Phone" />
                </div>
                <div>
                    <x-input type="text" name="company_name" placeholder="Company Name" />
                </div>
                <div>
                    <x-input type="text" name="company_address" placeholder="Company Address" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-[#4a4a4a] mb-2">Best Time to Reach Out</label>
                    <div class="flex items-center space-x-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="time[]" value="Morning" class="mr-2">
                            Morning
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="time[]" value="Afternoon" class="mr-2">
                            Afternoon
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="time[]" value="Evening" class="mr-2">
                            Evening
                        </label>
                    </div>
                </div>
                <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">

                <button type="submit"
                    class="w-full py-2 bg-[#5a7864] text-white font-semibold rounded-lg hover:bg-[#466655]">
                    Submit
                </button>
            </form>
            <p class="text-xs text-center text-[#4a4a4a] mt-4">
                By signing up, you agree to receive marketing messages at the phone number or email provided. Msg and data rates may apply. View our privacy policy and terms of service for more info.
            </p>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js?render={{ config('services.google.recaptcha.sitekey') }}"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Initialize reCAPTCHA
        function initializeRecaptcha() {
            grecaptcha.ready(function () {
                grecaptcha.execute('{{ config('services.google.recaptcha.sitekey') }}', { action: 'submit' }).then(function (token) {
                    document.getElementById('recaptchaResponse').value = token;
                });
            });
        }

        // Call reCAPTCHA on load
        initializeRecaptcha();

        // AJAX form submission
        $('form').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const url = form.attr('action');
            const type = form.attr('method');
            const data = form.serialize();

            // Clear previous error messages
            form.find('.error-message').remove();
            form.find('.error-field').removeClass('error-field');

            $.ajax({
                url: url,
                type: type,
                data: data,
                success: function (response) {
                    if (response.status === 'success') {
                        alert('Form submitted successfully.');
                        form.trigger('reset');
                        initializeRecaptcha(); // Reset reCAPTCHA after a successful submission
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                },
                error: function (xhr) {
                    // Handle Laravel validation errors (422 status code)
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;

                        $.each(errors, function (key, value) {
                            if (key === 'g-recaptcha-response') {
                                alert('reCAPTCHA validation failed. Please reload the page and try again.');
                            } else {
                                const field = form.find(`[name="${key}"]`);
                                if (field.length) {
                                    field.addClass('error-field'); // Highlight the field with error
                                    field.after(`<div class="error-message text-red-500 text-sm">${value[0]}</div>`); // Display error message
                                }
                            }
                        });

                        // Reset reCAPTCHA
                        initializeRecaptcha();
                    } else {
                        alert('An unexpected error occurred. Please try again later.');
                    }
                }
            });
        });
    });
</script>

@endpush
