<!-- Header -->
<header class="bb-header relative z-[5] border-b-[1px] border-solid border-[#eee]">
    <div class="top-header bg-[#3d4750] py-[6px] max-[991px]:hidden">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="inner-top-header flex justify-between">
                        <div class="col-left-bar">
                            <a href="{{route('home')}}"
                               class="transition-all duration-[0.3s] ease-in-out font-Poppins font-light text-[14px] text-[#fff] leading-[28px] tracking-[0.03rem]">
                               Welcome to {{ config('app.name') }} – Your source for pure, natural beauty!
                            </a>
                        </div>
                        <div class="col-right-bar flex">
                            <div class="cols px-[12px]">
                                <a href="{{route('about')}}"
                                   class="transition-all duration-[0.3s] ease-in-out font-Poppins text-[14px] text-[#fff] font-light leading-[28px] tracking-[0.03rem]">About Us</a>
                            </div>
                            <div class="cols px-[12px]">
                                <a href="{{route('home')}}"
                                   class="transition-all duration-[0.3s] ease-in-out font-Poppins text-[14px] text-[#fff] font-light leading-[28px] tracking-[0.03rem]">Help?</a>
                            </div>
                            <div class="cols px-[12px]">
                                <a href="{{route('home')}}"
                                   class="transition-all duration-[0.3s] ease-in-out font-Poppins text-[14px] text-[#fff] font-light leading-[28px] tracking-[0.03rem]">Track
                                    Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-header py-[20px] max-[991px]:py-[15px]">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="inner-bottom-header flex justify-between max-[767px]:flex-col">
                        <div class="cols bb-logo-detail flex max-[767px]:justify-between">
                            <!-- Header Logo Start -->
                            <div class="header-logo flex items-center max-[575px]:justify-center">
                                <a href="{{ route('home') }}" class="flex gap-2 items-center">
                                    <img src="{{ asset('images/logos/logo1.png') }}" alt="{{ config('app.name') }}"
                                         class="light w-[48px] h-[48px] block object-contain">

                                    <span class="h-full">
                                        <span class="block text-lg text-[#5eb595] font-semibold leading-tight tracking-tight transition-all duration-300">
                                        Zozy Tozy
                                        </span>
                                        <span class="block text-xs text-[#5eb595] font-medium leading-snug tracking-widest transition-all duration-300">
                                            Tailoring Trend Shaping Dream
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <!-- Header Logo End -->
                            <a href="javascript:void(0)"
                               class="bb-sidebar-toggle bb-category-toggle hidden max-[991px]:flex max-[991px]:items-center max-[991px]:ml-[20px] max-[991px]:border-[1px] max-[991px]:border-solid max-[991px]:border-[#eee] max-[991px]:w-[40px] max-[991px]:h-[40px] max-[991px]:rounded-[15px] justify-center transition-all duration-[0.3s] ease-in-out font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                <svg class="svg-icon h-[30px] w-[30px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                     viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-[#6c7fd8]"
                                          d="M384 928H192a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 608a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V640a32 32 0 0 0-32-32H192zM784 928H640a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v144a32 32 0 0 1-64 0V640a32 32 0 0 0-32-32H640a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h144a32 32 0 0 1 0 64zM384 480H192a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H192zM832 480H640a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM640 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H640z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="cols flex justify-center">
                            <div x-data="searchComponent()"
                                class="header-search w-[600px] max-[1399px]:w-[500px] max-[1199px]:w-[400px] max-[991px]:w-full max-[991px]:min-w-[300px] max-[767px]:py-[15px] max-[480px]:min-w-[auto] relative">

                                <form class="bb-btn-group-form flex relative max-[991px]:ml-[20px] max-[767px]:m-[0]" @submit.prevent="handleSubmit" @keydown.enter="handleEnter">
                                    <input
                                        class="form-control bb-search-bar bg-[#fff] block w-full min-h-[45px] h-[48px] py-[10px] pr-[10px] pl-[20px] max-[991px]:min-h-[40px] max-[991px]:h-[40px] max-[991px]:p-[10px] text-[14px] font-normal leading-[1] text-[#777] rounded-[10px] border-[1px] border-solid border-[#eee] tracking-[0.5px]"
                                        placeholder="Search products..."
                                        type="text"
                                        x-model="query"
                                        @input="search"
                                    >
                                    <button
                                        class="submit absolute top-[0] left-[auto] right-[0] flex items-center justify-center w-[45px] h-full bg-transparent text-[#555] text-[16px] rounded-[0] outline-[0] border-[0] padding-[0]"
                                        type="submit"
                                        title="Search">
                                        <i class="ri-search-line text-[18px] leading-[12px] text-[#555]"></i>
                                    </button>
                                    <button
                                    type="button"
                                    class="clear absolute right-[55px] top-[0] flex items-center justify-center w-[45px] h-full bg-transparent text-[#d9534f] text-[16px] rounded-[0] outline-[0] border-[0] padding-[0]"
                                    title="Clear"
                                    x-show="query"
                                    @click="clearSearch"
                                >
                                    <i class="ri-close-line text-[18px] leading-[12px] text-[#d9534f]"></i>
                                </button>
                                </form>

                                <!-- Hint for minimum character requirement -->
                                <p class="text-red-500 text-[12px] mt-1 hidden search-error">
                                    Please type at least 2 characters.
                                </p>

                                <!-- Results Dropdown -->
                                <ul
                                    class="absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden search-results"
                                    style="max-height: 400px; overflow-y: auto;"
                                >
                                    <template x-for="(item, index) in results" :key="index">
                                        <li class="flex items-center p-3 hover:bg-gray-100 cursor-pointer border-b-2" @click="selectItem(item)">
                                            <img x-show="item.featured_image"
                                                :src="`/storage/${item.featured_image}`" alt="Product Image" class="w-[50px] h-[50px] object-cover rounded-md mr-3">
                                            <div class="flex-1">
                                                <div class="flex justify-between">
                                                    <span x-text="item.name" class="font-medium text-[#333] text-[14px]"></span>
                                                    <span  x-show="item.price"  x-text="`$${Number(item.price).toFixed(2)}`"  class="font-medium text-[#333] text-[14px]"></span>
                                                </div>
                                                <span x-text="item.category" class="text-[#777] text-[12px]"></span>
                                            </div>
                                        </li>
                                    </template>
                                </ul>
                            </div>

                        </div>

                        <div class="cols bb-icons flex justify-center">
                            <div class="bb-flex-justify max-[575px]:flex max-[575px]:justify-between">
                                <div class="bb-header-buttons h-full flex justify-end items-center">
                                    <div class="bb-acc-drop relative">
                                        <a href="javascript:void(0)"
                                            class="bb-header-btn bb-header-user dropdown-toggle bb-user-toggle transition-all duration-[0.3s] ease-in-out relative flex w-[auto] items-center whitespace-nowrap ml-[30px] max-[1199px]:ml-[20px] max-[767px]:ml-[0]"
                                            title="Account">
                                            <div class="header-icon relative flex">
                                                <svg
                                                    class="svg-icon w-[30px] h-[30px] max-[1199px]:w-[25px] max-[1199px]:h-[25px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                                    viewBox="0 0 1024 1024" version="1.1"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="fill-[#6c7fd8]"
                                                        d="M512.476 648.247c-170.169 0-308.118-136.411-308.118-304.681 0-168.271 137.949-304.681 308.118-304.681 170.169 0 308.119 136.411 308.119 304.681C820.594 511.837 682.645 648.247 512.476 648.247L512.476 648.247zM512.476 100.186c-135.713 0-246.12 109.178-246.12 243.381 0 134.202 110.407 243.381 246.12 243.381 135.719 0 246.126-109.179 246.126-243.381C758.602 209.364 648.195 100.186 512.476 100.186L512.476 100.186zM935.867 985.115l-26.164 0c-9.648 0-17.779-6.941-19.384-16.35-2.646-15.426-6.277-30.52-11.142-44.95-24.769-87.686-81.337-164.13-159.104-214.266-63.232 35.203-134.235 53.64-207.597 53.64-73.555 0-144.73-18.537-208.084-53.922-78 50.131-134.75 126.68-159.564 214.549 0 0-4.893 18.172-11.795 46.4-2.136 8.723-10.035 14.9-19.112 14.9L88.133 985.116c-9.415 0-16.693-8.214-15.47-17.452C91.698 824.084 181.099 702.474 305.51 637.615c58.682 40.472 129.996 64.267 206.966 64.267 76.799 0 147.968-23.684 206.584-63.991 124.123 64.932 213.281 186.403 232.277 329.772C952.56 976.901 945.287 985.115 935.867 985.115L935.867 985.115z"/>
                                                </svg>
                                            </div>
                                            <div class="bb-btn-desc flex flex-col ml-[10px] max-[1199px]:hidden">
                                                <span
                                                    class="bb-btn-title font-Poppins transition-all duration-[0.3s] ease-in-out text-[12px] leading-[1] text-[#3d4750] mb-[4px] tracking-[0.6px] capitalize font-medium whitespace-nowrap">Account</span>
                                                    <!-- if logged in -->
                                                    @auth
                                                        <span
                                                            class="bb-btn-stitle font-Poppins transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750]  tracking-[0.03rem] whitespace-nowrap">{{ auth()->user()->name }}</span>
                                                    @endauth
                                                    <!-- if logged in -->
                                                    <!-- if not logged in -->
                                                    @guest
                                                    <span
                                                        class="bb-btn-stitle font-Poppins transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750]  tracking-[0.03rem] whitespace-nowrap">Login</span>
                                                    @endguest
                                            </div>
                                        </a>
                                        <ul class="bb-dropdown-menu min-w-[150px] py-[10px] px-[5px] transition-all duration-[0.3s] ease-in-out mt-[25px] absolute z-[16] text-left opacity-[0] right-[auto] bg-[#fff] border-[1px] border-solid border-[#eee] block rounded-[10px]">
                                            @guest
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('register') }}">Register</a></li>
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('checkout') }}">Checkout</a></li>
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('login') }}">Login</a></li>
                                            @endguest
                                            @auth
                                                <!-- dashboard -->
                                                {{-- if auth user is_admin --}}
                                                @if(auth()->user()->is_admin)
                                                    <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                        <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                        href="{{ route('dashboard') }}">Admin Dashboard</a></li>
                                                        {{-- devider --}}
                                                        <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                            <hr class="my-[5px] border-[1px] border-solid border-[#eee]">
                                                        </li>
                                                @endif
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('user.dashboard') }}">Dashboard</a></li>
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('checkout') }}">Checkout</a></li>
                                                <li class="py-[4px] px-[15px] m-[0] font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem]">
                                                    <a class="dropdown-item transition-all duration-[0.3s] ease-in-out font-Poppins text-[13px] hover:text-[#6c7fd8] leading-[22px] block w-full font-normal tracking-[0.03rem]"
                                                    href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            @endauth
                                        </ul>
                                    </div>
                                    <a href="javascript:void(0)"
                                       class="bb-header-btn bb-cart-toggle transition-all duration-[0.3s] ease-in-out relative flex w-[auto] items-center ml-[30px] max-[1199px]:ml-[20px]"
                                       title="Cart">
                                        <div class="header-icon relative flex">
                                            <svg
                                                class="svg-icon w-[30px] h-[30px] max-[1199px]:w-[25px] max-[1199px]:h-[25px] max-[991px]:w-[22px] max-[991px]:h-[22px]"
                                                viewBox="0 0 1024 1024" version="1.1"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path class="fill-[#6c7fd8]"
                                                      d="M351.552 831.424c-35.328 0-63.968 28.64-63.968 63.968 0 35.328 28.64 63.968 63.968 63.968 35.328 0 63.968-28.64 63.968-63.968C415.52 860.064 386.88 831.424 351.552 831.424L351.552 831.424 351.552 831.424zM799.296 831.424c-35.328 0-63.968 28.64-63.968 63.968 0 35.328 28.64 63.968 63.968 63.968 35.328 0 63.968-28.64 63.968-63.968C863.264 860.064 834.624 831.424 799.296 831.424L799.296 831.424 799.296 831.424zM862.752 799.456 343.264 799.456c-46.08 0-86.592-36.448-92.224-83.008L196.8 334.592 165.92 156.128c-1.92-15.584-16.128-28.288-29.984-28.288L95.2 127.84c-17.664 0-32-14.336-32-31.968 0-17.664 14.336-32 32-32l40.736 0c46.656 0 87.616 36.448 93.28 83.008l30.784 177.792 54.464 383.488c1.792 14.848 15.232 27.36 28.768 27.36l519.488 0c17.696 0 32 14.304 32 31.968S880.416 799.456 862.752 799.456L862.752 799.456zM383.232 671.52c-16.608 0-30.624-12.8-31.872-29.632-1.312-17.632 11.936-32.928 29.504-34.208l433.856-31.968c15.936-0.096 29.344-12.608 31.104-26.816l50.368-288.224c1.28-10.752-1.696-22.528-8.128-29.792-4.128-4.672-9.312-7.04-15.36-7.04L319.04 223.84c-17.664 0-32-14.336-32-31.968 0-17.664 14.336-31.968 32-31.968l553.728 0c24.448 0 46.88 10.144 63.232 28.608 18.688 21.088 27.264 50.784 23.52 81.568l-50.4 288.256c-5.44 44.832-45.92 81.28-92 81.28L385.6 671.424C384.8 671.488 384 671.52 383.232 671.52L383.232 671.52zM383.232 671.52"/>
                                            </svg>
                                            <span class="main-label-note-new"></span>
                                        </div>
                                        <div class="bb-btn-desc flex flex-col ml-[10px] max-[1199px]:hidden">
                                            <span
                                                class="bb-btn-title font-Poppins transition-all duration-[0.3s] ease-in-out text-[12px] leading-[1] text-[#3d4750] mb-[4px] tracking-[0.6px] capitalize font-medium whitespace-nowrap"><b
                                                    class="bb-cart-count">0</b> items</span>
                                            <span
                                                class="bb-btn-stitle font-Poppins transition-all duration-[0.3s] ease-in-out text-[14px] leading-[16px] font-semibold text-[#3d4750]  tracking-[0.03rem] whitespace-nowrap">Cart</span>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)"
                                       class="bb-toggle-menu hidden max-[991px]:flex max-[991px]:ml-[20px]">
                                        <div class="header-icon">
                                            <i class="ri-menu-3-fill text-[22px] text-[#6c7fd8]"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bb-main-menu-desk bg-[#fff] py-[5px] border-t-[1px] border-solid border-[#eee] max-[991px]:hidden">
        <div
            class="flex flex-wrap justify-between relative items-center mx-auto min-[1400px]:max-w-[1320px] min-[1200px]:max-w-[1140px] min-[992px]:max-w-[960px] min-[768px]:max-w-[720px] min-[576px]:max-w-[540px]">
            <div class="flex flex-wrap w-full">
                <div class="w-full px-[12px]">
                    <div class="bb-inner-menu-desk flex max-[1199px]:relative max-[991px]:justify-between">
                        <a href="javascript:void(0)" aria-label="Explore Categories"
                           class="bb-header-btn bb-sidebar-toggle bb-category-toggle transition-all duration-[0.3s] ease-in-out h-[45px] w-[45px] mr-[30px] p-[8px] flex items-center justify-center bg-[#fff] border-[1px] border-solid border-[#eee] rounded-[10px] relative max-[767px]:m-[0] max-[575px]:hidden">
                            <svg class="svg-icon w-[25px] h-[25px]" viewBox="0 0 1024 1024" version="1.1"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path class="fill-[#6c7fd8]"
                                      d="M384 928H192a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 608a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V640a32 32 0 0 0-32-32H192zM784 928H640a96 96 0 0 1-96-96V640a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v144a32 32 0 0 1-64 0V640a32 32 0 0 0-32-32H640a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h144a32 32 0 0 1 0 64zM384 480H192a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM192 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H192zM832 480H640a96 96 0 0 1-96-96V192a96 96 0 0 1 96-96h192a96 96 0 0 1 96 96v192a96 96 0 0 1-96 96zM640 160a32 32 0 0 0-32 32v192a32 32 0 0 0 32 32h192a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32H640z"/>
                            </svg>
                        </a>
                        <button class="navbar-toggler shadow-none hidden" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ri-menu-2-line"></i>
                        </button>
                        <div class="bb-main-menu relative flex flex-[auto] justify-start max-[991px]:hidden"
                             id="navbarSupportedContent">
                            <ul class="navbar-nav flex flex-wrap flex-row ">
                                <li class="nav-item flex items-center font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem] mr-[35px]">
                                    <a class="nav-link p-[0] font-Poppins leading-[28px] text-[15px] font-medium text-[#3d4750] tracking-[0.03rem] block"
                                       href="{{ route('home') }}">Home</a>
                                </li>
                                @php($menuCategories = getMenuCategories())
                                @foreach($menuCategories as $key => $menu)
                                <!-- break if $key > 6 -->
                                @if($key > 8)
                                    @break
                                @endif
                                    @if($menu->submenus->count() > 0)
                                    <li class="nav-item bb-dropdown flex items-center relative mr-[45px]">
                                        <a class="nav-link bb-dropdown-item font-Poppins relative p-[0] leading-[28px] text-[15px] font-medium text-[#3d4750] block tracking-[0.03rem]"
                                           href="{{ route('category.products', [$menu->slug]) }}">{{ $menu->name }}</a>
                                        <ul class="bb-dropdown-menu min-w-[205px] p-[10px] transition-all duration-[0.3s] ease-in-out mt-[25px] absolute top-[40px] z-[16] text-left opacity-[0] invisible left-[0] right-[auto] bg-[#fff] border-[1px] border-solid border-[#eee] flex flex-col rounded-[10px]">
                                            @foreach($menu->submenus as $submenu)
                                                <li class="m-[0] py-[5px] px-[15px] relative flex items-center">
                                                    <a href="{{ route('category.products', [$submenu->slug]) }}"
                                                       class="font-Poppins transition-all duration-[0.3s] ease-in-out py-[5px] leading-[22px] text-[14px] font-normal text-[#686e7d] hover:text-[#6c7fd8] capitalize tracking-[0.03rem]">{{ $submenu->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @else
                                        <li class="nav-item flex items-center font-Poppins text-[15px] text-[#686e7d] font-light leading-[28px] tracking-[0.03rem] mr-[35px]">
                                            <a class="nav-link p-[0] font-Poppins leading-[28px] text-[15px] font-medium text-[#3d4750] tracking-[0.03rem] block"
                                            href="{{ route('category.products', [$menu->slug]) }}">{{ $menu->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bb-mobile-menu-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#000000cc] z-[16]"></div>
    <div id="bb-mobile-menu"
        class="bb-mobile-menu transition-all duration-[0.3s] ease-in-out w-[340px] h-full pt-[15px] px-[20px] pb-[20px] fixed top-[0] right-[auto] left-[0] bg-[#fff] translate-x-[-100%] flex flex-col z-[17] overflow-auto max-[480px]:w-[300px]">
        <div class="bb-menu-title w-full pb-[10px] flex flex-wrap justify-between">
            <span
                class="menu_title font-Poppins flex items-center text-[16px] text-[#3d4750] font-semibold leading-[26px] tracking-[0.02rem]">My Menu</span>
            <button type="button"
                    class="bb-close-menu relative border-[0] text-[30px] leading-[1] text-[#ff0000] bg-transparent">×
            </button>
        </div>
        <div class="bb-menu-inner">
            <div class="bb-menu-content">
                <ul>
                    <li class="relative">
                        <a href="{{ route('home') }}"
                           class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block font-Poppins capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium leading-[28px] tracking-[0.03rem]">Home</a>
                    </li>
                    @foreach($menuCategories as $menu)
                    @if($menu->submenus->count() > 0)
                        <li class="relative">
                            <a href="javascript:void(0)"
                               class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block font-Poppins capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium leading-[28px] tracking-[0.03rem]">{{ $menu->name }}</a>
                            <ul class="sub-menu w-full min-w-[auto] p-[0] mb-[10px] static hidden visible opacity-[1]">
                                @foreach($menu->submenus as $submenu)
                                    <li class="relative">
                                        <a href="{{ route('category.products', [$submenu->slug]) }}"
                                           class="font-Poppins leading-[28px] tracking-[0.03rem] transition-all duration-[0.3s] ease-in-out font-normal pl-[12px] text-[14px] text-[#777] mb-[0] capitalize block py-[12px]">{{ $submenu->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @else
                            <li class="relative">
                                <a href="{{ route('category.products', [$menu->slug]) }}"
                                   class="transition-all duration-[0.3s] ease-in-out mb-[12px] p-[12px] block font-Poppins capitalize text-[#686e7d] border-[1px] border-solid border-[#eee] rounded-[10px] text-[15px] font-medium leading-[28px] tracking-[0.03rem]">{{ $menu->name }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social mt-[30px]">
                    <div class="header-top-social">
                        <ul class="flex flex-row justify-center mb-[0]">
                            <li class="list-inline-item w-[30px] h-[30px] flex items-center justify-center bg-[#3d4750] rounded-[10px] mr-[.5rem]">
                                <a href="#" class="transition-all duration-[0.3s] ease-in-out"><i
                                        class="ri-facebook-fill text-[#fff] text-[15px]"></i></a>
                            </li>
                            <li class="list-inline-item w-[30px] h-[30px] flex items-center justify-center bg-[#3d4750] rounded-[10px] mr-[.5rem]">
                                <a href="#" class="transition-all duration-[0.3s] ease-in-out"><i
                                        class="ri-twitter-fill text-[#fff] text-[15px]"></i></a>
                            </li>
                            <li class="list-inline-item w-[30px] h-[30px] flex items-center justify-center bg-[#3d4750] rounded-[10px] mr-[.5rem]">
                                <a href="#" class="transition-all duration-[0.3s] ease-in-out"><i
                                        class="ri-instagram-line text-[#fff] text-[15px]"></i></a>
                            </li>
                            <li class="list-inline-item w-[30px] h-[30px] flex items-center justify-center bg-[#3d4750] rounded-[10px]">
                                <a href="#" class="transition-all duration-[0.3s] ease-in-out"><i
                                        class="ri-linkedin-fill text-[#fff] text-[15px]"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
</header>
<!-- Header End -->

<!-- Category Popup -->
<div class="bb-category-sidebar transition-all duration-[0.3s] ease-in-out w-full h-full fixed top-[0] z-[17] hidden">
    <div class="bb-category-overlay hidden w-full h-screen fixed top-[0] left-[0] bg-[#00000080] z-[17]"></div>
    <div
        class="category-sidebar w-[calc(100%-30px)] max-[1199px]:h-[calc(100vh-60px)] max-w-[1200px] my-[15px] mx-[auto] py-[30px] px-[15px] text-[14px] font-normal transition-all duration-[0.5s] ease-in-out delay-[0s] bg-[#fff] overflow-auto rounded-[30px] z-[18] relative">
        <button type="button"
                class="bb-category-close transition-all duration-[0.3s] ease-in-out w-[16px] h-[20px] absolute top-[-5px] right-[27px] bg-[#e04e4eb3] rounded-[10px] cursor-pointer hover:bg-[#e04e4e]"
                title="Close"></button>
        <div class="w-full mx-auto">
            <div class="flex flex-wrap w-full mb-[-24px]">
                <div class="w-full">
                    <div class="flex flex-wrap w-full">
                        <div class="w-full px-[12px]">
                            <div class="sub-title mb-[20px] flex justify-between">
                                <h4 class="font-quicksand tracking-[0.03rem] leading-[1.2] text-[20px] font-bold text-[#3d4750] capitalize">
                                    Explore Categories</h4>
                            </div>
                        </div>
                        @foreach($menuCategories as $category)
                            <div
                                class="min-[1200px]:w-[16.66%] min-[768px]:w-[33.33%] min-[576px]:w-[50%] w-full px-[12px] mb-[24px]" title="{{ $category->name }}">
                                <div
                                    class="bb-category-box p-[30px] rounded-[20px] flex flex-col items-center text-center max-[1399px]:p-[20px] category-items-1 bg-[#fef1f1]">
                                    <div class="category-image mb-[12px]">
                                        <img
                                        data-src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/icons/natural-product.png') }}"
                                            {{-- src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/icons/natural-product.png') }}" --}}
                                            alt="category"
                                            class="w-[50px] h-[50px] max-[1399px]:h-[65px] max-[1399px]:w-[65px] max-[1199px]:h-[50px] max-[1199px]:w-[50px] lozad">
                                    </div>
                                    <div class="category-sub-contact">
                                        <h5 class="mb-[2px] text-[16px] font-quicksand text-[#3d4750] font-semibold tracking-[0.03rem] leading-[1.2] line-clamp-1">
                                            <a href="{{ route('category.products', [$category->slug]) }}"
                                                class="font-Poppins text-[16px] font-medium leading-[1.2] tracking-[0.03rem] text-[#3d4750] capitalize">{{ $category->name }}</a>
                                        </h5>
                                        <p class="font-Poppins text-[13px] text-[#686e7d] leading-[25px] font-light tracking-[0.03rem]">
                                            {{--  count category products & submenu relation products count   --}}
                                            {{ $category->products->count() + $category->submenus->sum('products_count') }}
                                            Products
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const searchResultsUrl = "{{ route('search.results') }}"; // Named route for search results
    const searchApiUrl = "{{ route('api.products.search') }}"; // Named route for API search

    function searchComponent() {
    return {
        query: '',
        results: [],
        isMinimumLength: false, // Track if minimum length condition is met
        timeout: null, // Store the timeout reference for debounce
        debounceDelay: 300, // Delay in milliseconds

        search() {
            // Check if query length is less than 2
            if (this.query.length < 2) {
                this.isMinimumLength = false; // Update the hint visibility
                this.results = []; // Clear results
                document.querySelector('.search-results').classList.add('hidden'); // Hide the results
                document.querySelector('.search-error').classList.remove('hidden'); // Show the error hint
                return; // Exit the function
            } else {
                this.isMinimumLength = true; // Set the minimum length flag
                document.querySelector('.search-error').classList.add('hidden'); // Hide the error hint
            }

            clearTimeout(this.timeout); // Clear previous timeout

            this.timeout = setTimeout(() => {
                // Make a POST request to your Laravel API using named route
                fetch(searchApiUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ search: this.query })
                })
                .then(response => response.json())
                .then(data => {
                    // change the hidden class to show the results
                    document.querySelector('.search-results').classList.remove('hidden');
                    if (data.length === 0) {
                        this.results = [{
                            name: 'No results found!'
                        }]; // Show no results message
                    } else {
                        this.results = data; // Assuming your API returns an array of products
                    }
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                    this.results = []; // Clear results on error
                });
            }, this.debounceDelay);
        },

        handleEnter() {
            if (this.query.length >= 2) { // Only proceed if query meets length requirement
                window.location.href = `${searchResultsUrl}?query=${encodeURIComponent(this.query)}`;
            }
        },

        handleSubmit() {
            this.search(); // Trigger the search
        },

        selectItem(item) {
            let allCategory = item.categories;
            let firstCategory = allCategory[0].slug;

            this.query = item.name; // Update input with selected item name
            this.results = []; // Clear results
            window.location.href = `/collection/${firstCategory}/product/${item.slug}`;
        },
        clearSearch() {
            this.query = ''; // Clear the input
            this.results = []; // Clear the results
            document.querySelector('.search-results').classList.add('hidden'); // Hide the results
            document.querySelector('.search-error').classList.add('hidden'); // Hide the error hint
        }

    };
}

</script>
