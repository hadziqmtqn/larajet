@extends('main')
@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Text Editor</h1>
        <form action="{{ route('texteditor.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <div class="editor-container__menu-bar" id="editor-menu-bar"></div>
                <div class="editor-container__toolbar" id="editor-toolbar"></div>
                <div class="editor-container__editor-wrapper">
                    <div class="editor-container__editor">
                        <div id="editor"></div>
                        <textarea name="description" id="content" class="form-control editor-container__editor d-none">{!! old('description') !!}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary" role="button">Submit &raquo;</button>
        </form>
    </div>
    <table class="table table-striped mt-4" style="width: 100%">
        <thead>
        <tr>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($texteditors as $texteditor)
            <tr>
                <td>{{ Str::limit(strip_tags($texteditor->description), 50) }}</td>
                <td><a href="{{ route('texteditor.edit', $texteditor->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
