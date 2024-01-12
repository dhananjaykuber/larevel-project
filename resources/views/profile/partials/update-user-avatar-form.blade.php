<section>
    <div class="flex justify-between items-center mb-10">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                User Avatar
            </h2>
    
            <form action="{{ route('profile.avatar.ai') }}" method="post" class="mt-3">
                @csrf
                @method('patch')

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Generate avatar from AI
                </p>
                <div class="flex items-center gap-4 mt-2">
                    <x-primary-button>Generate Avatar</x-primary-button>
                </div>
            </form>        
        </header>
    
        <img src="{{ "/storage/$user->avatar" }}" alt="user avatar" class="rounded-full" width="100px" height="100px"/>
    </div>

    <strong class="block mb-5" style="margin-top: 20px">OR</strong>
    <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
        Upload Avatar
    </p>

    @if (session('message'))
        <div class="text-red-500">
            {{ session('message') }}
        </div>
    @endif

    <form method="post" action="{{ route('profile.avatar') }}" enctype="multipart/form-data" class="mt-2 space-y-2">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="avatar" value="Avatar" />
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>

        <div class="flex items-center gap-4 mt-3">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
