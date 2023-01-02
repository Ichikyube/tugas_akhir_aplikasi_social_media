<x-app-layout>
<div class="flex flex-col">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col justify-around h-full">
            <div>
                <h1 class="mb-6 text-4xl font-light tracking-wider text-center text-gray-600 sm:mb-8 sm:text-6xl">
                    {{ config('app.name', 'Laravel') }}
                </h1>
                <ul class="flex flex-col space-y-2 sm:flex-row sm:flex-wrap sm:space-x-8 sm:space-y-0">
                    <li>
                        <a href="https://laravel.com/docs" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Documentation">Documentation</a>
                    </li>
                    <li>
                        <a href="https://laracasts.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Laracasts">Laracasts</a>
                    </li>
                    <li>
                        <a href="https://laravel-news.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="News">News</a>
                    </li>
                    <li>
                        <a href="https://nova.laravel.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Nova">Nova</a>
                    </li>
                    <li>
                        <a href="https://forge.laravel.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Forge">Forge</a>
                    </li>
                    <li>
                        <a href="https://vapor.laravel.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Vapor">Vapor</a>
                    </li>
                    <li>
                        <a href="https://github.com/laravel/laravel" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="GitHub">GitHub</a>
                    </li>
                    <li>
                        <a href="https://tailwindcss.com" class="text-sm font-normal text-teal-800 no-underline uppercase hover:underline" title="Tailwind Css">Tailwind CSS</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
