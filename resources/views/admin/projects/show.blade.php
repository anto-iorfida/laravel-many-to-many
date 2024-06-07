@extends('layouts.admin')

@section('content')
    @if (session('project_create'))
        <div class="mess-info">Progetto creato con successo!</div>
    @endif

    @if (session('project_edit'))
        <div class="mess-info">Progetto modificato con successo!</div>
    @endif

    <h2>Titolo: {{ $project->name }}</h2>


    <div>
        <strong>Tipo:</strong> {{ $project->type ? $project->type->name : 'non ha un tipo' }}
    </div>

    <div>
        <strong>Technologies</strong>:
        @if (count($project->technologies) > 0)
            @foreach ($project->technologies as $technology)
                {{ $technology->name }}@if (!$loop->last),@endif
            @endforeach
        @else
            none
        @endif
        {{-- @dump($project->technologies) --}}
    </div>

    <div>
        <strong>Slug:</strong> {{ $project->slug }}
    </div>

    <div>
        <strong>data created:</strong> {{ $project->created_at }}
    </div>
    <div>
        <strong>data updated:</strong> {{ $project->updated_at }}
    </div>

    {{-- @dump($project->cover_image); --}}
    @if ($project->cover_image)
        <div>
            <img src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->name }}">
        </div>
    @endif

    @if ($project->summary)
        <p><strong>Summary: </strong>{{ $project->summary }}</p>
    @endif

    <div class="icon-show">
        <div><a href="{{ route('admin.project.index') }}"><i class="fa-solid fa-arrow-left"></i></a></div>
        <div><a href="{{ route('admin.project.edit', ['project' => $project->id]) }}"><i
                    class="fa-solid fa-pen-to-square"></i></a></div>
    </div>
@endsection
