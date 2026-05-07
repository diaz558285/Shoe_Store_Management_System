<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🛒 Create New Order
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-2xl mx-auto">
        <div class="bg-white rounded shadow p-6">

            <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Select Shoe Product</label>
                    <select name="shoe_product_id" id="shoeSelect"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                            onchange="updateTotal()">
                        <option value="">-- Choose a Shoe --</option>
                        @foreach($shoes as $shoe)
                            <option value="{{ $shoe->id }}"
                                    data-price="{{ $shoe->price }}"
                                    {{ old('shoe_product_id') == $shoe->id ? 'selected' : '' }}>
                                    {{ $shoe->product_name }} ({{ $shoe->brand }}) — ₱{{ number_format($shoe->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('shoe_product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1"
                           class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                           onchange="updateTotal()" oninput="updateTotal()">
                    @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-6 bg-green-50 border border-green-200 rounded p-4">
                    <p class="text-sm text-gray-600">Estimated Total Amount:</p>
                    <p class="text-2xl font-bold text-green-700" id="totalDisplay">₱0.00</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                            class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                        Place Order
                    </button>
                    <a href="{{ route('orders.index') }}"
                       class="bg-gray-200 text-black px-6 py-2 rounded hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>


    <script>
        function updateTotal() {
            const select = document.getElementById('shoeSelect');
            const qty    = parseFloat(document.getElementById('quantity').value) || 0;

            // Get the price from the selected option's data-price attribute
            const selectedOption = select.options[select.selectedIndex];
            const price = parseFloat(selectedOption.getAttribute('data-price')) || 0;

            const total = qty * price;
            document.getElementById('totalDisplay').textContent = '₱' + total.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    </script>
</x-app-layout>