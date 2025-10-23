<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <div class="flex-center">
        <table>
            <thead>
                <tr>
                    <th>Boek</th>
                    <th>Boek Titel</th>
                    <th>Rating</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td><img src="{{ $review->book->image }}" alt=""></td>
                    <td>{{ $review->book->name }}</td>
                    <td>{{ $review->rating }}</td>
                    <td>{{ $review->comment }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a href="{{ route('reviews.create') }}" class="create-button">Maak Nieuwe Review</a>
    </div>
</x-layout>
