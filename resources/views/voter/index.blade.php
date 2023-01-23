L<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Voters') }}
            </h2>
            <div class="flex">

                <Link href="{{ route('voter.create') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-3 rounded-lg text-white font-semibold text-md flex items-center mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.003l-.001.119a.75.75 0 01-.363.63 13.067 13.067 0 01-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 01-.364-.63l-.001-.122zM19.75 7.5a.75.75 0 00-1.5 0v2.25H16a.75.75 0 000 1.5h2.25v2.25a.75.75 0 001.5 0v-2.25H22a.75.75 0 000-1.5h-2.25V7.5z" />
                      </svg>
                      
                    <span class="ml-2 text-sm">Add Voter</span>
                </Link>
                <Link href="{{ route('voter.import') }}" class="bg-blue-500 hover:bg-blue-700 px-4 py-3 rounded-lg text-white font-semibold  flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M5.625 1.5H9a3.75 3.75 0 013.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 013.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 01-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875zm5.845 17.03a.75.75 0 001.06 0l3-3a.75.75 0 10-1.06-1.06l-1.72 1.72V12a.75.75 0 00-1.5 0v4.19l-1.72-1.72a.75.75 0 00-1.06 1.06l3 3z" clip-rule="evenodd" />
                        <path d="M14.25 5.25a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963A5.23 5.23 0 0016.5 7.5h-1.875a.375.375 0 01-.375-.375V5.25z" />
                      </svg>
                      
                      
                    <span class="ml-2 text-sm">Import Excel Data</span>
                </Link>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$voters" as="$voter">
                
                <x-splade-cell status>
                    @if ($voter->status)
                        <p class=""><span class="bg-emerald-300 px-3 py-1 text-xs text-emerald-800 font-bold rounded-full border-2 border-emerald-100 ring-2 ring-emerald-800">has been vote</span> </p>
                    @else
                        <p class=""> <span class="bg-rose-300 px-3 py-1 text-xs text-rose-800 font-bold rounded-full border-2 border-rose-100 ring-2 ring-rose-800">not yet vote</span></p>
                    @endif
                </x-splade-cell>

                <x-splade-cell actions as="$voter">
                    <div class="">
                        <Link href="{{ route('voter.edit', $voter->username) }}" class="font-bold px-3 py-1 border-2 border-slate-500 hover:border-slate-700 hover:bg-slate-700 hover:text-white rounded-lg"> Edit </Link>
                        <Link
                            method="DELETE"
                            class="font-bold px-3 py-1 border-2 border-slate-500 hover:border-slate-700 hover:bg-slate-700 hover:text-white rounded-lg ml-2"
                            confirm="Delete {{ $voter->name }} Data ...."
                            confirm-text="Are you sure want to delete {{ $voter->name }} data?"
                            confirm-button="Yes, delete data!"
                            cancel-button="No, keep the data!"
                            href="{{ route('voter.destroy', $voter->id) }}">
                            Delete
                        </Link>
                        {{-- <link href="{{ route('voter.export')  }} ,class='font-semibolde'>Test</Link> --}}
                    </div>
                </x-splade-cell>

            </x-splade-table>
        </div>
    </div>
</x-app-layout>
