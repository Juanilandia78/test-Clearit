<x-app-layout>
    <div class="max-w-4xl mx-auto py-10 px-6">
        <h1 class="text-2xl font-bold mb-6">Ticket Details</h1>

        {{-- Ticket Info --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-semibold mb-2">Subject: {{ $ticket->title }}</h2>
            <p class="text-gray-700 mb-4"><strong>Description:</strong></p>
            <p class="text-gray-800 mb-4">{{ $ticket->description }}</p>

            <p class="mb-2"><strong>Status:</strong>
                @if($ticket->status === 'pending')
                    <span class="inline-block px-2 py-1 text-sm font-semibold text-white bg-green-500 rounded">Open</span>
                @elseif($ticket->status === 'in_progress')
                    <span class="inline-block px-2 py-1 text-sm font-semibold text-black bg-yellow-300 rounded">In Progress</span>
                @else
                    <span class="inline-block px-2 py-1 text-sm font-semibold text-white bg-gray-500 rounded">Closed</span>
                @endif
            </p>

            <p class="text-sm text-gray-500">Created: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>

            @if($ticket->attachments && $ticket->attachments->count())
                <div class="mt-4">
                    <p class="font-semibold mb-2">Attachments:</p>
                    <ul class="list-disc list-inside text-blue-600">
                        @foreach($ticket->attachments as $file)
                            <li><a href="{{ Storage::url($file->path) }}" class="hover:underline" target="_blank">{{ $file->original_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <a href="{{ route('user.tickets.index') }}" class="mt-6 inline-block text-sm text-gray-600 hover:text-gray-800 underline">← Back to tickets</a>
        </div>

        {{-- Messages --}}
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">Messages</h3>
            @if($ticket->messages->count())
                @foreach($ticket->messages as $message)
                    <div class="mb-4 border rounded p-4">
                        <p class="font-semibold text-gray-700">{{ $message->user->name }}</p>
                        <p class="text-gray-800 mt-1">{{ $message->message }}</p>
                        <p class="text-sm text-gray-500 mt-2">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                @endforeach
            @else
                <p class="text-gray-600">No messages yet.</p>
            @endif
        </div>

        {{-- New message form --}}
        @if($ticket->status !== 'closed')
        <div class="bg-white shadow rounded-lg p-6 mb-10">
            <h3 class="text-lg font-semibold mb-4">Send a Message</h3>
            <form method="POST" action="{{ route('tickets.messages.store', $ticket) }}">
                @csrf
                <div class="mb-4">
                    <label for="message" class="block font-medium text-gray-700 mb-2">Message</label>
                    <textarea name="message" id="message" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Send</button>
            </form>
        </div>
        @endif
    </div>
</x-app-layout>