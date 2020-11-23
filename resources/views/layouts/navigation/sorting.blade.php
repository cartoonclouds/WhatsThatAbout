<nav class="flex flex-row place-content-end p-4 bg-gray-200">
    <a class="px-3 py-2 rounded-md text-sm font-medium text-gray-900" href="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}">Popular</a>

    <a class="px-3 py-2 rounded-md text-sm font-medium text-gray-900" href="{{ request()->fullUrlWithQuery(['sort' => 'date_low']) }}">Date (low)</a>

    <a class="px-3 py-2 rounded-md text-sm font-medium text-gray-900" href="{{ request()->fullUrlWithQuery(['sort' => 'date_high']) }}">Date (high)</a>
</nav>
