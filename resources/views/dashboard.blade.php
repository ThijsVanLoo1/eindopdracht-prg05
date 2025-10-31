@php use App\Models\Book;use App\Models\Review; @endphp
<x-layout>
    <main class="flex-dashboard">
        <section>
            <h1>Gebruikers</h1>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Users</th>
                    <th>Email</th>
                    <th>Reviews</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ Review::where('user_id', $user->id)->get()->count() }}</td>
                        @if(!$user->isAdmin)
                            <td>
                                <form action="{{ route('dashboard.destroy', $user->id) }}" method="POST"
                                      onsubmit="return confirm('Weet je het zeker?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Verwijderen</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
        <section>
            <h1>Boeken</h1>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Boektitel</th>
                    <th>Auteur</th>
                    <th>Laatst bewerkt</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->updated_at }}</td>
                        <td>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                  onsubmit="return confirm('Weet je het zeker?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Verwijderen</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </main>
</x-layout>
