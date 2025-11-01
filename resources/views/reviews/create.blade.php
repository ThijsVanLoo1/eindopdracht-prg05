<x-layout>
    @vite('resources/js/create.js')
    <form action="{{ route('reviews.store') }}" method="POST" enctype="multipart/form-data" class="create-review-container">
        @csrf

        <h2>Maak nieuwe Review</h2>

        <div class="book-choice">
            <label for="book_id">Kies bestaand boek:</label>
            <select name="book_id" id="book_id" class="input-field">
                <option value="">-- --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }} ({{ $book->author }})</option>
                @endforeach
            </select>
            @error('book_id')
            <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-items">
            <div class="book-details" id="createBookField">
                <h3>Nieuw boek toevoegen</h3>
                <!-- DIEPERE VALIDATIE: Heeft de gebruiker meer dan 3 reviews geschreven? -->
                @if($canAddNewBook)
                    <label for="genre_id">Kies genre:</label>
                    <select name="genre_id" class="input-field" style="margin-bottom: 10px">
                        <option value="">-- Kies een genre --</option>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>

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

                @else
                    <div class="warning">
                        <strong>Let op:</strong> Je hebt momenteel {{ $reviewCount }} reviews geschreven.<br>
                        Je moet minstens {{ $requiredReviews }} reviews hebben voordat je een nieuw boek kunt toevoegen.
                    </div>

                    <p class="suggestion">Je kunt nog wel een review schrijven voor een bestaand boek hierboven</p>
                @endif
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
