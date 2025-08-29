<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            🛒 {{ __('My Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg shadow-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <span>🧾 Cart Summary</span>
                    </h1>

                    @if(count($cart) > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
                                <thead class="bg-gray-100 dark:bg-gray-700">
                                    <tr>
                                        <th class="border px-4 py-2 text-left text-sm font-semibold">Report</th>
                                        <th class="border px-4 py-2 text-left text-sm font-semibold">Price</th>
                                        <th class="border px-4 py-2 text-center text-sm font-semibold">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($cart as $index => $item)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition">
                                            <td class="px-4 py-2 text-sm font-medium">{{ $item['report'] }}</td>
                                            <td class="px-4 py-2 text-sm">💲{{ number_format($item['price'], 2) }}</td>
                                            <td class="px-4 py-2 text-center">
                                                <a href="{{ route('cart.remove', $index) }}"
                                                   class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg shadow hover:bg-red-600 transition">
                                                    ✖ Remove
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Total Section -->
                        <div class="mt-6 flex justify-between items-center">
                            <p class="font-bold text-xl">Total: 💲{{ number_format($total, 2) }}</p>

                            <button class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2 rounded-lg shadow transition">
                                Proceed to Checkout →
                            </button>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <p class="text-lg font-semibold text-gray-600 dark:text-gray-300">Your cart is empty 🛒</p>
                            <a href="{{ route('dashboard') }}"
                               class="mt-4 inline-block px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                                Browse Companies →
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
