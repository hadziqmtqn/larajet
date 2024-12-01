@extends('main')
@section('content')
    <div class="bg-light p-5 rounded mb-4">
        <h1>Text Editor</h1>
        <form action="{{ route('texteditor.update', $texteditor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <div class="editor-container__menu-bar" id="editor-menu-bar"></div>
                <div class="editor-container__toolbar" id="editor-toolbar"></div>
                <div class="editor-container__editor-wrapper">
                    <div class="editor-container__editor">
                        <div id="editor"></div>
                        <textarea name="description" id="content" class="form-control editor-container__editor d-none">{!! $texteditor->description !!}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-lg btn-primary" role="button">Submit &raquo;</button>
            <a href="{{ route('texteditor.index') }}" class="btn btn-lg btn-secondary" role="button">Back &raquo;</a>
        </form>
    </div>
    <div class="bg-light p-5 rounded">
        {!! $texteditor->description !!}
    </div>
@endsection
