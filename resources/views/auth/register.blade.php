<x-app-layout>
<main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
    <div class="flex">
        <div class="w-full">
            <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                <header class="px-6 py-5 font-semibold text-gray-700 bg-gray-200 sm:py-6 sm:px-8 sm:rounded-t-md">
                    {{ __('Register') }}
                </header>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST"
                    action="{{ route('register') }}">
                    @csrf

                    <div class="flex flex-wrap">
                        <label for="username" class="block mb-2 text-sm font-bold text-gray-700 sm:mb-4">
                            {{ __('Username') }}:
                        </label>

                        <input id="username" type="text" class="form-input w-full @error('username')  border-red-500 @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="email" class="block mb-2 text-sm font-bold text-gray-700 sm:mb-4">
                            {{ __('E-Mail Address') }}:
                        </label>

                        <input id="email" type="email"
                            class="form-input w-full @error('email') border-red-500 @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password" class="block mb-2 text-sm font-bold text-gray-700 sm:mb-4">
                            {{ __('Password') }}:
                        </label>

                        <input id="password" type="password"
                            class="form-input w-full @error('password') border-red-500 @enderror" name="password"
                            required autocomplete="new-password">

                        @error('password')
                        <p class="mt-4 text-xs italic text-red-500">
                            {{ $message }}
                        </p>
                        @enderror
                    </div>

                    <div class="flex flex-wrap">
                        <label for="password-confirm" class="block mb-2 text-sm font-bold text-gray-700 sm:mb-4">
                            {{ __('Confirm Password') }}:
                        </label>

                        <input id="password-confirm" type="password" class="w-full form-input"
                            name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="flex flex-wrap">
                        <button type="submit"
                            class="w-full p-3 text-base font-bold leading-normal text-gray-100 no-underline whitespace-no-wrap bg-blue-500 rounded-lg select-none hover:bg-blue-700 sm:py-4">
                            {{ __('Register') }}
                        </button>

                        <p class="w-full my-6 text-xs text-center text-gray-700 sm:text-sm sm:my-8">
                            {{ __('Already have an account?') }}
                            <a class="text-blue-500 no-underline hover:text-blue-700 hover:underline" href="{{ route('login') }}">
                                {{ __('Login') }}
                            </a>
                        </p>
                    </div>
                </form>

            </section>
        </div>
    </div>
</main>
</x-app-layout>
