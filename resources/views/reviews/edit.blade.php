<x-layout>
    <form action="{{ route('reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="create-review-container">
        @csrf
        @method('PUT')

        <h2>Bewerk Review</h2>
            <div class="book-details" id="createBookField">
                <label for="review">Review:</label>
                <textarea id="review" name="review" rows="10" cols="50">{{ $review->comment }}</textarea>
                @error('review')
                <span class="error">{{ $message }}</span>
                @enderror
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

                <input type="submit" name="submit" value="Bewerk" class="create-button">
            </div>
    </form>
</x-layout>
