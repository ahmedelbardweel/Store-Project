@extends('layouts.admin')
@section('content')
    <h1 class="text-2xl font-black mb-8">All Customer Reviews</h1>
    <div class="space-y-7">
        @foreach($reviews as $r)
            <div class="bg-white dark:bg-gray-900 rounded-none shadow border border-emerald-100 dark:border-gray-800 p-5 flex gap-6">
                {{-- Product Image --}}
                <div class="w-24 flex-shrink-0 flex flex-col items-center">
                    <img src="{{ $r->product->img ?? '' }}"
                         alt="{{ $r->product->name ?? '' }}"
                         class=" h-20 mb-1 border border-emerald-100">
                    <span class="text-xs text-gray-600 dark:text-gray-400 text-center">{{ $r->product->name ?? '-' }}</span>
                </div>
                {{-- Conversation --}}
                <div class="flex-1 flex flex-col gap-3">
                    {{-- Original Review --}}
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($r->user->name ?? 'User') }}&background=10b981&color=fff&rounded=true"
                             class="w-8 h-8 rounded-none border-2 border-emerald-200 dark:border-emerald-700">
                        <div>
                            <div class="font-bold text-emerald-800 dark:text-emerald-300 text-xs">{{ $r->user->name ?? 'User' }}</div>
                            <div class="flex items-center gap-1">
                                @for($i=1;$i<=5;$i++)
                                    <svg class="w-4 h-4 {{ $i <= $r->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <polygon points="10 2 12.39 7.68 18.51 7.98 13.66 12.07 15.25 18.02 10 14.77 4.75 18.02 6.34 12.07 1.49 7.98 7.61 7.68 10 2"/>
                                    </svg>
                                @endfor
                                <span class="text-gray-400 text-xs ml-2">{{ $r->created_at->format('Y-m-d') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="ml-11 text-sm text-gray-800 dark:text-gray-100 mb-1">{{ $r->comment }}</div>
                    {{-- Admin Reply --}}
                    @if($r->admin_reply)
                        <div class="flex items-start gap-2 ml-10">
                            <img src="https://ui-avatars.com/api/?name=Admin&background=2563eb&color=fff&rounded=true"
                                 class="w-8 h-8 rounded-none border-2 border-blue-200 dark:border-blue-700 mt-1">
                            <div>
                                <div class="font-bold text-blue-700 dark:text-blue-300 text-xs mb-1">Admin Reply</div>
                                <div class="bg-blue-50 dark:bg-blue-900/30 rounded-none px-3 py-2 text-xs text-blue-800 dark:text-blue-100">{{ $r->admin_reply }}</div>
                                <div class="text-xs text-gray-400 mt-1">{{ $r->admin_reply_created_at ? \Carbon\Carbon::parse($r->admin_reply_created_at)->format('Y-m-d') : '' }}</div>
                            </div>
                        </div>
                    @elseif(auth()->user()?->role === 'admin')
                        {{-- Admin Reply Button --}}
                        <form id="reply-form-{{ $r->id }}" action="{{ route('admin.replies.store', $r) }}" method="POST" class="flex items-center gap-2 mt-2 ml-10">
                            @csrf
                            <input type="text" name="reply" placeholder="Reply to the review..." class="border rounded-none px-2 py-1 text-xs w-40">
                            <button type="submit" class="text-sm bg-blue-600 text-white rounded-none px-2 py-1">Send</button>
                        </form>
                    @endif
                    {{-- User Reply to Admin --}}
                    @if($r->user_reply_to_admin)
                        <div class="flex items-start gap-2 ml-20">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($r->user->name ?? 'User') }}&background=10b981&color=fff&rounded=true"
                                 class="w-7 h-7 rounded-none border-2 border-emerald-200 dark:border-emerald-700 mt-1">
                            <div>
                                <div class="font-bold text-emerald-700 dark:text-emerald-200 text-xs mb-1">User Reply</div>
                                <div class="bg-emerald-50 dark:bg-emerald-900/30 rounded-none px-3 py-2 text-xs text-emerald-800 dark:text-emerald-100">{{ $r->user_reply_to_admin }}</div>
                            </div>
                        </div>
                    @elseif($r->admin_reply && auth()->id() === $r->user_id)
                        {{-- User Reply Button --}}
                        <form id="user-reply-form-{{ $r->id }}" action="{{ route('reviews.userReply', $r) }}" method="POST" class="flex items-center gap-2 mt-2 ml-20">
                            @csrf
                            <input type="text" name="user_reply_to_admin" placeholder="Your reply to admin..." class="border rounded-none px-2 py-1 text-xs w-40">
                            <button type="submit" class="text-sm bg-blue-600 text-white rounded-none px-2 py-1">Send</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        {{ $reviews->links() }}
    </div>
@endsection
