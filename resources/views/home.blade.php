<x-app-layout>
<main class="sm:container sm:mx-auto sm:mt-10">
    <div class="w-full sm:px-6">

        @if (session('status'))
            <div class="px-3 py-4 mb-4 text-sm text-green-700 bg-green-100 border border-t-8 border-green-600 rounded" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

            <header class="px-6 py-5 font-semibold text-gray-700 bg-gray-200 sm:py-6 sm:px-8 sm:rounded-t-md">
                Dashboard
            </header>

            <div class="w-full p-6">
                <p class="text-gray-700">

                </p>

                <div class="block py-10 bg-white">
                    <div class="max-w-2xl mx-auto">
                        <!--
                            ! ------------------------------------------------------------
                            ! Profile banner and avatar
                            ! ------------------------------------------------------------
                            !-->
                        <div class="w-full">
                            <div class="w-full h-48 bg-blue-600 rounded-t-lg"></div>
                            <div class="absolute ml-5 -mt-20">
                                <img src="{{ asset('storage/img/'.$profile->avatar ) }}" class="w-40 bg-gray-200 border border-b rounded-lg shadow-md h-36 border-primary">
                                <img src="" alt="">
                            </div>
                        </div>

                        <!--
                            ! ------------------------------------------------------------
                            ! Profile general information
                            ! ------------------------------------------------------------
                            !-->
                        <div class="flex flex-col p-5 pt-20 border rounded-b-lg bg-primary border-primary">
                            <div class="w-40 h-5 mb-1 bg-gray-200 border border-gray-300">
                                You are logged in!
                                </div>
                            <div class="h-5 mb-1 bg-gray-200 border border-gray-300 w-96">{{  $user['username'] }}</div>
                            <div class="mt-2 text-sm text-gray-200">
                                <div class="flex flex-row items-center ml-auto space-x-2">
                                    <div class="w-20 h-5 mb-1 bg-gray-200 border border-gray-300">{{  $profile['fullname' ]}}</div>
                                    <div class="w-1 h-1 bg-blue-200 rounded-full"></div>
                                    <div class="w-20 h-5 mb-1 bg-gray-200 border border-gray-300">fthfdthftd</div>
                                </div>
                            </div>

                            <div class="py-5 break-all bbcode">
                                <div class="h-5 mb-1 bg-gray-200 border border-gray-300 w-44">dfhdhdth</div>
                                <div class="w-full h-5 h-40 mb-1 bg-gray-200 border border-gray-300">fthfthf</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
</main>
</x-app-layout>
