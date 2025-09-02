<!DOCTYPE html>
<html>
<head>
    <title>Gestion des utilisateurs</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Gestion des utilisateurs</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="role">
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="contrôleur" {{ $user->role == 'contrôleur' ? 'selected' : '' }}>Contrôleur</option>
                                    <option value="utilisateur" {{ $user->role == 'utilisateur' ? 'selected' : '' }}>Utilisateur</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>