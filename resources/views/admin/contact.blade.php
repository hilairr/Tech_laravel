@extends('layouts.app')

@section('title')
    Messages des utilisateurs
@endsection

@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0">Messages reçus</h4>
                </div>
                <div class="card-body p-4">
                    @if ($messages->isEmpty())
                        <div class="alert alert-info text-center" role="alert">
                            Aucun message reçu pour le moment.
                        </div>
                    @else
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Sujet</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->name }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->subject }}</td>
                                        <td>{{ Str::limit($message->message, 50) }}</td>
                                        <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection