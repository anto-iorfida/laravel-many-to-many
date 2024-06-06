@extends('layouts.admin')

@section('content')
    <h1>Tutti i progetti</h1>
    @if (session('project_deleted'))
        <div class="mess-info">Progetto eliminato con successo!</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    <input type="checkbox" id="selectAllCheckbox">
                </th>
                <th>ID</th>
                <th>Name</th>
                {{-- <th>Slug</th> --}}
                <th>Client Name</th>
                <th>Summary</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        <input type="checkbox" class="deleteCheckbox" name="project_ids[]" value="{{ $project->id }}">
                    </td>
                    <td>{{ $project->id }}</td>
                    <td>{{ $project->name }}</td>
                    {{-- <td>{{ $project->slug }}</td> --}}
                    <td>{{ $project->client_name }}</td>
                    <td>{{ $project->summary }}</td>

                    <td>
                        <div class="icon-colum">

                            <div>
                                <a href="{{ route('admin.project.show', ['project' => $project->id]) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </div>

                            <div>
                                <a href="{{ route('admin.project.edit', ['project' => $project->id]) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </div>

                            <div>
                                <form id="delete-form-{{ $project->id }}"
                                    action="{{ route('admin.project.destroy', ['project' => $project->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a type="submit" data-project-name="{{ $project->name }}" class="js-delete-btn">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </form>
                            </div>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button type="submit" id="deleteSelectedButton">Elimina Selezionati</button>
@endsection
