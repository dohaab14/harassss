@extends('layouts.app')

@section('content')
    <h1>Ajouter un Soin Vétérinaire</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('soins.ajouter') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_vet">Vétérinaire</label>

            <select name="id_vet" id="id_vet" class="form-control" required>
                <option value="">Sélectionner un vétérinaire</option>
                @foreach ($veterinaires as $veterinaire)
                    <option value="{{ (string) $veterinaire->id_vet }}" {{ (string) old('id_vet') === (string) $veterinaire->id_vet ? 'selected' : '' }}>
                        {{ $veterinaire->nom_vet }}
                    </option>

                @endforeach
            </select>


        </div>

        <div class="form-group">
            <label for="id_cheval">Cheval</label>
            <select name="id_cheval" id="id_cheval" class="form-control" required>
                <option value="">-- Sélectionner un cheval --</option>
                @foreach ($chevaux as $cheval)
                    <option value="{{ $cheval->id_cheval }}" {{ old('id_cheval') == $cheval->id_cheval ? 'selected' : '' }}>
                        {{ $cheval->nom_cheval }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_soin">Date du soin</label>
            <input type="date" name="date_soin" id="date_soin" class="form-control" value="{{ old('date_soin') }}" required>
        </div>

        <div class="form-group">
            <label for="nature_soin">Nature du soin</label>
            <input type="text" name="nature_soin" id="nature_soin" class="form-control" value="{{ old('nature_soin') }}"
                required>
        </div>
        <br>
        <button type="submit" class="btn btn-success">Ajouter le soin</button>
        <a href="{{ route('soins.index') }}" class="btn btn-outline-secondary  card-btn-hover">
            <i class="fas fa-calendar-day"></i> 
            Voir les soins
        </a>
    </form>
@endsection