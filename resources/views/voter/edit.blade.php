<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Voters') }}
            </h2>
            <Link href="{{ route('voter.index') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-3 rounded-lg text-white font-semibold text-md flex content-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-4.28 9.22a.75.75 0 000 1.06l3 3a.75.75 0 101.06-1.06l-1.72-1.72h5.69a.75.75 0 000-1.5h-5.69l1.72-1.72a.75.75 0 00-1.06-1.06l-3 3z" clip-rule="evenodd" />
                  </svg>
                  
                <span class="ml-2 text-sm">Back to Voters Data</span>
            </Link>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg grid grid-cols-3">
                <div class="">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Edit Voter Data') }}
                        </h2>
                
                        <p class="mt-1 text-sm text-gray-600">
                            {{ __("Update new voter data.") }}
                        </p>
                    </header>
                    <x-splade-form :default="$voter" method="PUT" :action=" route('voter.update', $voter->id) " class="mt-6">
                        <x-splade-input name="name" label="Name" class="mb-4" />
                        <x-splade-input name="email" label="Email" class="mb-8"  />
                        <input type="hidden" name="old_email" value="{{ $voter->email }}">
                        <x-splade-submit class=" bg-blue-500" label="Add Voter" :spinner="false"/>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
