<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <form action="{{ route('reviews.store') }}" method="POST" class="create-review-container">
        @csrf

        <h2>Maak nieuwe Review</h2>

        <div class="form-items">
            <div class="book-details">
                <label for="bookTitle">Boek Titel:</label>
                <input type="text" id="bookTitle" name="bookTitle" class="input-field">

                <label for="author">Schrijver:</label>
                <input type="text" id="author" name="author" class="input-field">

                <label for="description">Beschrijving:</label>
                <textarea id="description" name="description" class="input-field"></textarea>

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

                <label for="reviewComment">Toelichting:</label>
                <textarea id="reviewComment" name="reviewComment" class="input-field"></textarea>

            <!-- <label for="comment">Comment</label>
            <input id="comment" name="comment" type="text" value="{{ old('comment') }}">
            @error('comment')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <label for="book_id">Boek</label>
            <select name="book_id" id="book_id">
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                @endforeach
            </select> -->

                <input type="submit" name="submit" value="Create">
            </div>
        </div>
    </form>
</x-layout>
