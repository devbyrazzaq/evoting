<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Voters') }}
            </h2>
            <Link href="{{ route('voter.index') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-3 rounded-lg text-white font-semibold text-md flex content-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z" clip-rule="evenodd" />
                  </svg>
                  
                <span class="ml-2">Back to Voters Data</span>
            </Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-form class="max-w-md mx-auto p-6 bg-white rounded-lg">
                <x-splade-input name="name" label="Name" class="mb-4"/>
                <x-splade-input name="name" label="Email" class="mb-8" />
                <x-splade-submit class="float-right bg-blue-500" label="Add Voter" :spinner="false"/>
            </x-splade-form>
        </div>
    </div>
</x-app-layout>
