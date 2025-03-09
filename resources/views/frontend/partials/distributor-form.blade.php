
<div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-green-500 p-6 rounded-lg shadow-lg max-w-lg w-full">
      <div class="text-center mb-4">
        <h2 class="text-2xl font-bold text-white">Go Ahead!</h2>
        <p class="text-sm text-white">
          Complete the form to give us some information. <br />
          Get in touch with us at this number between 9am to 7pm: <br />
          <span class="font-semibold">215-224-3558</span>
        </p>
      </div>
      <form class="space-y-4">
        <div>
          <label for="first-name" class="block text-sm font-medium text-white">First name</label>
          <input type="text" id="first-name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700" />
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-white">Email</label>
          <input type="email" id="email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700" />
        </div>
        <div class="grid grid-cols-3 gap-2">
          <div>
            <label for="country-code" class="block text-sm font-medium text-white">Code</label>
            <select id="country-code" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700">
              <option>+880</option>
              <option>+1</option>
              <option>+44</option>
              <!-- Add more codes as needed -->
            </select>
          </div>
          <div class="col-span-2">
            <label for="phone" class="block text-sm font-medium text-white">Phone</label>
            <input type="tel" id="phone" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700" />
          </div>
        </div>
        <div>
          <label for="company-name" class="block text-sm font-medium text-white">Company Name</label>
          <input type="text" id="company-name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700" />
        </div>
        <div>
          <label for="company-address" class="block text-sm font-medium text-white">Company Address</label>
          <input type="text" id="company-address" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-green-600 focus:border-green-600 text-gray-700" />
        </div>
        <div>
          <label class="block text-sm font-medium text-white">Best Time to Reach Out</label>
          <div class="mt-2 flex space-x-4">
            <label class="inline-flex items-center text-white">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-2 focus:ring-green-600 focus:outline-none" />
              <span class="ml-2">Morning</span>
            </label>
            <label class="inline-flex items-center text-white">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-2 focus:ring-green-600 focus:outline-none" />
              <span class="ml-2">Afternoon</span>
            </label>
            <label class="inline-flex items-center text-white">
              <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600 rounded focus:ring-2 focus:ring-green-600 focus:outline-none" />
              <span class="ml-2">Evening</span>
            </label>
          </div>
        </div>
        <div>
          <button type="submit" class="w-full py-2 bg-black text-white rounded-lg font-medium hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-800">
            Submit
          </button>
        </div>
        <p class="text-xs text-white text-center">
          By signing up, you agree to receive marketing messages at the phone number or email provided. Msg and data rates may apply. View our privacy policy and terms of service for more info.
        </p>
      </form>
    </div>
  </div>
  