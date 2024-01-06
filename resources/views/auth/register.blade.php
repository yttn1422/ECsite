<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-center">
        <h1 class="sm:text-xl text-xl font-medium title-font mb-2 text-gray-700">一般ユーザー</h1>
        </div>
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <!-- Gender -->
        <div class="mt-4 flex items-center">
            <input id="male" type="radio" name="gender" value="male" @if(old('gender') == 'male') checked @endif required>
            <x-input-label for="male" :value="__('男性')" class="ml-2" />
            
            <input id="female" type="radio" name="gender" value="female" @if(old('gender') == 'female') checked @endif required class="ml-4">
            <x-input-label for="female" :value="__('女性')" class="ml-2" />
            
            <x-input-error :messages="$errors->get('gender')" class="ml-4" />
        </div>
        <!-- Postal Code -->
        <div class="mt-4">
            <x-input-label for="postal_code" :value="__('郵便番号')" />
            <x-text-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>
        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('住所')" />
            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>
        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="tel" :value="__('電話番号')" />
            <x-text-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel')" />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
