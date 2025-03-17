@extends('layouts.app')

@section('content')
    <h1>Modifier le soin vétérinaire</h1>

    <form action="{{ route('soins.mettreAJour', $soin->id_soin) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_vet">Vétérinaire</label>
            <select name="id_vet" id="id_vet" class="form-control" required>
                @foreach ($veterinaires as $veterinaire)
                    <option value="{{ $veterinaire->id_vet }}" 
                        {{ $soin->id_vet == $veterinaire->id_vet ? 'selected' : '' }}>
                        {{ $veterinaire->nom_vet }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="id_cheval">Cheval</label>
            <select name="id_cheval" id="id_cheval" class="form-control" required>
                @foreach ($chevaux as $cheval)
                    <option value="{{ $cheval->id_cheval }}" 
                        {{ $soin->id_cheval == $cheval->id_cheval ? 'selected' : '' }}>
                        {{ $cheval->nom_cheval }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date_soin">Date du soin</label>
            <input type="date" name="date_soin" class="form-control" value="{{ $soin->date_soin }}" required>
        </div>

        <div class="form-group">
            <label for="nature_soin">Nature du soin</label>
            <input type="text" name="nature_soin" class="form-control" value="{{ $soin->nature_soin }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
