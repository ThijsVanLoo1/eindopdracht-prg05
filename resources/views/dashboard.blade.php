<x-layout>
    <x-slot name="script">
        ''
    </x-slot>
    <main>
        <div class="flex-center">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Users</th>
                    <th>Email</th>
                    <th>Reviews</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ \App\Models\Review::where('user_id', $user->id)->get()->count() }}</td>
                        @if(!$user->isAdmin)
                        <td>
                            <form action="{{ route('dashboard.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Verwijderen</button>
                            </form>
                        </td>
                        @endif
                        <td></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
</x-layout>
