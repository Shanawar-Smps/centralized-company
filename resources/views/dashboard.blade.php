<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Search') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- 🔍 Search Form -->
                    <form method="GET" action="{{ route('dashboard') }}" class="mb-6 flex space-x-2">
                        <input type="text" name="q" placeholder="Search companies..."
                            value="{{ request('q') }}"
                            class="border rounded-lg px-4 py-2 w-1/2 text-gray-900 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                            Search
                        </button>
                    </form>

                    <!-- 📊 Results -->
                    @if(!empty($results))
                        <div class="mt-6">
                            @foreach($results as $country => $companies)
                                <h2 class="font-bold text-xl mt-6 mb-2 text-gray-800 dark:text-gray-200">
                                    {{ $country }}
                                </h2>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 rounded-lg shadow">
                                        <thead class="bg-gray-100 dark:bg-gray-700">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                    Company Name
                                                </th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                                                    Slug
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($companies as $c)
                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                                    <td class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100">
                                                        <a href="{{ route('companies.show', ['country' => $country, 'id' => $c->id]) }}"
                                                           class="text-blue-600 dark:text-blue-400 hover:underline">
                                                            {{ $c->name }}
                                                        </a>
                                                    </td>
                                                    <td class="px-6 py-3 text-sm text-gray-600 dark:text-gray-300">
                                                        {{ $c->slug ?? '-' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
