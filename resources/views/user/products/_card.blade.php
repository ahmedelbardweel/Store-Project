<div x-data
     class="relative bg-white/90 dark:bg-gray-800/90 flex flex-col group transition-all duration-200 border border-green-200 dark:border-gray-700"
     style="border-radius:0"
     @click="window.location.href='{{ route('products.show', $product->id) }}'">

    {{-- Product image or placeholder --}}
    <div class="relative mb-3">
        @if($product->img)
            <img src="{{ $product->img }}"
                 alt="{{ $product->name }}"
                 class="h-100 p-10 w-full border border-gray-100 dark:border-gray-700 shadow-sm transition-all group-hover:scale-105 duration-300"
                 style="border-radius:0">
        @else
            <div class="h-80 w-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-emerald-100 dark:from-gray-700 dark:to-gray-900 border border-gray-100 dark:border-gray-700"
                 style="border-radius:0">
                <span class="text-gray-400 dark:text-gray-500 font-semibold">No photo available</span>
            </div>
        @endif
    </div>

    {{-- Card content --}}
    <div class="flex flex-col flex-1 justify-between p-4">
        <div>
            <h3 class="text-lg font-bold mb-1 text-gray-800 dark:text-gray-100 truncate">
                {{ $product->name }}
            </h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                {{ Str::limit($product->description, 70) }}
            </p>
        </div>
        <div class="flex flex-col gap-2 mt-2">
            <span class="block text-emerald-600 dark:text-emerald-300 text-lg font-semibold mb-1">
                Price: {{ $product->price }}$
            </span>
            <form class="add-to-cart-form" action="{{ route('cart.add', $product->id) }}" method="POST" @click.stop>
                @csrf
                <button type="submit"
                        class="w-full px-5 py-2 bg-green-400 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400 "
                        style="border-radius:0">
                    Add to Cart
                </button>
                <div class="add-cart-success text-green-600 text-xs mt-2" style="display:none;"></div>
            </form>
        </div>
    </div>
</div>

{{-- Ajax Script --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function () {
        $('.add-to-cart-form').on('submit', function(e) {
            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var data = form.serialize();

            $.post(url, data, function(response){
                form.find('.add-cart-success').text('Added to cart successfully!').fadeIn();
                setTimeout(function(){
                    form.find('.add-cart-success').fadeOut();
                }, 2000);
                // Update cart count if exists
                if(response.cart_count !== undefined){
                    $('#cart-count').text(response.cart_count);
                }
            }).fail(function(xhr){
                form.find('.add-cart-success').text('Plaece, LogIn To WebPage!').css('color','red').fadeIn();
                setTimeout(function(){
                    form.find('.add-cart-success').fadeOut();
                }, 2000);
            });
        });
    });
</script>
