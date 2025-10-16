<x-layout>
    <x-slot name="script">
        resources/js/main.js
    </x-slot>
    <header>

    </header>
    <main>
        <div class="grid-container">
            @foreach($books as $book)
                <div class="book-container">
                    <h2>{{ $book->name }}</h2>
                    <img src="{{ $book->image }}" alt="{{ $book->name }}">
                    @foreach($reviews as $review)
                        @if($review->book_id === $book->id)
                            <div class="review-container">
                            {{ $review->comment }}
                            </div>
                        @endif
                    @endforeach
                </div>
            @endforeach
        </div>
    </main>
</x-layout>
