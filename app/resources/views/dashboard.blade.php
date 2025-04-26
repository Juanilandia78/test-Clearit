<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           User {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <h2 class="m-4 text-xl font-semibold">Quick Access</h2>

                <div class="flex gap-3 m-4 flex-wrap">
                    <a href="{{ route('user.tickets.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 mb-2">
                        Create New Ticket
                    </a>

                    <a href="{{ route('user.tickets.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-2">
                        View My Tickets
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


