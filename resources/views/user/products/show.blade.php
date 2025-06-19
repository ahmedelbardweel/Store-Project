@extends('layouts.app')
@section('content')
    <div class="container mx-auto max-w-5xl px-3 mt-10">
        {{-- ====== صف علوي: صورة المنتج + التقييمات ====== --}}
        <div class="flex flex-col md:flex-row gap-6 mb-8 min-h-[420px]">
            {{-- صورة المنتج (تملأ العمود بالكامل) --}}
            <div class="w-full md:w-2/3 flex">
                <div class="w-full h-[420px] md:h-[480px] lg:h-[540px] rounded-3xl shadow-xl border border-emerald-100 dark:border-gray-800 overflow-hidden flex">
                    <img src="{{ $product->img }}"
                         alt="{{ $product->name }}"
                         class="object-cover w-full h-full transition duration-300 hover:scale-105">
                </div>
            </div>
            {{-- بطاقة التقييمات في المساحة البيضاء على اليمين --}}
            <div class="w-full md:w-2/3 flex flex-col ">
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow border border-blue-100 dark:border-gray-800 p-3">
                    <h2 class="text-xl font-bold text-blue-700 dark:text-blue-300 mb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-yellow-400">star_rate</span>
                        آراء العملاء ({{ $product->reviews()->count() }})
                    </h2>
                    @php $avg = round($product->reviews()->avg('rating') ?? 0, 1); @endphp
                    {{-- معدل التقييم --}}
                    <div class="flex items-center gap-2 mb-4">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-6 h-6 {{ $i <= $avg ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20"><polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/></svg>
                            @endfor
                        </div>
                        <span class="text-gray-600 dark:text-gray-400 text-sm">({{ number_format($avg,1) }}/5)</span>
                    </div>
                    {{-- زر إضافة تقييم --}}
                    @auth
                        <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mb-4 flex flex-col gap-2">
                            @csrf
                            <div class="flex items-center gap-1">
                                <span class="text-gray-700 dark:text-gray-200 text-xs font-bold mr-1">تقييمك:</span>
                                <div class="flex gap-0.5">
                                    @for($i=1; $i<=5; $i++)
                                        <button name="rating" value="{{ $i }}" type="submit" class="focus:outline-none">
                                            <svg class="w-5 h-5 {{ old('rating', 5)==$i ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                            </svg>
                                        </button>
                                    @endfor
                                </div>
                            </div>
                            <textarea name="comment" rows="2" class="w-full rounded-xl border border-blue-100 dark:border-emerald-800 px-3 py-2 shadow text-sm mb-1" placeholder="اكتب تعليقك هنا...">{{ old('comment') }}</textarea>
                            <button type="submit"
                                    class="self-end mt-1 px-4 py-1 bg-blue-700 hover:bg-blue-500 text-white rounded-xl font-bold shadow transition text-xs">إرسال</button>
                            @error('comment') <div class="text-red-600 mt-1">{{ $message }}</div> @enderror
                        </form>
                    @endauth
                    {{-- آخر التعليقات (عدد 2 فقط للعرض السريع) --}}
                    <div class="space-y-4 max-h-48 overflow-y-auto">
                        @foreach($product->reviews->sortByDesc('created_at')->take(2) as $review)
                            <div class="flex items-start gap-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'عميل') }}&background=10b981&color=fff&rounded=true"
                                     class="w-7 h-7 rounded-full border-2 border-emerald-200 dark:border-emerald-700">
                                <div>
                                    <div class="flex items-center gap-1">
                                        <span class="font-bold text-emerald-800 dark:text-emerald-300 text-xs">{{ $review->user->name ?? 'عميل' }}</span>
                                        <span class="text-[10px] text-gray-500">({{ $review->created_at->format('Y/m/d') }})</span>
                                    </div>
                                    <div class="flex gap-0.5 mb-1">
                                        @for($i=1; $i<=5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20">
                                                <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <div class="text-gray-800 dark:text-gray-100 text-xs leading-relaxed">{{ $review->comment }}</div>
                                </div>
                            </div>
                        @endforeach
                        @if($product->reviews->count() > 2)
                            <div class="mt-2 text-center">
                                <a href="#all-reviews" class="text-blue-600 text-xs hover:underline">عرض جميع الآراء ↓</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- تفاصيل المنتج تحت الصورة والتقييمات --}}
        <div class="bg-white/95 dark:bg-gray-900/80 rounded-3xl shadow-2xl border border-emerald-100 dark:border-gray-800 mt-6 p-6 flex flex-col md:flex-row gap-6">
            {{-- وصف المنتج + جدول --}}
            <div class="w-full md:w-2/3 flex flex-col gap-2">
                <h2 class="text-lg font-bold text-emerald-700 mb-1 flex items-center gap-2">
                    <span class="material-symbols-outlined text-emerald-400">description</span>
                    وصف المنتج كامل
                </h2>
                <div class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed mb-3">
                    {{ $product->description }}
                </div>
                {{-- جدول المواصفات --}}
                <div class="overflow-x-auto mt-2">
                    <table class="min-w-max bg-white dark:bg-gray-900 rounded-xl shadow-sm text-sm">
                        <tbody>
                        <tr>
                            <td class="py-2 px-2 font-bold text-gray-600 dark:text-gray-400">السعر الأساسي</td>
                            <td class="py-2 px-2">{{ $product->price }} $</td>
                        </tr>
                        <tr>
                            <td class="py-2 px-2 font-bold text-gray-600 dark:text-gray-400">الفئة</td>
                            <td class="py-2 px-2">{{ $product->slug }}</td>
                        </tr>
                        {{-- أضف مواصفات أخرى هنا --}}
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- زر السلة + خصائص أخرى مستقبلاً --}}
            <div class="w-full md:w-1/3 flex flex-col gap-3">
                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit" class="w-full px-6 py-3 bg-blue-700 from-emerald-500 via-blue-500 to-blue-700 hover:from-blue-600 hover:to-emerald-700 text-white font-bold rounded-xl shadow-lg text-lg transition">
                        أضف للسلة 🛒
                    </button>
                </form>
            </div>
        </div>

        {{-- جميع التقييمات بشكل منفصل --}}
        <div id="all-reviews" class="my-12">
            <h2 class="text-2xl font-bold text-blue-700 dark:text-blue-200 mb-6">كل آراء العملاء</h2>
            <div class="space-y-4">
                @forelse($product->reviews->sortByDesc('created_at') as $review)
                    <div class="flex items-start bg-emerald-50 dark:bg-emerald-900 rounded-xl shadow-sm p-3 gap-2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'عميل') }}&background=10b981&color=fff&rounded=true"
                             class="w-7 h-7 rounded-full border-2 border-emerald-200 dark:border-emerald-700">
                        <div class="flex-1">
                            <div class="flex items-center gap-1">
                                <span class="font-bold text-emerald-800 dark:text-emerald-300 text-sm">{{ $review->user->name ?? 'عميل' }}</span>
                                <span class="text-xs text-gray-500">({{ $review->created_at->format('Y/m/d') }})</span>
                                <div class="flex gap-0.5 ml-auto">
                                    @for($i=1; $i<=5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-700' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                            <div class="text-gray-800 dark:text-gray-100 text-xs leading-relaxed mt-1">{{ $review->comment }}</div>

                            @if($review->admin_reply)
                                <div class="mt-2 ml-4 px-4 py-3 bg-blue-50 dark:bg-blue-900/60 border-l-4 border-blue-400 rounded-xl flex items-start gap-2 shadow-sm">
                                    <span class="material-symbols-outlined text-blue-700 dark:text-blue-300 mt-1">reply</span>
                                    <div>
                                        <div class="font-bold text-blue-700 dark:text-blue-200 text-xs mb-1">رد الإدارة</div>
                                        <div class="text-gray-700 dark:text-gray-100 text-xs leading-relaxed">{{ $review->admin_reply }}</div>

                                        {{-- ========== نموذج رد المستخدم على رد الإدارة ========== --}}
                                        @auth
                                            @if(!$review->user_reply_to_admin && Auth::id() == $review->user_id)
                                                <form action="{{ route('reviews.userReply', $review->id) }}" method="POST" class="mt-2 flex gap-2">
                                                    @csrf
                                                    <input type="text" name="user_reply_to_admin" placeholder="ردك على الإدارة..." class="w-full px-2 py-1 rounded text-xs border border-gray-300 dark:border-gray-700">
                                                    <button type="submit" class="bg-blue-600 hover:bg-blue-800 text-white px-3 py-1 rounded text-xs font-bold">إرسال</button>
                                                </form>
                                            @elseif($review->user_reply_to_admin)
                                                <div class="mt-2 px-3 py-2 bg-gray-50 dark:bg-emerald-800/30 rounded-xl text-xs text-gray-800 dark:text-gray-200 border-l-4 border-emerald-400">
                                                    <span class="font-bold text-emerald-700 dark:text-emerald-200">رد العميل:</span> {{ $review->user_reply_to_admin }}
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="text-gray-400 text-center py-7 text-xs">لا توجد تعليقات لهذا المنتج بعد.</div>
                @endforelse

            </div>
        </div>
    </div>
@endsection
