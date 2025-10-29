<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <main>
        <div class="grid-container">
            @foreach($books as $book)
                <div class="book-container">
                    <h2 class="cut-text">{{ $book->name }}</h2>
                    <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('storage/book_images/default-book.png') }}" alt="{{ $book->name }}">
                    <div class="review-container cut-text">
                        <div class="name-review">{{ $book->reviews->first()->user->name }}:</div>
                        {{ $book->reviews->first()->comment }}
                    </div>
                    <a href="{{ route('details', $book->id) }}" class="create-button">Zie meer</a>
                </div>
            @endforeach
        </div>
    </main>
</x-layout>
