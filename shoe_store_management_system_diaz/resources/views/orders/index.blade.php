<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📦 Order Summary
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-700">All Orders</h3>
            <a href="{{ route('orders.create') }}"
               class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                + Create Order
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-green-200 text-black uppercase text-md">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Total Amount</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Update Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $order->user->name }}</td>
                        <td class="px-4 py-3">{{ $order->shoeProduct->name }}</td>
                        <td class="px-4 py-3">{{ $order->quantity }}</td>
                        <td class="px-4 py-3 font-semibold text-green-700">₱{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-3">{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            @if($order->status == 'Pending')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">Pending</span>
                            @elseif($order->status == 'Shipped')
                                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-medium">Shipped</span>
                            @else
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Delivered</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <form action="{{ route('orders.update', $order) }}" method="POST" class="flex gap-1">
                                @csrf
                                @method('PUT')
                                <select name="status" class="border border-gray-300 rounded px-2 py-1 text-xs w-1/2 cursor-pointer">
                                    <option value="Pending"   {{ $order->status == 'Pending'   ? 'selected' : '' }}>Pending</option>
                                    <option value="Shipped"   {{ $order->status == 'Shipped'   ? 'selected' : '' }}>Shipped</option>
                                    <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                                <button type="submit"
                                        class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700">
                                    Save
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-6 text-gray-400">No orders yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>