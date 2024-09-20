<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $comapany_name = '';
    public string $email = '';
    public string $province = '';
    public string $City = '';
    public string $year_Of_incorporation = '';
    public string $number_of_employees = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->comapany_name = Auth::user()->comapany_name;
        $this->email = Auth::user()->email;
        $this->province = Auth::user()->province;
        $this->City = Auth::user()->City;
        $this->year_Of_incorporation = Auth::user()->year_Of_incorporation;
        $this->number_of_employees = Auth::user()->number_of_employees;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'comapany_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'province' => ['required', 'string', 'max:255'],
            'City' => ['required', 'string', 'max:255'],
            'year_Of_incorporation' => ['required', 'string', 'max:255'],
            'number_of_employees' => ['required', 'string', 'max:255'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', comapany_name: $user->comapany_name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="comapany_name" :value="__('Comapany Name')" />
            <x-text-input wire:model="comapany_name" id="comapany_name" name="comapany_name" type="text" class="mt-1 block w-full" required autofocus autocomplete="comapany_name" />
            <x-input-error class="mt-2" :messages="$errors->get('comapany_name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button wire:click.prevent="sendVerification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- province -->
        <div>
            <x-input-label for="province" :value="__('Province')" />
            <x-text-input wire:model="province" id="province" class="block mt-1 w-full" type="text" name="province" required autofocus autocomplete="province" />
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>
        <!-- City -->
        <div>
            <x-input-label for="City" :value="__('City')" />
            <x-text-input wire:model="City" id="City" class="block mt-1 w-full" type="text" name="City" required autofocus autocomplete="City" />
            <x-input-error :messages="$errors->get('City')" class="mt-2" />
        </div>

        <!-- year_Of_incorporation -->
        <div>
            <x-input-label for="year_Of_incorporation" :value="__('Year Of Incorporation')" />
            <x-text-input wire:model="year_Of_incorporation" id="year_Of_incorporation" class="block mt-1 w-full" type="text" name="year_Of_incorporation" required autofocus autocomplete="year_Of_incorporation" />
            <x-input-error :messages="$errors->get('year_Of_incorporation')" class="mt-2" />
        </div>
        
        <!-- number_of_employees -->
        <div>
            <x-input-label for="number_of_employees" :value="__('Number Of Employees')" />
            <x-text-input wire:model="number_of_employees" id="year_Of_incorporation" class="block mt-1 w-full" type="text" name="number_of_employees" required autofocus autocomplete="number_of_employees" />
            <x-input-error :messages="$errors->get('number_of_employees')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
