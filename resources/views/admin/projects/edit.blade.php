@extends('layouts.admin')

@section('content')
    
    <h2>Modifica il Progetto: {{ $project->name }}</h2>

    <form action="{{ route('admin.project.update', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')


        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $project->name) }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="type_id" class="form-label">Tipo</label>
            <select class="form-control" id="type_id" name="type_id">
                <option value="">Seleziona il tipo</option>
                @foreach ($types as $type)
                    <option @selected($type->id == old('type_id',$project->type_id) ) value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        @error('type_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3 mt-4">
            <h5>Tags</h5>

            @foreach ($technologies as $technology)
                <div class="form-check">
                    @if ($errors->any())
                        {{-- se cis sono errori di validazione vuol dire che l'utente ha gia inviato il form quindi controllo l'old --}}
                        <input class="form-check-input" @checked(in_array($technology->id, old('technologies', []))) type="checkbox" name="technologies[]" value="{{ $technology->id }}" id="technology-{{ $technology->id }}">
                    @else
                        {{-- altrimenti vuol dire che stiamo caricando la pagina per la prima volta quindi controlliamo la presenza del technology nella collection che ci arriva dal db --}}
                        <input class="form-check-input" @checked($project->technologies->contains($technology)) type="checkbox" name="technologies[]" value="{{ $technology->id }}" id="technology-{{ $technology->id }}">
                    @endif
                    
                    <label class="form-check-label" for="technology-{{ $technology->id }}">
                    {{ $technology->name }}
                    </label>
                </div>
            @endforeach
        </div>

        
        <div class="mb-3">
            <label for="cover_image" class="form-label">Immagine</label>
            <input class="form-control" type="file" id="cover_image" name="cover_image">
            @if ($project->cover_image)
                <div>
                    <img width="200" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}">
                </div>
            @else
                <small>Nessuna immagine caricata</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="client_name" class="form-label">Cliente</label>
            <input type="text" class="form-control" id="client_name" name="client_name"
                value="{{ old('client_name', $project->client_name) }}">
        </div>
        @error('client_name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3">
            <label for="summary" class="form-label">Contenuto Progetto</label>
            <textarea class="form-control" id="summary" rows="10" name="summary">{{ old('summary', $project->summary) }}</textarea>
        </div>
        @error('summary')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary">Modifica</button>
        <a href="{{ route('admin.project.index') }}"  class="btn btn-primary">Indietro</a>
    </form>
@endsection
