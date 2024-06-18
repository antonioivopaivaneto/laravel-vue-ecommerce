<x-app-layout>
    <div class="container lg:w-2/3 xl:w-2/3 mx-auto">
        <h1 class="text-3xl font-bold mb-6">Order #{{ $order->id }} Details</h1>

        <div class="bg-white p-3 rounded-md shadow-md">
            <div>
                <table class="table-sm">
                    <tbody>
                        <tr>
                            <td class="font-bold">Order #</td>
                            <td>{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Order Date</td>
                            <td>{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td class="font-bold">Status</td>
                            <td>
                                <span
                                    class=" text-white p-1 rounded {{ $order->isPaid() ? 'bg-emerald-500' : 'bg-gray-500' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-bold">SubTotal</td>
                            <td>R${{ $order->total_price }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <hr class="my-5" />

            @foreach ($order->items as $item)
                <!-- Product Item -->
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="w-36 h-32 flex items-center justify-center overflow-hidden">
                        <a href="{{route('product.view',$item->product )}}"
                        class="w-36 h-32 flex items-center justify-center overflow-hidden">
                        <img src="{{ $item->product->image }}" class="object-cover" alt="" />
                    </a>
                    </div>
                    <div class="flex-1 flex flex-col justify-between ">
                        <h3 class="text-ellipsis mb-4">
                            {{ $item->product->title }}
                        </h3>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                Qty: {{ $item->quantity }}
                            </div>
                            <div class="flex items-end">
                                <span class="text-lg font-semibold">${{ $item->unit_price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Product Item -->
                <hr class="my-2" />
                <!-- Product Item -->
            @endforeach

            @if (!$order->isPaid())

                  <form action="{{route('cart.checkout-order',$order)}}" method="Post">
                    @csrf


            <div class=" border-gray-300 pt-4">
                <button type="submit" class="btn-primary flex justify-center items-center w-full py-3 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Make payment
                </button>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
