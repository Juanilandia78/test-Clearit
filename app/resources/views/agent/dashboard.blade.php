<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Agent Dashboard
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <h1 class="text-2xl font-bold mb-2">Welcome, {{ Auth::user()->name }} 👋</h1>
                    <p class="text-gray-600">Here you can manage the tickets assigned to you.</p>
                </div>

                <div class="mt-6">
                    <h2 class="text-lg font-semibold mb-4">Assigned Tickets</h2>

                    @if($tickets->count())
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded">
                                <thead>
                                    <tr class="bg-gray-100 text-left text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6">ID</th>
                                        <th class="py-3 px-6">Subject</th>
                                        <th class="py-3 px-6">Status</th>
                                        <th class="py-3 px-6">User</th>
                                        <th class="py-3 px-6">Date</th>
                                        <th class="py-3 px-6">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-700 text-sm divide-y divide-gray-200">
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td class="py-3 px-6">{{ $ticket->id }}</td>
                                            <td class="py-3 px-6">{{ $ticket->title }}</td>
                                            <td class="py-3 px-6">
                                                @switch($ticket->status)
                                                    @case('pending')
                                                        <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs font-medium">Pending</span>
                                                        @break
                                                    @case('in_progress')
                                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-medium">In Progress</span>
                                                        @break
                                                    @case('closed')
                                                        <span class="px-2 py-1 rounded bg-gray-200 text-gray-700 text-xs font-medium">Closed</span>
                                                        @break
                                                    @default
                                                        <span class="px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-medium">Unknown</span>
                                                @endswitch
                                            </td>
                                            <td class="py-3 px-6">{{ $ticket->user->name ?? 'Unregistered' }}</td>
                                            <td class="py-3 px-6">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="py-3 px-6">
                                                <a href="{{ route('agent.tickets.show', $ticket) }}" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                                    View
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $tickets->links() }}
                        </div>
                    @else
                        <p class="text-gray-500">No tickets assigned yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

