<!-- Sidebar Navigation -->
<nav class="w-[250px] bg-white border border-gray-300 rounded-lg p-4 shadow-lg transition-all duration-300">
    <h3 class="font-semibold text-xl mb-4 text-gray-800 border-b pb-2">Account Menu</h3>
    <ul class="space-y-2">
        <li>
            <a href="#" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/747/747150.png" alt="Profile" class="w-6 h-6 mr-2">
                <span class="font-medium">Profile</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.order.index') }}" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/190/190423.png" alt="My Orders" class="w-6 h-6 mr-2">
                <span class="font-medium">My Orders</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/2917/2917978.png" alt="Addresses" class="w-6 h-6 mr-2">
                <span class="font-medium">Addresses</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/2099/2099101.png" alt="Wishlist" class="w-6 h-6 mr-2">
                <span class="font-medium">Wishlist</span>
            </a>
        </li>
        <li>
            <a href="#" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/4244/4244074.png" alt="Account Settings" class="w-6 h-6 mr-2">
                <span class="font-medium">Account Settings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('logout') }}" class="flex items-center py-2 px-3 text-gray-700 hover:bg-gray-100 rounded-md transition duration-200">
                <img src="https://cdn-icons-png.flaticon.com/512/484/484350.png" alt="Logout" class="w-6 h-6 mr-2">
                <span class="font-medium">Logout</span>
            </a>
        </li>
    </ul>
</nav>