<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cache Cleared</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-green-400 to-blue-500">

<div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-md">
    <div class="flex justify-center mb-4">
        <svg class="w-16 h-16 text-green-500 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7 10a5 5 0 018 0m-8 0a5 5 0 000 8m8 0a5 5 0 000-8"></path>
        </svg>
    </div>
    <h2 class="text-3xl font-bold text-gray-800">Cache Cleared!</h2>
    <p class="mt-3 text-gray-600">{{ $message }}</p>
    <a href="{{ url('/') }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-2 rounded-full shadow-lg hover:bg-blue-700 transition duration-300">
        Go to Homepage
    </a>
</div>

</body>
</html>
