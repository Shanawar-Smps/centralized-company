<form method="GET" action="{{ route('companies.search') }}" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow mb-6 flex items-center gap-3">
    <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="🔍 Search for a company..."
        class="flex-1 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none dark:bg-gray-900 dark:text-gray-200"
    >
    <button
        type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition font-medium"
    >
        Search
    </button>
</form>

@if (!empty($results))
    <div class="space-y-8">
        @foreach ($results as $country => $companies)
            <div>
                <h2 class="font-bold text-xl text-gray-800 dark:text-gray-100 mb-3 flex items-center gap-2">
                    🌍 {{ $country }}
                </h2>

                <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Slug</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($companies as $c)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                    <td class="px-4 py-2">
                                        <a href="{{ route('companies.show', ['country' => $country, 'id' => $c->id]) }}"
                                           class="text-blue-600 dark:text-blue-400 font-medium hover:underline">
                                           {{ $c->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $c->slug ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
@elseif(request()->has('q'))
    <p class="mt-6 text-gray-600 dark:text-gray-300 italic">No results found for <strong>"{{ request('q') }}"</strong>.</p>
@endif
