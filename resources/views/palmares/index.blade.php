@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Palmarès des chevaux</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Rang</th>
                <th>Cheval</th>
                <th>Compétition</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($palmares as $p)
                <tr>
                    <td>{{ $p->rang }}</td>
                    <td>
                        <a href="{{ route('palmares.show', ['id_cheval' => $p->cheval->id_cheval]) }}">
                            {{ $p->cheval->nom_cheval }}
                        </a>
                    </td>
                    <td>{{ $p->competition->nom_compet }}</td>
                    <td>{{ $p->competition->date_compet }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
