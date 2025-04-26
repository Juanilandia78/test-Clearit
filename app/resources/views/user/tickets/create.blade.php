<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('user.tickets.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Ticket Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-sm font-medium text-gray-700">Ticket Type</label>
                            <select name="type" id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="1">General</option>
                                <option value="2">Urgent</option>
                                <option value="3">Follow-up</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Transport Mode -->
                        <div class="mb-4">
                            <label for="transport_mode" class="block text-sm font-medium text-gray-700">Transport Mode</label>
                            <select name="transport_mode" id="transport_mode" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                <option value="air">Air</option>
                                <option value="land">Land</option>
                                <option value="sea">Sea</option>
                            </select>
                            @error('transport_mode')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Product -->
                        <div class="mb-4">
                            <label for="product" class="block text-sm font-medium text-gray-700">Product (Optional)</label>
                            <input type="text" name="product" id="product" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('product')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Origin Country -->
                        <div class="mb-4">
                            <label for="origin_country" class="block text-sm font-medium text-gray-700">Origin Country (Optional)</label>
                            <input type="text" name="origin_country" id="origin_country" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('origin_country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Destination Country -->
                        <div class="mb-4">
                            <label for="destination_country" class="block text-sm font-medium text-gray-700">Destination Country (Optional)</label>
                            <input type="text" name="destination_country" id="destination_country" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @error('destination_country')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Attachments -->
                        <div class="mb-4">
                            <label for="attachments" class="block text-sm font-medium text-gray-700">Attachments (Optional)</label>
                            <input type="file" name="attachments[]" id="attachments" class="mt-1 block w-full text-sm text-gray-900 border-gray-300 rounded-md shadow-sm" multiple>
                            @error('attachments')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-end">
                            <button type="submit" class="ml-4 bg-indigo-600 text-white py-2 px-4 rounded-md">Create Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>