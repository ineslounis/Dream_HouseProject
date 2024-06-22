<section class="space-y-6 max-w-3xl mx-auto p-6 bg-white rounded-md shadow-md">
    {{-- <header>
        <h2 class="text-lg font-medium text-gray-900" >
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header> --}}

    <x-danger-button class=" text-white px-4 py-2 rounded-md hover:bg-gray-700 transition"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" style=" margin-top: 30px; margin-bottom: 30px;background-color: red; color: white; margin-left: 50px;"
    >{{ __('Supprimer le compte') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>
            

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-md border-gray-300"
                    placeholder="{{ __('Mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-600" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')" class="text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 transition" style="margin-top: 30px; background-color: #10b1d0; margin-left: 50px;">
                    {{ __('Annuler') }}
                </x-secondary-button>
                

                <x-danger-button class="ml-3 bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition" style=" margin-top: 30px; background-color: red; color: white; margin-left: 50px;">
                    {{ __('Supprimer le compte') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
