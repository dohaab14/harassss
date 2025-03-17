@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Palmarès du cheval {{ $cheval->nom_cheval }}</h2>
    
    <a class="nav-link" href="{{ url('/palmares') }}">Liste de tous les palmarès</a>

    @if($palmares->isEmpty())
        <p>Aucun palmarès disponible pour ce cheval :/</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Rang</th>
                    <th>Compétition</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($palmares as $p)
                    <tr>
                        <td>{{ $p->rang }}</td>
                        <td>{{ $p->competition->nom_compet }}</td>
                        <td>{{ $p->competition->date_compet }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
