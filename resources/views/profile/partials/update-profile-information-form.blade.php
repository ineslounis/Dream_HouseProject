<section class="max-w-4xl mx-auto p-6 bg-white rounded-md shadow-md">
    {{-- <header class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-900">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header> --}}

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex gap-6">
            <!-- Profile Image Section -->
            <div class="w-full sm:w-1/3 flex flex-col items-center" style="margin-left: 600px">
                <x-input-label for="image_user" :value="__('Profile Image')" />
                <div class="mt-2 w-32 h-32 rounded-full overflow-hidden bg-gray-100 flex items-center justify-center">
                    @if ($user->image_user)
                        <img src="../images/{{$user->image_user}}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-500">{{ __('aucune image ') }}</span>
                    @endif
                </div>
            </div>

            <!-- Profile Info Section -->
            <div class="w-full sm:w-2/3" style="margin-left: 50px">
                <x-input-label for="name" :value="__('Name')" style="margin-top: -300px;"/>
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />

                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full" :value="old('prenom', $user->prenom)" required autocomplete="prenom" />
                <x-input-error class="mt-2" :messages="$errors->get('prenom')" />

                <x-input-label for="tel" :value="__('Téléphone')" />
                <x-text-input id="tel" name="tel" type="text" class="mt-1 block w-full" :value="old('tel', $user->tel)" required autocomplete="tel" />
                <x-input-error class="mt-2" :messages="$errors->get('tel')" />

                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full" :value="old('adresse', $user->adresse)" required autocomplete="adresse" />
                <x-input-error class="mt-2" :messages="$errors->get('adresse')" />

                <x-input-label for="wilaya" :value="__('Wilaya')" />
                <x-text-input id="wilaya" name="wilaya" type="text" class="mt-1 block w-full" :value="old('wilaya', $user->wilaya)" required autocomplete="wilaya" />
                <x-input-error class="mt-2" :messages="$errors->get('wilaya')" />

                <x-input-label for="role" :value="__('Role')" />
                <x-text-input id="role" name="role" type="text" class="mt-1 block w-full" :value="old('role', $user->role)" required autocomplete="role" />
                <x-input-error class="mt-2" :messages="$errors->get('role')" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button style=" margin-top: 30px; background-color: #10b1d0; color: white; margin-left: 50px;">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600" >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>

<style>
    .max-w-4xl {
        max-width: 64rem;
    }
    .rounded-md {
        border-radius: 0.375rem;
    }
    .shadow-md {
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>
