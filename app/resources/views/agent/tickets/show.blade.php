<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">

        <h1 class="text-2xl font-bold mb-6">Ticket #{{ $ticket->id }} – {{ $ticket->title }}</h1>

        {{-- Ticket Information --}}
        <div class="bg-white shadow rounded p-6 mb-6">
            <p><strong>Description:</strong> {{ $ticket->description }}</p>

            <p class="mt-2"><strong>Current Status:</strong>
                @switch($ticket->status)
                    @case('pending')
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">Open</span>
                        @break
                    @case('in_progress')
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">In Progress</span>
                        @break
                    @case('closed')
                        <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded text-sm">Closed</span>
                        @break
                @endswitch
            </p>

            <p class="mt-2"><strong>User:</strong> {{ $ticket->user->name ?? 'Unknown' }}</p>
            <p><strong>Creation Date:</strong> {{ $ticket->created_at->format('d/m/Y H:i') }}</p>

            <p class="mt-4"><strong>Attachments:</strong></p>
            @if($ticket->attachments->count())
                <ul class="list-disc list-inside">
                    @foreach($ticket->attachments as $file)
                        <li>
                            <a href="{{ asset('storage/' . $file->path) }}" class="text-blue-600 underline" target="_blank">
                                {{ $file->original_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No attachments found.</p>
            @endif
        </div>

        {{-- Messages --}}
        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4">Messages</h2>
            @if($ticket->messages->count())
                <div class="space-y-4">
                    @foreach($ticket->messages as $message)
                        <div class="border p-4 rounded">
                            <div class="font-medium">{{ $message->user->name }}</div>
                            <p class="mt-1">{{ $message->message }}</p>
                            <div class="text-sm text-gray-500 mt-2">
                                {{ $message->created_at->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500">No messages yet.</p>
            @endif
        </div>

        {{-- Reply to ticket (if not closed) --}}
        @if($ticket->status !== 'closed')
            <div class="bg-white shadow rounded p-6 mb-6">
                <h2 class="text-lg font-semibold mb-4">Reply to the ticket</h2>
                <form method="POST" action="{{ route('tickets.messages.store', $ticket) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="message" class="block text-sm font-medium">Message</label>
                        <textarea name="message" id="message" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                        Send Message
                    </button>
                </form>
            </div>
        @endif

        {{-- Update Status --}}
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-lg font-semibold mb-4">Update Ticket Status</h2>
            <form method="POST" action="{{ route('agent.tickets.update', $ticket) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="pending" @selected($ticket->status === 'pending')>Open</option>
                        <option value="in_progress" @selected($ticket->status === 'in_progress')>In Progress</option>
                        <option value="closed" @selected($ticket->status === 'closed')>Closed</option>
                    </select>
                </div>

                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Update Status
                </button>
            </form>
        </div>

    </div>
</x-app-layout>
