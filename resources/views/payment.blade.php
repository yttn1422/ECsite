
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
            {{ __('一般ユーザー') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (session('flash_alert'))
                        <div class="alert alert-danger">{{ session('flash_alert') }}</div>
                    @elseif(session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="p-5">
                                <div class="text-center text-xl font-semibold mb-4">決済処理</div>
                                <form id="card-form" action="{{ route('payment.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="card_number" class="block text-sm font-medium text-gray-700">カード番号</label>
                                        <div id="card-number" class="mt-1 p-2 border rounded-md"></div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="card_expiry" class="block text-sm font-medium text-gray-700">有効期限</label>
                                        <div id="card-expiry" class="mt-1 p-2 border rounded-md"></div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="card-cvc" class="block text-sm font-medium text-gray-700">セキュリティコード</label>
                                        <div id="card-cvc" class="mt-1 p-2 border rounded-md"></div>
                                    </div>

                                    <div id="card-errors" class="text-red-500 mb-4"></div>

                                    <div class="flex items-center justify-center">
                                    <button type="submit" class="bg-blue-500 text-white rounded-md p-2 ml-2 hover:bg-blue-600 transition duration-300">支払い</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                <script src="https://js.stripe.com/v3/"></script>
                <script>
                    /* 基本設定*/
                    const stripe_public_key = "{{ config('stripe.stripe_public_key') }}"
                    const stripe = Stripe(stripe_public_key);
                    const elements = stripe.elements();

                    var cardNumber = elements.create('cardNumber');
                    cardNumber.mount('#card-number');
                    cardNumber.on('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    var cardExpiry = elements.create('cardExpiry');
                    cardExpiry.mount('#card-expiry');
                    cardExpiry.on('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    var cardCvc = elements.create('cardCvc');
                    cardCvc.mount('#card-cvc');
                    cardCvc.on('change', function(event) {
                        var displayError = document.getElementById('card-errors');
                        if (event.error) {
                            displayError.textContent = event.error.message;
                        } else {
                            displayError.textContent = '';
                        }
                    });

                    var form = document.getElementById('card-form');
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        var errorElement = document.getElementById('card-errors');
                        if (event.error) {
                            errorElement.textContent = event.error.message;
                        } else {
                            errorElement.textContent = '';
                        }

                        stripe.createToken(cardNumber).then(function(result) {
                            if (result.error) {
                                errorElement.textContent = result.error.message;
                            } else {
                                stripeTokenHandler(result.token);
                            }
                        });
                    });

                    function stripeTokenHandler(token) {
                        var form = document.getElementById('card-form');
                        var hiddenInput = document.createElement('input');
                        hiddenInput.setAttribute('type', 'hidden');
                        hiddenInput.setAttribute('name', 'stripeToken');
                        hiddenInput.setAttribute('value', token.id);
                        form.appendChild(hiddenInput);
                        form.submit();
                    }
    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>