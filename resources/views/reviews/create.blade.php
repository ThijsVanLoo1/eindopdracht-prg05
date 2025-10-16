<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf

        <label for="comment">Comment</label>
        <input id="comment" name="comment" type="text" value="{{ old('comment') }}">
        @error('comment')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div>
            <select name="book_id" id="">
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->name }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" name="submit" value="Create">
    </form>
</x-layout>
