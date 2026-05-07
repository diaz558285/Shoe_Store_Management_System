<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👟 Shoe Products
        </h2>
    </x-slot>

    <div class="py-8 px-6 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 flex justify-between items-center">
            <h3 class="text-lg font-bold text-gray-700">All Shoes</h3>
            <a href="{{ route('shoes.create') }}"
               class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">
                + Add Shoe
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full text-sm text-left">
                <thead class="text-black uppercase text-md bg-pink-200">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Product Name</th>
                        <th class="px-4 py-3">Brand</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Size</th>
                        <th class="px-4 py-3">Color</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($shoes as $shoe)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium">{{ $shoe->product_name }}</td>
                        <td class="px-4 py-3">{{ $shoe->brand }}</td>
                        <td class="px-4 py-3">{{ $shoe->category }}</td>
                        <td class="px-4 py-3">{{ $shoe->size }}</td>
                        <td class="px-4 py-3">{{ $shoe->color }}</td>
                        <td class="px-4 py-3">{{ $shoe->stock_quantity }}</td>
                        <td class="px-4 py-3">₱{{ number_format($shoe->price, 2) }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('shoes.edit', $shoe) }}"
                               class="bg-yellow-400 text-white px-3 py-1 rounded text-xs hover:bg-yellow-500">
                                Edit
                            </a>
                            <form action="{{ route('shoes.destroy', $shoe) }}" method="POST"
                                  onsubmit="return confirm('Delete this shoe?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-6 text-gray-400">No shoes found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>