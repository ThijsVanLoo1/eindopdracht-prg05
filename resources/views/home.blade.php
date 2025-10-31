<x-layout>
    <header class="home-header">
        <div class="overlay">
            <h1>BookBanter</h1>
        </div>
    </header>
    <main>
        <form method="GET" action="{{ route('home.search') }}" class="search-bar">
            <input type="text" name="query" value="{{ old('query', $query ?? '') }}" placeholder="Zoek boek of auteur..." class="input-field">
            <button type="submit" class="create-button">Zoek</button>
        </form>
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
