@extends('layouts.app')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .sharp { border-radius: 0 !important; }
        .star-on { color: #ffb200; }
        .star-off { color: #e0e0e0; }
        .pro-title { font-size: 1.13rem; font-weight: 700; color: #183153; }
        .pro-label { color:#009e86; font-weight: 600; font-size: .92rem;}
        @media (max-width: 1023px) {
            .product-grid { flex-direction: column !important; }
            .product-img-side, .product-info-side { height: auto !important; min-height: 300px !important;}
        }
    </style>
    <div class="w-full px-0 pt-20 pb-12 bg-[#f7fafd]">
        <div class="w-full max-w-[1200px] mx-auto flex product-grid gap-8 items-start">
            {{-- Product Image --}}
            <div class="lg:w-1/2 w-full flex items-stretch product-img-side" style="height:625px; min-height:625px;">
                <div class="shadow border border-emerald-100 sharp bg-white flex items-center justify-center w-full h-full overflow-hidden">
                    <img src="{{ $product->img }}" alt="{{ $product->name }}"
                         class="sharp"
                         style="height:100%; width:100%; padding: 40px">
                </div>
            </div>
            {{-- Product details and side boxes --}}
            <div class="lg:w-1/2 w-full flex flex-col gap-4 h-full product-info-side" style="height:540px; min-height:540px;">
                {{-- Quick Details --}}
                <div class="bg-white border border-gray-200 sharp p-5 flex flex-col gap-3 shadow">
                    <div>
                        <div class="flex items-center gap-2">
                            <h1 class="pro-title">{{ $product->name }}</h1>
                        </div>
                        <div class="flex items-center gap-1 my-1">
                            @php $avg = round($product->reviews()->avg('rating') ?? 0, 1); @endphp
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $avg ? 'star-on' : 'star-off' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-700 ml-1">({{ $product->reviews()->count() }} reviews)</span>
                        </div>
                        <div class="text-sm text-gray-700">{{ Str::limit($product->description, 80) }}</div>
                    </div>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="pro-label">Price:</span>
                        <span class="font-bold text-emerald-700 text-lg">{{ $product->price }} $</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="pro-label">Category:</span>
                        <span class="text-xs text-blue-800">{{ $product->slug }}</span>
                    </div>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mt-2 ajax-form">
                        @csrf
                        <button type="submit" class="sharp w-full py-3 bg-green-400 font-bold text-lg uppercase tracking-widest shadow hover:bg-white hover:text-green-500 transition border-2 border-green-400">
                            Add to Cart
                        </button>
                        <div class="add-cart-success text-green-600 text-xs mt-2" style="display:none;"></div>
                    </form>
                </div>
                {{-- Quick Features --}}
                <div class="bg-white border border-gray-200 sharp p-4 shadow flex-none">
                    <div class="font-bold text-emerald-700 mb-2">Quick Features:</div>
                    <ul class="list-disc pl-6 text-sm mb-1 text-gray-700">
                        <li>Fast shipping to all regions</li>
                        <li>14-day money-back guarantee</li>
                        <li>Live customer support</li>
                    </ul>
                    <a href="#reviews" class="text-blue-700 hover:underline text-xs">Show reviews ↓</a>
                </div>
                {{-- Full Product Details --}}
                <div class="bg-white border border-gray-200 sharp p-4 shadow flex-none">
                    <div class="pro-title mb-3 pb-1 w-fit" style="font-size: 1rem;">Product Details</div>
                    <div class="text-sm mb-3">{{ $product->description }}</div>
                    <table class="table-auto w-full sharp mt-1 text-sm">
                        <tbody>
                        <tr>
                            <th class="text-left py-1 pr-3 font-bold">Base Price</th>
                            <td class="py-1">{{ $product->price }} $</td>
                        </tr>
                        <tr>
                            <th class="text-left py-1 pr-3 font-bold">Category</th>
                            <td class="py-1">{{ $product->slug }}</td>
                        </tr>
                        {{-- Add more attributes if needed --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    <div class="w-full max-w-[1200px] mx-auto ">
        <div class="pro-title mb-4 text-xl">Related Products</div>
        <div id="related-products-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
            @foreach($relatedProducts->take(4) as $related)
                <div class="bg-white border border-gray-300 sharp shadow-sm flex flex-col h-full transition hover:shadow-md ">
                    <a href="{{ route('products.show', $related->id) }}">
                        {{-- Product thumbnail --}}
                        <div class="w-full h-80 overflow-hidden sharp border-b border-gray-200">
                            <img src="{{ $related->img }}" alt="{{ $related->name }}"
                                 class="w-full h-full p-10 sharp" />
                        </div>
                        <div class="flex-1 flex flex-col justify-between p-3 text-left">
                            <div>
                                <h3 class="font-bold text-lg mb-1 text-gray-900 truncate">{{ $related->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2 truncate">
                                    {{ Str::limit($related->description, 54) }}
                                </p>
                            </div>
                            <div class="font-bold text-base mb-2 text-black">
                                {{ $related->price }} $
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            {{-- Extra products hidden for "Show More" --}}
            @foreach($relatedProducts->slice(4) as $i => $related)
                <div class="bg-white border border-gray-300 sharp shadow-sm flex flex-col h-full transition hover:shadow-md" style="display: none;" data-extra-product>
                    <a href="{{ route('products.show', $related->id) }}">
                        <div class="w-full h-48 overflow-hidden sharp border-b border-gray-200">
                            <img src="{{ $related->img }}" alt="{{ $related->name }}"
                                 class="w-full h-full object-cover sharp" />
                        </div>
                        <div class="flex-1 flex flex-col justify-between p-3 text-left">
                            <div>
                                <h3 class="font-bold text-lg mb-1 text-gray-900 truncate">{{ $related->name }}</h3>
                                <p class="text-sm text-gray-600 mb-2 truncate">
                                    {{ Str::limit($related->description, 54) }}
                                </p>
                            </div>
                            <div class="font-bold text-base mb-2 text-black">
                                {{ $related->price }} $
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @if($relatedProducts->count() > 4)
            <div class="flex justify-center mt-4">
                <button id="show-more-products" class="sharp px-7 py-3 mt-10 bg-black text-white py-2 font-bold tracking-widest uppercase hover:bg-green-400 hover:text-black transition">
                    Show More Products
                </button>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    let btn = document.getElementById('show-more-products');
                    btn.addEventListener('click', function() {
                        document.querySelectorAll('[data-extra-product]').forEach(el => el.style.display = 'block');
                        btn.style.display = 'none';
                    });
                });
            </script>
        @endif
    </div>

    {{-- Add Review --}}
    <div id="reviews" class="w-full max-w-[900px] mx-auto mt-10">
        <div class="pro-title mb-2">Add Your Review</div>
        <div class="flex flex-col md:flex-row gap-6">
            <div class="w-full md:w-2/2 mb-6">
                @auth
                    <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="bg-white sharp shadow border border-emerald-100 p-3 flex flex-col gap-1 ajax-form">
                        @csrf
                        <span class="mb-1 font-bold text-emerald-700 text-sm">Your Rating:</span>
                        <div class="flex gap-1 mb-1 stars-rating-group">
                            @for($i=1; $i<=5; $i++)
                                <button type="button" class="focus:outline-none star-btn" data-rating="{{ $i }}">
                                    <svg class="w-6 h-6 star-off" fill="currentColor" viewBox="0 0 20 20">
                                        <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                    </svg>
                                </button>
                            @endfor
                            <input type="hidden" name="rating" value="0" class="rating-input">
                        </div>
                        <textarea name="comment" rows="2" class="border border-blue-100 sharp px-2 py-1 text-sm" placeholder="Write your review...">{{ old('comment') }}</textarea>
                        <button type="submit" class="p-3 shadow sharp w-fit bg-gradient-to-r from-blue-600 via-emerald-500 to-blue-700 hover:from-emerald-500 hover:to-blue-800 text-white font-semibold transition text-base">
                            Submit Review
                        </button>
                        <div class="ajax-success-message text-green-600 text-xs mt-2" style="display:none;"></div>
                    </form>
                @else
                    <div class="text-sm text-gray-500">Log in to leave a review!</div>
                @endauth
            </div>
        </div>
    </div>

    {{-- All Comments --}}
    <div class="w-full max-w-[900px] mx-auto mt-5">
        <div class="pro-title mb-2">All Comments</div>
        <div class="flex flex-col gap-4">
            @forelse($product->reviews->sortByDesc('created_at') as $review)
                <div class="bg-emerald-50 sharp p-2 border border-emerald-100 flex gap-2 items-start">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'User') }}&background=009e86&color=fff" class="w-7 h-7 sharp border">
                    <div>
                        <div class="font-bold text-emerald-800 mb-1 text-xs flex gap-2 items-center">
                            {{ $review->user->name ?? 'User' }}
                            <span class="text-gray-400 text-[.82rem]">({{ $review->created_at->format('Y/m/d') }})</span>
                        </div>
                        <div class="flex gap-0.5 mb-1">
                            @for($i=1; $i<=5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'star-on' : 'star-off' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                </svg>
                            @endfor
                        </div>
                        <div class="text-xs text-gray-800">{{ $review->comment }}</div>
                    </div>
                </div>
            @empty
                <div class="text-sm text-gray-400 text-center py-4">No reviews for this product yet.</div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <!-- jQuery AJAX for forms -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            // CSRF Setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // AJAX Forms (Cart & Review)
            $(function () {
                $('.ajax-form').on('submit', function(e) {
                    e.preventDefault();
                    var form = $(this);
                    var url = form.attr('action');
                    var data = form.serialize();

                    $.post(url, data, function(response){
                        // Cart form
                        if (form.find('.add-cart-success').length) {
                            form.find('.add-cart-success').text('Added to cart successfully!').fadeIn();
                            setTimeout(function(){ form.find('.add-cart-success').fadeOut(); }, 2000);
                            if(response.cart_count !== undefined){
                                $('#cart-count').text(response.cart_count);
                            }
                        }
                        // Review form
                        if (form.find('.ajax-success-message').length) {
                            form.find('.ajax-success-message').text('Review added successfully!').fadeIn();
                            setTimeout(function(){ form.find('.ajax-success-message').fadeOut(); }, 2000);
                            form[0].reset();
                            // OPTIONAL: يمكنك تحديث قائمة التعليقات هنا بدون تحديث الصفحة
                        }
                    }).fail(function(xhr){
                        if (form.find('.add-cart-success').length) {
                            form.find('.add-cart-success').text('Error adding to cart!').css('color','red').fadeIn();
                            setTimeout(function(){ form.find('.add-cart-success').fadeOut(); }, 2000);
                        }
                        if (form.find('.ajax-success-message').length) {
                            form.find('.ajax-success-message').text('Error adding review!').css('color','red').fadeIn();
                            setTimeout(function(){ form.find('.ajax-success-message').fadeOut(); }, 2000);
                        }
                    });
                });

                // Star rating click
                $(document).on('click', '.star-btn', function() {
                    let rating = $(this).data('rating');
                    $(this).closest('form').find('.rating-input').val(rating);
                    $(this).parent().find('svg').removeClass('star-on').addClass('star-off');
                    $(this).prevAll().addBack().find('svg').removeClass('star-off').addClass('star-on');
                });
            });
        </script>
@endpush
