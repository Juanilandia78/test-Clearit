<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-xl font-bold mb-4">Notifications</h1>

        @if(auth()->user()->notifications->count())
            <ul class="space-y-4">
                @foreach(auth()->user()->notifications as $notification)
                    <li class="p-4 bg-white shadow rounded">
                        <p>{{ $notification->data['message'] }}</p>
                        <small class="text-gray-500">{{ $notification->created_at->diffForHumans() }}</small>

                        @if(isset($notification->data['ticket_id']))
                            @php
                                $route = auth()->user()->isAgent()
                                    ? route('agent.tickets.show', $notification->data['ticket_id'])
                                    : route('user.tickets.show', $notification->data['ticket_id']);
                            @endphp

                            <a href="{{ $route }}" class="text-blue-500 ml-2">
                                View ticket
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>No notifications.</p>
        @endif
    </div>
</x-app-layout>
