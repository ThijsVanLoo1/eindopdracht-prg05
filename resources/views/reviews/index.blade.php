<x-layout>
    <x-slot name="script">
        resources/js/read.js
    </x-slot>
    <div class="flex-center">
        <table>
            <thead>
                <tr>
                    <th>Boek</th>
                    <th>Boek Titel</th>
                    <th>Rating</th>
                    <th>Actief</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td><img src="{{ $review->book->image }}" alt=""></td>
                    <td>{{ $review->book->name }}</td>
                    <td>{{ $review->rating }}/5</td>
                    <td>
                        <button class="toggle-btn {{ $review->active ? 'active' : '' }}" data-id="{{ $review->id }}">
                            {{ $review->active_label }}
                        </button>
                    </td>
                    <td><a class="edit-btn" href="">Bewerken</a></td>
                    <td><a class="delete-btn" href="">Verwijderen</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('reviews.create') }}" class="create-button">Maak Nieuwe Review</a>
    </div>
</x-layout>
