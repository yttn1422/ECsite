<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('一般ユーザー') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-center">
                                    <!-- 画像の追加 -->
                                    <div class="mr-8">
                                        <img src="{{ asset('storage/images/th.jpg') }}" alt="Your Image" class="mx-auto mb-4 max-w-48 h-auto">
                                    </div>

                                    <div>
                                        <h1 class="text-3xl font-semibold mb-4">購入が完了しました。</h1>
                                        <p>ご購入いただき、誠にありがとうございます。</p>
                                    </div>
                                </div>
                                <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto underline justify-center">
                                    <a class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('dashboard') }}">商品一覧に戻る</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
