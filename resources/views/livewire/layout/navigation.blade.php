<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<!-- nav start -->
<div x-data="{ open: false }">
  <nav class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex flex-shrink-0 items-center">
            <img class="block h-8 w-auto lg:hidden" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
            <img class="hidden h-8 w-auto lg:block" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
          </div>
          <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
            <a href="#" class="inline-flex items-center border-b-2 border-indigo-500 dark:border-green-500 px-1 pt-1 text-sm font-medium text-gray-900 dark:text-gray-100" aria-current="page">Dashboard</a>
            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 dark:text-gray-100 hover:border-gray-300 dark:hover:border-green-400 hover:text-gray-700 dark:hover:text-gray-300">Survey</a>
            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 dark:text-gray-100 hover:border-gray-300 dark:hover:border-green-400 hover:text-gray-700 dark:hover:text-gray-300">User Profile</a>
            <a href="#" class="inline-flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-gray-500 dark:text-gray-100 hover:border-gray-300 dark:hover:border-green-400 hover:text-gray-700 dark:hover:text-gray-300">Products</a>
          </div>
        </div>
        <div class="hidden sm:ml-6 sm:flex sm:items-center">
    <!-- Profile dropdown -->
    <div class="relative ml-3" x-data="{ open: false }" @click.away="open = false">
    <!-- Button to trigger the dropdown -->
    <div>
        <button @click="open = !open" type="button" class="relative flex rounded-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-green-500 focus:ring-offset-2" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
        <span class="absolute -inset-1.5"></span>
        <span class="sr-only">Open user menu</span>
        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-500 dark:bg-gray-500">
            <span class="text-sm font-medium leading-none text-white dark:text-gray-100">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
               <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
            </svg>
            </span>
        </span>
        </button>
    </div>
  <!-- Dropdown menu -->
  <div x-show="open"
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="transform opacity-0 scale-95"
       x-transition:enter-end="transform opacity-100 scale-100"
       x-transition:leave="transition ease-in duration-75"
       x-transition:leave-start="transform opacity-100 scale-100"
       x-transition:leave-end="transform opacity-0 scale-95"
       class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white dark:bg-gray-700 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
       role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">

    <!-- Dropdown Links -->
    <x-dropdown-link :href="route('profile')" wire:navigate>
      {{ __('Update Profile') }}
    </x-dropdown-link>
    
    <!-- Logout Button -->
    <button wire:click="logout" class="w-full text-start">
      <x-dropdown-link>
        {{ __('Log Out') }}
      </x-dropdown-link>
    </button>
  </div>
</div>

</div>
     <!-- Mobile menu button -->
        <div class="-mr-2 flex items-center sm:hidden">
          <button @click="open = !open" type="button" class="relative inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 dark:hover:bg-green-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-green-500 focus:ring-offset-2">
            <span class="sr-only">Open main menu</span>
            <svg x-show="!open" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-show="open" viewBox="0 0 24 24" fill="currentColor" class="size-6">
               <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile menu -->
    <div x-show="open" class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 pb-3 pt-2">
        <a href="#" class="block border-l-4 border-indigo-500 dark:border-gray-700 bg-indigo-50 dark:bg-gray-900 py-2 pl-3 pr-4 text-base font-medium text-indigo-700 dark:text-gray-100" aria-current="page">Dashboard</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 dark:text-gray-100 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Survey</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 dark:text-gray-100 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">User Profile</a>
        <a href="#" class="block border-l-4 border-transparent py-2 pl-3 pr-4 text-base font-medium text-gray-600 dark:text-gray-100 hover:border-gray-300 hover:bg-gray-50 hover:text-gray-800">Products</a>
      </div>
      <div class="border-t border-gray-200 dark:border-gray-700 pb-3 pt-4">
        <div class="flex items-center px-4">
          
          <div>
            <div class="text-sm font-medium text-gray-800 dark:text-gray-100">Tom Cook</div>
            <div class="text-xs font-medium text-blue-500 dark:text-green-500">tom@example.com</div>
          </div>
        </div>
        <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Update Profile') }}
                </x-responsive-nav-link>          
                
                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>        
            </div>
      </div>
    </div>
  </nav>
</div>

