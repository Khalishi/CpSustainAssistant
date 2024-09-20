<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-blue-500 dark:bg-green-400 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-green-500 focus:bg-blue-700 dark:focus:bg-green-500 active:bg-blue-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-green-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
