<x-layout>
    <x-slot name="script">
        resources/js/create.js
    </x-slot>
    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="create-review-container">
        @csrf

        <h2>Maak nieuwe Review</h2>

        <div class="book-choice">
            <label for="book_id">Kies bestaand boek:</label>
            <select name="book_id" id="book_id" class="input-field">
                <option value="">-- Nieuw boek toevoegen --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }} ({{ $book->author }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-items">
            <div class="book-details" id="createBookField">
                <label for="bookTitle">Boek titel:</label>
                <input type="text" id="bookTitle" name="bookTitle" class="input-field">
                @error('bookTitle')
                <span class="error">{{ $message }}</span>
                @enderror

                <label for="author">Schrijver:</label>
                <input type="text" id="author" name="author" class="input-field">
                @error('author')
                <span class="error">{{ $message }}</span>
                @enderror

                <label for="description">Beschrijving:</label>
                <textarea id="description" name="description" class="input-field"></textarea>
                @error('description')
                <span class="error">{{ $message }}</span>
                @enderror

                <label for="bookImage">Afbeelding</label>
                <input type="file" id="bookImage" name="bookImage">
            </div>

            <div class="review-details">
                <label for="rating">Rating</label>
                <div>
                    <input type="radio" name="rating" id="r1" value="1" />
                    <label for="r1">1</label>
                    <input type="radio" name="rating" id="r2" value="2" />
                    <label for="r2">2</label>
                    <input type="radio" name="rating" id="r3" value="3" />
                    <label for="r3">3</label>
                    <input type="radio" name="rating" id="r4" value="4" />
                    <label for="r4">4</label>
                    <input type="radio" name="rating" id="r5" value="5" />
                    <label for="r5">5</label>
                </div>
                @error('rating')
                <span class="error">{{ $message }}</span>
                @enderror

                <label for="reviewComment">Toelichting:</label>
                <textarea id="reviewComment" name="reviewComment" class="input-field"></textarea>
                @error('reviewComment')
                <span class="error">{{ $message }}</span>
                @enderror

                <input type="submit" name="submit" value="Create">
            </div>
        </div>
    </form>
</x-layout>
