<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("We sell ammunition!") }}
                    @if ($user->type == 'admin')
                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="mt-3 flex flex-col">
                        @csrf
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror text-black" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end mt-1">
                            <label class="text-black dark:text-white" for="description">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror text-black" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Price:</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror text-black" id="price" name="price" value="{{ old('price') }}">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Round description:</label>
                            <input type="text" class="form-control @error('round_desc') is-invalid @enderror text-black" id="round_desc" name="round_desc" value="{{ old('round_desc') }}">
                            @error('round_desc')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Caliber:</label>
                            <input type="text" class="form-control @error('caliber') is-invalid @enderror text-black" id="caliber" name="caliber" value="{{ old('caliber') }}">
                            @error('caliber')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Mass:</label>
                            <input type="text" class="form-control @error('mass') is-invalid @enderror text-black" id="mass" name="mass" value="{{ old('mass') }}">
                            @error('mass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Explosive type:</label>
                            <input type="text" class="form-control @error('explosive_type') is-invalid @enderror text-black" id="explosive_type" name="explosive_type" value="{{ old('explosive_type') }}">
                            @error('explosive_type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Explosive mass:</label>
                            <input type="text" class="form-control @error('explosive_mass') is-invalid @enderror text-black" id="explosive_mass" name="explosive_mass" value="{{ old('explosive_mass') }}">
                            @error('explosive_mass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">TNT equivalent:</label>
                            <input type="text" class="form-control @error('tnt') is-invalid @enderror text-black" id="tnt" name="tnt" value="{{ old('tnt') }}">
                            @error('tnt')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Fuze distance:</label>
                            <input type="text" class="form-control @error('fuze') is-invalid @enderror text-black" id="fuze" name="fuze" value="{{ old('fuze') }}">
                            @error('fuze')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group flex justify-end">
                            <label class="text-black dark:text-white" for="title">Penetration:</label>
                            <input type="text" class="form-control @error('pen') is-invalid @enderror text-black" id="pen" name="pen" value="{{ old('pen') }}">
                            @error('pen')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="flex justify-end mt-2">
                            <button type="submit" class="btn btn-primary text-black dark:text-white bg-green-500">Create Item</button>
                        </div>
                    </form>
                    @endif

                    <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-sm sm:rounded-lg mt-3 p-3">
                        {{ __("Shopping cart") }}
                        @foreach($carts as $cart)
                        @if($cart->user == $user->id)
                        <div class="p-3 bg-gray-900 dark:bg-gray-600 w-auto min-h-12 h-auto rounded-lg m-2">
                            <div class="flex flex-row justify-between">
                                <div>
                                    {{ App\Http\Controllers\CartController::formatCartItem($cart->items) }}
                                </div>

                                <form action="{{ route('cart.edit', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="number" id="quantity" name="quantity" min="0" max="20" class="text-black h-8 rounded-md" value="{{ App\Http\Controllers\CartController::getQuantityOnly($cart->items) }}">
                                    <button type="submit" id="add-item" class="btn btn-primary text-black dark:text-white bg-green-500 h-8 px-2 rounded-md">Change quantity</button>
                                </form>  

                                <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button text-black dark:text-white bg-red-500 rounded-md" onclick="return confirm('Are you sure you want to delete this cart item?')">Delete Cart Item</button>
                                </form>
                            </div>
                        </div>
                        @endif
                        @endforeach

                        <a href="{{ url('/payment') }}" class="btn btn-primary text-black dark:text-white bg-green-500 h-8 p-1 rounded-md">Payment</a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-3">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($items as $item)
                    <div class="p-3 bg-gray-800 dark:bg-gray-700 w-auto min-h-12 h-auto rounded-lg m-3">
                        <div class="flex flex-row justify-between">
                            <div>
                                Product name: {{ $item->name }}
                            </div>
                            <div>
                                <p class="font-bold">{{ $item->price }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div>
                                <p class="text-gray-400">{{ $item->description }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">{{ $item->round_desc }}</p>
                            </div>
                            <div class="h-4"></div>
                        </div>
                        <div class="flex flex-row justify-between">
                            Caliber<p class="text-gray-400">{{ $item->caliber }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            Mass<p class="text-gray-400">{{ $item->mass }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            Explosive type<p class="text-gray-400">{{ $item->explosive_type }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            Explosive mass<p class="text-gray-400">{{ $item->explosive_mass }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            TNT equivalent<p class="text-gray-400">{{ $item->tnt }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            Fuze sensitivity<p class="text-gray-400">{{ $item->fuze }}</p>
                        </div>
                        <div class="flex flex-row justify-between">
                            Penetration<p class="text-gray-400">{{ $item->pen }}</p>
                        </div>


                        <div class="flex mt-6">
                            <div>
                                <label for="quantity">Quantity (max 20)</label>
                            </div>

                            <div>
                                <form class="ml-1" action="{{ route('cart.store', $item->id, $user->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="number" id="quantity" name="quantity" min="0" max="20" class="text-black h-8 rounded-md" value="0">
                                    <button type="submit" id="add-item" class="btn btn-primary text-black dark:text-white bg-green-500 h-8 px-2 rounded-md">Add to shopping cart</button>
                                </form>  
                            </div>
                        </div>

                        @if($user->type == 'admin')
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button text-black dark:text-white bg-red-500 mt-2" onclick="return confirm('Are you sure you want to delete this post?')">Delete Post</button>
                        </form>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>