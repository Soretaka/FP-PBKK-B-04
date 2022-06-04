<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- TL_USER -->    
            <div class="mt-4" >
                <x-label for="TL" :value="__('Tanggal Lahir')" />

                <x-input id="TL" class="block mt-1 w-full" type="date" name="TL" data-language="en" data-position="top left"  :value="old('TL')" required autofocus />
            </div>

            <!-- TT_USER -->
            <div class="mt-4">
                <x-label for="Alamat" :value="__('Alamat')" />

                <x-input id="Alamat" class="block mt-1 w-full" type="text" name="Alamat" :value="old('Alamat')" required autofocus />
            </div>
            <!-- JK_USER -->
            <div class="mt-4">
                <x-label for="JK" :value="__('Jenis Kelamin')" />

                <div>
                    <select class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full" id="JK" name="JK" required autofocus>
                        <option value="">-Pilih Jenis Kelamin-</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
            </div>
            <!-- NIS -->
            <div class="mt-4">
                <x-label for="NIS" :value="__('NIS')" />

                <x-input id="NIS" class="block mt-1 w-full" type="text" name="NIS" :value="old('NIS')" autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
