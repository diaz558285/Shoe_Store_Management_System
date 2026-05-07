<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-black text-lg">
                    <em>Welcome to your dashboard! Here you can manage your shoe inventory, process orders, and track payments.</em>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">

                    <div class="bg-white rounded-2xl shadow-md p-6 border hover:shadow-xl transition">
                        <h3 class="text-xl font-bold mb-3">Manage Shoe Inventory</h3>
                        <p class="text-gray-600 mb-4">
                            Add, update, and manage shoe products in your inventory.
                        </p>

                        <a href="{{ route('shoes.index') }}"
                            class="inline-block bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg">
                            Open
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md p-6 border hover:shadow-xl transition">
                        <h3 class="text-xl font-bold mb-3">Process Orders</h3>
                        <p class="text-gray-600 mb-4">
                            View customer orders and manage order processing.
                        </p>

                        <a href="{{ route('orders.index') }}"
                        class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">
                            Open
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-md p-6 border hover:shadow-xl transition">
                        <h3 class="text-xl font-bold mb-3">Track Payments</h3>
                        <p class="text-gray-600 mb-4">
                            Monitor and verify payment transactions.
                        </p>

                        <a href="{{ route('payments.index') }}"
                        class="inline-block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg">
                            Open
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
