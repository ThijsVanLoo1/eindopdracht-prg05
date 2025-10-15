<x-layout>
    <h1>Welcome to the Home Page</h1>
        @foreach($books as $book)
            <h2>{{$book->name}}</h2>
        @endforeach
</x-layout>
