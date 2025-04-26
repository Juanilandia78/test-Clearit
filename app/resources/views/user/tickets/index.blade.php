<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            My Tickets
        </h2>

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('user.tickets.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Create Ticket
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($tickets->total() === 0)
                    <p>You don't have any tickets yet.</p>
                @else
                    <table class="w-full table-auto">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Subject</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $ticket->id }}</td>
                                    <td class="px-4 py-2">{{ $ticket->title }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($ticket->status) }}</td>
                                    <td class="px-4 py-2 space-x-2">
                                        <a href="{{ route('user.tickets.show', $ticket) }}" class="text-blue-600 hover:underline">View</a>

                                        <form action="{{ route('user.tickets.destroy', $ticket) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>