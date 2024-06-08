<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __('We sell ammunition!') }}
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($carts as $cart)
                        @if($cart->user == $user->id)
                            <div class="p-3 bg-gray-900 dark:bg-gray-600 w-auto min-h-12 h-auto rounded-lg m-2">
                                <div class="flex flex-row justify-between">
                                    <div>
                                        {{ App\Http\Controllers\CartController::formatCartItem($cart->items) }}
                                    </div>

                                    <form action="{{ route('cart.edit', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="number" id="quantity" name="quantity" min="0" max="20"
                                            class="text-black h-8 rounded-md"
                                            value="{{ App\Http\Controllers\CartController::getQuantityOnly($cart->items) }}">
                                        <button type="submit" id="add-item"
                                            class="btn btn-primary text-black dark:text-white bg-green-500 h-8 px-2 rounded-md">Change
                                            quantity</button>
                                    </form>

                                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="button text-black dark:text-white bg-red-500 rounded-md"
                                            onclick="return confirm('Are you sure you want to delete this cart item?')">Delete
                                            Cart Item</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <div class="mt-3 text-xl">
                        {{ __('Total price: ') }}
                        {{ App\Http\Controllers\CartController::getTotalPrice() }}.00€
                    </div>

                    <form class="ml-1 mt-4" action="{{ route('payment.store') }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <div class="form-group flex">
                            <label class="text-black dark:text-white" for="title">First name:</label>
                            <input type="text" class="form-control @error('firstName') is-invalid @enderror text-black" id="firstName" name="firstName" value="{{ old('firstName') }}">
                            @error('firstName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group flex">
                            <label class="text-black dark:text-white" for="title">Last name:</label>
                            <input type="text" class="form-control @error('lastName') is-invalid @enderror text-black" id="lastName" name="lastName" value="{{ old('lastName') }}">
                            @error('lastName')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group flex">
                            <label class="text-black dark:text-white" for="title">Email:</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror text-black" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group flex">
                            <label class="text-black dark:text-white" for="title">Phone number:</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror text-black" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-5 text-2xl">
                            {{ __('SEND THE AMOUNT OF € LISTED ABOVE TO') }}
                        </div>
                        <div>
                            {{ __('KRISTO TÄNAK') }}
                        </div>
                        <div class="mb-5">
                            {{ __('EE602200221086673612') }}
                        </div>

                        <button type="submit" id="add-item"
                            class="mt-2 btn btn-primary text-black dark:text-white bg-green-500 h-20 w-48 px-2 rounded-md"  onclick="return confirm('Your cart will be emptied and items will be shipped after it has been confirmed that money has been sent.')">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
