<x-app-layout>
    <section class="bg-white dark:bg-gray-900" style="margin-top: 6rem;">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-white">Donation service for those in need</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Connecting those who can provide and those who are in need to reduce poverty and serve community.</p>
                <a href="{{ route('donated-items') }}" class="inline-flex justify-center items-center py-3 px-5 mr-3 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Browse Items
                    <svg class="ml-2 -mr-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </a>
{{--                <a href="#" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-gray-900 rounded-lg border border-gray-300 hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">--}}
{{--                    Speak to Sales--}}
{{--                </a>--}}
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{asset('images/home/donation-main.jpg')}}" alt="mockup">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mb-8 max-w-screen-md lg:mb-16">
                <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">Donate and Receive with Ease</h2>
                <p class="text-gray-500 sm:text-xl dark:text-gray-400">Empowering you to make a difference in the world. Connect with others, post donated items, and fulfill needs through our easy-to-use platform.</p>
            </div>
            <div class="space-y-8 md:grid md:grid-cols-2 lg:grid-cols-3 md:gap-12 md:space-y-0">
                <!-- Update each card accordingly based on your service -->
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="800px" height="800px" viewBox="0 0 435.047 435.047" xml:space="preserve"><g><g><path d="M202.011,205.437c-6.501-2.273-9.219-3.666-9.219-6.391c0-4.857,5.021-6.143,7.679-6.143c5.097,0,6.143,2.068,6.143,5.172v0.242c0,2.232,1.81,4.043,4.039,4.043h1.041c2.23,0,4.039-1.807,4.041-4.039l0.006-7.01c0-1.133-0.475-2.215-1.308-2.98c-2.535-2.326-5.821-3.617-10.003-3.924v-4.598c0-2.232-1.811-4.041-4.039-4.041h-0.974c-2.229,0-4.04,1.809-4.04,4.041v4.918c-6.099,1.684-11.879,7.248-11.879,14.643c0,8.82,7.777,11.482,14.64,13.83c7.115,2.438,10.091,4.021,10.091,7.508c0,5.041-5.234,6.386-8.326,6.386c-3.125,0-6.991-0.892-8.036-2.361c-0.457-0.654-0.765-1.926-0.915-3.785c-0.172-2.098-1.923-3.715-4.027-3.715h-0.821c-1.079,0-2.11,0.43-2.871,1.198c-0.758,0.764-1.18,1.799-1.17,2.877l0.063,7.948c0.013,1.802,1.216,3.371,2.95,3.858c0.175,0.05,0.408,0.103,0.644,0.154l0.192,0.041c3.603,1.006,6.862,1.877,9.467,2.207v6.691c0,2.23,1.811,4.039,4.04,4.039h0.974c2.229,0,4.039-1.809,4.039-4.039v-6.838c6.717-1.412,13.094-6.979,13.094-14.824C217.523,210.867,208.922,207.857,202.011,205.437z"/><path d="M410.734,74.918V0c-21.198,9.292-61.076,22.585-79.635,23.641c-18.56,1.056-105.775-12.639-129.403-6.725c-19.016,4.76-123.429,83.334-154.574,105.002c-49.723,34.593-5.72,40.138,15.158,32.136c21.008-8.052,88.712-45.871,88.712-45.871c-0.214,7.662,0.944,18.508,7.797,30.219c0,0,7.75,10.864,17.037,21.499c-20.04,9.137-34.006,29.351-34.006,52.773c0,19.896,10.078,37.48,25.396,47.926H67.012c-5.549,0-10.048,4.498-10.048,10.047v154.35c0,5.553,4.499,10.051,10.048,10.051h265.562c5.548,0,10.047-4.498,10.047-10.051v-154.35c0-5.549-4.499-10.047-10.047-10.047H232.371c15.316-10.445,25.395-28.029,25.395-47.926c0-14.541-5.394-27.838-14.27-38.025c-0.106-0.089-0.2-0.186-0.289-0.284c14.482-7.218,29.704-20.151,66.559-35.225C371.839,113.751,392.863,84.917,410.734,74.918zM239.722,133.696c-11.633,8.212-19.572,16.233-24.203,23.19c-2.611-0.737-5.295-1.295-8.039-1.664c-2.399-7.765-6.52-17.979-12.799-31.504c0,0-2.882-6.779-1.932-14.885c2.37-9.058,10.55-18.772,33.664-21.755c38.92-5.022,44.443,14.654,26.855,35.14C249.515,126.107,244.982,129.983,239.722,133.696z M245.2,284.544c5.521,0,10.014,4.49,10.014,10.013c0,5.52-4.491,10.012-10.014,10.012h-90.814c-5.521,0-10.012-4.492-10.012-10.012c0-5.521,4.491-10.013,10.012-10.013H245.2z M199.793,255.376c-23.547,0-42.705-19.155-42.705-42.703c0-23.547,19.158-42.703,42.705-42.703c3.474,0,6.847,0.426,10.081,1.213c-0.005,6.768,5.262,10.629,13.948,9.771c1.334-0.131,2.628-0.316,3.893-0.551c9.042,7.838,14.78,19.393,14.78,32.27C242.496,236.221,223.34,255.376,199.793,255.376z"/></g></g></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Donate Items</h3>
                    <p class="text-gray-500 dark:text-gray-400">Post items you wish to donate and make a positive impact in your community.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.726 13.02 14 16H9v-1h4.065a.5.5 0 0 0 .416-.777l-.888-1.332A1.995 1.995 0 0 0 10.93 12H3a1 1 0 0 0-1 1v6a2 2 0 0 0 2 2h9.639a3 3 0 0 0 2.258-1.024L22 13l-1.452-.484a2.998 2.998 0 0 0-2.822.504zm1.532-5.63c.451-.465.73-1.108.73-1.818s-.279-1.353-.73-1.818A2.447 2.447 0 0 0 17.494 3S16.25 2.997 15 4.286C13.75 2.997 12.506 3 12.506 3a2.45 2.45 0 0 0-1.764.753c-.451.466-.73 1.108-.73 1.818s.279 1.354.73 1.818L15 12l4.258-4.61z"/>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Request Items</h3>
                    <p class="text-gray-500 dark:text-gray-400">Easily browse and request items you need, fostering a community of giving and receiving.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Connect and Impact</h3>
                    <p class="text-gray-500 dark:text-gray-400">Build meaningful connections, contribute to causes, and make a positive impact through the power of giving.</p>
                </div>
                <div>
                    <div class="flex justify-center items-center mb-4 w-10 h-10 rounded-full bg-primary-100 lg:h-12 lg:w-12 dark:bg-primary-900">
                        <svg class="w-5 h-5 text-primary-600 lg:w-6 lg:h-6 dark:text-primary-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold dark:text-white">Give Back</h3>
                    <p class="text-gray-500 dark:text-gray-400">Contribute to the community by giving back and supporting those in need.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
            <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">Empowering Connections</h2>
                <p class="mb-4">We facilitate connections through technology. Our platform empowers users to donate and receive items, fostering a sense of community and support. Whether you're contributing to a cause or seeking assistance, our platform is designed for simplicity and speed.</p>
                <p>At our core, we are facilitators – making it easy for you to make a positive impact in your community.</p>
            </div>
            <div class="grid grid-cols-2 gap-4 mt-8">
                <img class="w-full rounded-lg" src="{{asset('images/home/donation-long-1.jpg')}}" alt="donation content 1">
                <img class="mt-4 w-full rounded-lg lg:mt-10" src="{{asset('images/home/donation-long-2.jpg')}}" alt="donation content 2">
            </div>
        </div>
    </section>

    <section class="bg-gray-50 dark:bg-gray-900 dark:bg-gray-800">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="max-w-screen-lg text-gray-500 sm:text-lg dark:text-gray-400">
                <h2 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Connecting Communities with <span class="font-extrabold">Impactful</span> Solutions</h2>
                <p class="mb-4 font-light">Empower communities through our open, collaborative platform. Bridge connections between donors and recipients, allowing for seamless communication and efficient transfer of donated items. Utilize innovative features to enhance the impact of your contributions.</p>
                <p class="mb-4 font-medium">Join us in making a difference. Streamline the donation process, eliminate barriers, and create positive change in communities worldwide.</p>
                <a href="#" class="inline-flex items-center font-medium text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-700">
                    Learn more about us
                    <svg class="ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">Join our community and make a difference</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Register with PenDon Platform and start making impactful contributions today.</p>
                <a href="{{ route('register') }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Register Now</a>
            </div>
        </div>
    </section>

</x-app-layout>
