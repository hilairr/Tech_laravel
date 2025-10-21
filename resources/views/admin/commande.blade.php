@extends('layouts.app')

@section('title', 'Gestion des commandes')

@section('content')
<div class="container mt-5 mb-5">
    <h2 class="text-center mb-4">Liste des commandes</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <p class="text-center text-muted">Aucune commande trouvée.</p>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Utilisateur</th>
                        <th>Téléphone</th>
                        <th>Articles</th>
                        <th>Total (F CFA)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ optional($order->user)->name ?? 'Inconnu' }}</td>
                            <td>{{ $order->phone_number ?? optional($order->user)->phone ?? '—' }}</td>
                            <td>{{ $order->items_count ?? $order->items->count() }}</td>
                            <td>{{ number_format($order->total, 2) }}</td>
                            <td>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Voulez-vous vraiment supprimer cette commande ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
