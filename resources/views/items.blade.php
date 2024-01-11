<x-app-layout>
    @push('style')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">
    @endpush
    <section class="bg-white dark:bg-gray-900">
    </section>
    <section class="bg-white dark:bg-gray-900" style="margin-top: 6rem;">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-white">Donation service for those in need</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Connecting those who can provide and those who are in need to reduce poverty and serve community.</p>
            </div>
        </div>
    </section>

    <section class="bg-white dark:bg-gray-900">
        @if(session('success'))
            <div id="success-alert" class="mx-auto max-w-screen-xl bg-primary-100 border border-primary-600 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <strong class="font-bold">Success!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg onclick="document.getElementById('success-alert').style.display = 'none';" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>
        @elseif(session('error'))
            <div id="success-alert" class="mx-auto max-w-screen-xl bg-primary-100 border border-primary-600 text-red-700 px-4 py-3 rounded relative mb-2" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg onclick="document.getElementById('success-alert').style.display = 'none';" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            </div>
        @endif

        <div class="mx-auto max-w-screen-xl grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ($items as $item)
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow-lg">
                    <img src="{{ $item->photo_path }}" alt="{{ $item->name }}" class="w-full h-32 object-cover mb-4 rounded-md">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">{{ $item->name }}</h3>
                    <p class="text-gray-500 dark:text-gray-400">{{ $item->description }}</p>
                    <p class="text-gray-500 dark:text-gray-400 font-bold">Price: RM {{ $item->price }}</p>
                    @guest
                        <p class="mt-4 text-gray-500 dark:text-gray-400">Please <a href="{{ route('login') }}" class="font-bold" style="color: #b91c1c;">login</a> to request this item.</p>
                    @else
                        <button data-modal-target="request-modal" data-modal-toggle="request-modal" data-item-price="{{ $item->price }}" data-item-id="{{ $item->id }}" class="mt-4 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 text-white font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            Request
                        </button>
                    @endguest

                </div>
            @endforeach
        </div>
    </section>

    @guest
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">Join our community and make a difference</h2>
                <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Register with PenDon Platform and start making impactful contributions today.</p>
                <a href="{{ route('register') }}" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Register Now</a>
            </div>
        </div>
    </section>
    @endguest

    <!-- Main modal -->
    <div id="request-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Add your form fields for user information (e.g., Name, Description, Proof) -->
                <form id="request-form" action="{{ route('requests.item.store') }}" method="post" enctype="multipart/form-data">
                    @csrf                <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Request Item
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="request-modal">
                            <span class="sr-only">&times;</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <input type="hidden" name="item_id" id="request-item-id" value="">
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded-md" maxlength="100" rows="8" placeholder="This textarea has a limit of 100 chars." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="mb-1 block text-sm font-medium text-gray-700">Phone Number:</label>
                            <input type="tel" name="phone" id="phone" class="mt-1 p-2 w-full border rounded-r-md" autocomplete="off" data-intl-tel-input-id="0" placeholder="(201) 555-0123">
                        </div>
                        <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-4" id="proof">
                            <label for="proof" class="block text-sm font-medium text-gray-700">Upload Proof (Image)</label>
                            <input type="file" id="proof" name="image" class="border"/>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Submit Request</button>
                        <button type="button" data-modal-hide="request-modal" class="ms-3 text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            $(document).ready(function() {
                // Add a click event listener to all elements with data-modal-target
                document.querySelectorAll('[data-modal-target]').forEach(item => {
                    // When a button is clicked, update the hidden input with the corresponding item id
                    item.addEventListener('click', () => {
                        const itemId = item.getAttribute('data-item-id');
                        const itemPrice = item.getAttribute('data-item-price');
                        if (itemPrice >= 100) {
                            document.getElementById('proof').style.display = 'block';
                        } else {
                            document.getElementById('proof').style.display = 'none';
                        }

                        document.getElementById('request-item-id').value = itemId;
                    });
                });

                // Add event listener for click outside the modal
                $(document).on('click', function (event) {
                    if ($(event.target).closest('#request-modal').length === 0) {
                        console.log('clicked outside');
                        // Reset the form fields on click outside the modal
                        $('#request-form')[0].reset();
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/intlTelInput.min.js"></script>
        <script>
            const input = document.querySelector("#phone");
            window.intlTelInput(input, {
                initialCountry: "auto",
                geoIpLookup: callback => {
                    fetch("https://ipapi.co/json")
                        .then(res => res.json())
                        .then(data => callback(data.country_code))
                        .catch(() => callback("us"));
                },
                utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
            });
        </script>
    @endpush
</x-app-layout>
