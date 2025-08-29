<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Company Info -->
                    <div class="mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $company->name }}</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Country:
                            <span class="font-medium">{{ $country }}</span>
                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Address: <span class="font-medium">{{ $company->address ?? '-' }}</span>
                        </p>
                    </div>

                    <hr class="my-6 border-gray-300 dark:border-gray-700">

                    <!-- Reports -->
                    <h2 class="text-2xl font-semibold mb-4">Available Reports</h2>

                    @if ($country === 'PH')
                        <div class="space-y-4">
                            @foreach ($reports as $type => $items)
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg shadow hover:shadow-md transition">
                                    <p class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-100">
                                        {{ $type }}
                                        <span class="text-sm text-gray-500">(Price: {{ $items->first()->price }})</span>
                                    </p>
                                    <ul class="space-y-2">
                                        @foreach ($items as $r)
                                            <li class="flex justify-between items-center bg-white dark:bg-gray-800 p-2 rounded-md border border-gray-200 dark:border-gray-600">
                                                <span class="text-sm">📅 Period: {{ $r->period_date }}</span>
                                                <form method="POST" action="{{ route('cart.add') }}">
                                                    @csrf
                                                    <input type="hidden" name="report" value="{{ $type }}">
                                                    <input type="hidden" name="price" value="{{ $r->price }}">
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm font-medium">
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Report</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Price</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach ($reports as $r)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="px-4 py-2 text-sm font-medium">
                                                {{ $r->name ?? ($r->type ?? 'Report') }}
                                            </td>
                                            <td class="px-4 py-2 text-sm">{{ $r->price }}</td>
                                            <td class="px-4 py-2">
                                                <form method="POST" action="{{ route('cart.add') }}">
                                                    @csrf
                                                    <input type="hidden" name="report" value="{{ $r->name ?? $r->type }}">
                                                    <input type="hidden" name="price" value="{{ $r->price }}">
                                                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm font-medium">
                                                        Add to Cart
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
