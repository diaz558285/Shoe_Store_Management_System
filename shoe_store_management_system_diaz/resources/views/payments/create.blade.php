<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            💳 Process Payment
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-2xl mx-auto">
        <div class="bg-white rounded shadow p-6">

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Order</label>
                    <select name="order_id" id="orderSelect"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                            onchange="updateOrderInfo()">
                        <option value="">-- Choose an Order --</option>
                        @foreach($orders as $order)
                            <option value="{{ $order->id }}"
                                    data-total="{{ $order->total_amount }}"
                                    {{ old('order_id') == $order->id ? 'selected' : '' }}>
                                Order #{{ $order->id }} — {{ $order->user->name }} — {{ $order->shoeProduct->name }} — ₱{{ number_format($order->total_amount, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('order_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4 bg-gray-50 border border-gray-200 rounded p-3">
                    <p class="text-xs text-gray-500">Total Order:</p>
                    <p class="text-lg font-bold text-gray-800" id="orderTotal">₱0.00</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Amount Paid (₱)</label>
                    <input type="number" name="amount_paid" id="amountPaid" step="0.01" min="0"
                           value="{{ old('amount_paid', 0) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-400"
                           oninput="updateBalance()">
                    @error('amount_paid') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6 bg-purple-50 border border-purple-200 rounded p-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="text-xs text-gray-500">Remaining Balance:</p>
                            <p class="text-xl font-bold text-purple-600" id="balanceDisplay">₱0.00</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500">Payment Status:</p>
                            <p class="text-xl font-bold" id="statusDisplay">—</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700">
                        Record Payment
                    </button>
                    <a href="{{ route('payments.index') }}"
                       class="bg-gray-200 text-black px-6 py-2 rounded hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

    <script>
        function updateOrderInfo() {
            const select = document.getElementById('orderSelect');
            const selectedOption = select.options[select.selectedIndex];
            const total = parseFloat(selectedOption.getAttribute('data-total')) || 0;

            document.getElementById('orderTotal').textContent = '₱' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
            updateBalance();
        }

        function updateBalance() {
            const select = document.getElementById('orderSelect');
            const selectedOption = select.options[select.selectedIndex];
            const total = parseFloat(selectedOption.getAttribute('data-total')) || 0;
            const paid  = parseFloat(document.getElementById('amountPaid').value) || 0;

            const balance = total - paid;

            // Displays the balance
            document.getElementById('balanceDisplay').textContent =
                '₱' + Math.max(balance, 0).toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // Show status
            const statusEl = document.getElementById('statusDisplay');
            if (paid <= 0) {
                statusEl.textContent = 'Unpaid';
                statusEl.className   = 'text-xl font-bold text-red-600';
            } else if (balance > 0) {
                statusEl.textContent = 'Partial';
                statusEl.className   = 'text-xl font-bold text-yellow-600';
            } else {
                statusEl.textContent = 'Paid ✓';
                statusEl.className   = 'text-xl font-bold text-green-600';
            }
        }
    </script>
</x-app-layout>