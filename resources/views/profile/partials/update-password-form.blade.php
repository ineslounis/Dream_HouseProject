<section class="bg-white shadow-md rounded-lg p-6 max-w-4xl mx-auto mt-10">
    {{-- <header class="mb-6">
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Mettre à jour le mot de passe') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Assurez-vous que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
        </p>
    </header> --}}

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6" >
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-600" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-600" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-600" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <x-primary-button class=" text-white px-4 py-2 rounded-md hover:bg-gray-700 transition"  style=" margin-top: 30px; background-color: #10b1d0; color: white; margin-left: 50px;">{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                    style="color: black;"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>
