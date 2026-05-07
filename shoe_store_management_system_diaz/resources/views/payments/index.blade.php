<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💳 Payment History
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-700">All Transactions</h3>
            <a href="{{ route('payments.create') }}"
               class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                + Process Payment
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-purple-200 text-black uppercase text-md">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Order Total</th>
                        <th class="px-4 py-3">Amount Paid</th>
                        <th class="px-4 py-3">Balance</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $payment->order->user->name }}</td>
                        <td class="px-4 py-3">₱{{ number_format($payment->order->total_amount, 2) }}</td>
                        <td class="px-4 py-3 text-green-700 font-semibold">₱{{ number_format($payment->amount_paid, 2) }}</td>
                        <td class="px-4 py-3 text-red-600">₱{{ number_format($payment->balance, 2) }}</td>
                        <td class="px-4 py-3">
                            {{-- Color-coded payment status badge --}}
                            @if($payment->status == 'Paid')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium">Paid</span>
                            @elseif($payment->status == 'Partial')
                                <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-medium">Partial</span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-medium">Unpaid</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $payment->created_at->format('M d, Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-400">No payment records yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>