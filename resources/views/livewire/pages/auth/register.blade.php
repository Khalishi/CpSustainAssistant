<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $comapany_name = '';
    public string $email = '';
    public string $province = '';
    public string $City = '';
    public string $year_Of_incorporation = '';
    public string $number_of_employees = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'comapany_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'province' => ['required', 'string', 'max:255'],
            'City' => ['required', 'string', 'max:255'],
            'year_Of_incorporation' => ['required', 'string', 'max:255'],
            'number_of_employees' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="comapany_name" :value="__('Company Name')" />
            <x-text-input wire:model="comapany_name" id="comapany_name" class="block mt-1 w-full" type="text" name="comapany_name" required autofocus autocomplete="comapany_name" />
            <x-input-error :messages="$errors->get('comapany_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

         <!-- province -->
         <div class="mt-4">
            <x-input-label for="province" :value="__('Province')" />
            <x-text-input wire:model="province" id="province" class="block mt-1 w-full" type="text" name="province" required autofocus autocomplete="province" />
            <x-input-error :messages="$errors->get('province')" class="mt-2" />
        </div>
        <!-- City -->
        <div class="mt-4">
            <x-input-label for="City" :value="__('City')" />
            <x-text-input wire:model="City" id="City" class="block mt-1 w-full" type="text" name="City" required autofocus autocomplete="City" />
            <x-input-error :messages="$errors->get('City')" class="mt-2" />
        </div>

        <!-- year_Of_incorporation -->
        <div class="mt-4">
            <x-input-label for="year_Of_incorporation" :value="__('Year Of Incorporation')" />
            <x-text-input wire:model="year_Of_incorporation" id="year_Of_incorporation" class="block mt-1 w-full" type="text" name="year_Of_incorporation" required autofocus autocomplete="year_Of_incorporation" />
            <x-input-error :messages="$errors->get('year_Of_incorporation')" class="mt-2" />
        </div>
        
        <!-- number_of_employees -->
        <div class="mt-4">
            <x-input-label for="number_of_employees" :value="__('Number Of Employees')" />
            <x-text-input wire:model="number_of_employees" id="year_Of_incorporation" class="block mt-1 w-full" type="text" name="number_of_employees" required autofocus autocomplete="number_of_employees" />
            <x-input-error :messages="$errors->get('number_of_employees')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-blue-500 dark:text-green-400 hover:text-blue-700 dark:hover:text-green-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-green-700" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
