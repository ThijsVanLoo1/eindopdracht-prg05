<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <header>

    </header>
    <main>
        <div class="grid-container">
            @foreach($books as $book)
                <div class="book-container">
                    <h2 class="cut-text">{{ $book->name }}</h2>
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('storage/book_images/default-book.png') }}" alt="{{ $book->name }}">
                    @foreach($book->reviews as $review)
                        <div class="review-container cut-text">
                            {{ $review->comment }}
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </main>
</x-layout>
