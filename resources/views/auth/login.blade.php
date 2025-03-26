<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-10 my-4">
        @csrf

        <h1 class="poppins-bold text-center text-3xl">Log in</h1>

        <div>
            <!-- Email Address -->
            <div>
                <x-input-label for="nim" :value="__('NIM')" />
                <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim')"
                    required autofocus autocomplete="nim" placeholder="Enter your NIM" />
                <x-input-error :messages="$errors->get('nim')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="Enter your password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-primary-button class="w-full">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
