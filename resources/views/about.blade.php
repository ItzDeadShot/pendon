<x-app-layout>
    <section class="bg-white dark:bg-gray-900" style="margin-top: 6rem;">
        <div class="grid py-8 px-4 mx-auto max-w-screen-xl lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="place-self-center mr-auto lg:col-span-7">
                <h1 class="mb-4 max-w-2xl text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-white">About PenDon</h1>
                <p class="mb-6 max-w-2xl font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Empowering connections and making a positive impact in communities through the PenDon platform.
                    PenDon is more than just a donation platform; it's a catalyst for change. We believe in the power of individuals coming together to create a collective impact.
                    Our mission is to bridge the gap between those who can provide and those in need, with the goal of reducing poverty and fostering a sense of community.
                    With a user-friendly interface, PenDon allows users to effortlessly donate items, connect with others, and fulfill needs.
                    Our platform is designed to streamline the donation process, making it easy for users to contribute to causes they care about.
                    By leveraging technology, we facilitate meaningful connections and provide a space for individuals to make a positive difference in the lives of others.
                    Join us in creating a world where generosity knows no bounds, and communities thrive through the spirit of giving and receiving.
                </p>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="{{ asset('images/about/team-1.jpg') }}" alt="about image">
            </div>
        </div>
    </section>

    <!-- Team Member Section -->
    <section class="bg-gray-50 dark:bg-gray-800 py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mb-8 max-w-screen-md lg:mb-16">
            <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">Meet Our Team</h2>
            <p class="text-gray-500 sm:text-xl dark:text-gray-400">Our dedicated team is committed to creating a positive and impactful experience for users.</p>
        </div>
        <div class="grid grid-cols-2 gap-8 md:grid-cols-4">
            <!-- Team Member 1 -->
            <div class="text-center">
                <img class="object-cover w-32 h-32 mx-auto mb-4 rounded-full" src="{{ asset('images/about/member-1.jpeg') }}" alt="Team Member 1">
                <h3 class="mb-2 text-xl font-bold dark:text-white">Hateez Shafat Khan</h3>
                <p class="text-gray-500 dark:text-gray-400">Co-Founder</p>
            </div>

            <!-- Team Member 2 -->
            <div class="text-center">
                <img class="object-cover w-32 h-32 mx-auto mb-4 rounded-full" src="{{ asset('images/about/member-2.jpeg') }}" alt="Team Member 2">
                <h3 class="mb-2 text-xl font-bold dark:text-white">Wong Wen Yee</h3>
                <p class="text-gray-500 dark:text-gray-400">Lead Developer</p>
            </div>

            <!-- Team Member 3 -->
            <div class="text-center">
                <img class="w-32 h-32 mx-auto mb-4 rounded-full" src="{{ asset('images/about/member-3.jpeg') }}" alt="Team Member 3">
                <h3 class="mb-2 text-xl font-bold dark:text-white">Abdullah Shahid</h3>
                <p class="text-gray-500 dark:text-gray-400">Designer</p>
            </div>

            <!-- Team Member 4 -->
            <div class="text-center">
                <img class="w-32 h-32 mx-auto mb-4 rounded-full" src="{{ asset('images/about/member-4.jpeg') }}" alt="Team Member 4">
                <h3 class="mb-2 text-xl font-bold dark:text-white">Abdulrahman Noori</h3>
                <p class="text-gray-500 dark:text-gray-400">Community Manager</p>
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

    <!-- Additional Sections -->

    <!-- ... (Include additional sections as needed) -->

</x-app-layout>
