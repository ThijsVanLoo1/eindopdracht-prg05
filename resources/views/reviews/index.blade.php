<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    @foreach($reviews as $review)
        <h2>{{ $review->comment }}</h2>
    @endforeach
    <a href="{{ route('reviews.create') }}">Create</a>
</x-layout>
