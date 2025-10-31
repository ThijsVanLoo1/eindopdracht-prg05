<x-layout>
    <main>
        <section class="detail-container">
            <div>
                <h1>{{ $book->name }}</h1>
                <h2>{{ $book->author }}</h2>
                <p>{{ $book->description }}</p>
                <div>
                    @foreach($book->reviews as $review)
                        <div class="review-box">
                            <div class="name-review">{{ $review->user->name }} - {{ $review->rating }}/5</div>
                            <div class="review-text">{{ $review->comment }}</div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('home') }}" class="create-button">Terug naar Overzicht</a>
            </div>
            <img src="{{ $book->image ? asset('storage/' . $book->image) : asset('storage/book_images/default-book.png') }}" alt="{{ $book->name }}">
        </section>
    </main>
</x-layout>
