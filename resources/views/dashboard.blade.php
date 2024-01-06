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
                


        <section class="text-gray-600 body-font">
        <div class="container px-5 py-4 mx-auto">
        <div class="flex flex-col text-center w-full mb-20">
        <div class="flex justify-end">
            <form action="{{ route('cart.show') }}" method="GET" class="flex items-center">
                <button type="submit" class="bg-blue-500 text-white rounded-md p-2 ml-2 hover:bg-blue-600 transition duration-300">購入手続きへ</button>
            </form>
        </div>
        

        <!-- 検索機能 -->
        <div>
        <form action="{{ route('dashboard') }}" method="GET" class="flex items-center justify-center mb-4">
            @csrf
            <input type="text" name="search" placeholder="商品を検索" class="border p-2 rounded-md focus:outline-none focus:border-blue-500">
            <button type="submit" class="bg-blue-500 text-white rounded-md p-2 ml-2 hover:bg-blue-600 transition duration-300">検索</button>
        </form>
        <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">商品一覧</h1>
        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
        <table class="table-auto w-full text-left whitespace-no-wrap">
            <thead>
                <tr class="text-center">
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">商品No</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 w-1/7">画像</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 w-2/7">商品名</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 w-1/7">価格</th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 w-1/7"></th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 w-1/7"></th>
                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl"></th>
                </tr>
            </thead>
        <tbody>
        @foreach($values as $value)
            <tr class="text-center">
                <td>{{ $value->id }}</td>
                <td><img src="{{ Storage::url($value->img_path) }}" class="rounded-full w-16 h-16 object-cover object-center"></td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->price }}円</td>
                <td>
                    <form action="{{ route('item_detail', [ $value->id]) }}" method="GET">
                        @csrf
                        <button type="submit" class="text-white bg-gray-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded">
                            詳細
                        </button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('cart.add', ['item_id' => $value->id]) }}" method="post" >
                        @csrf
                        <button type="submit" class="text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded">
                            カートに追加
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
        </div>
    </div>
    {{ $values->links() }}
    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




