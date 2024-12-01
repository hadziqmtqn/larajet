@extends('main')
@section('content')
    <div class="bg-light p-5 rounded">
        <h1>Letter</h1>
        <form action="{{ route('letter.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" class="form-control" id="category" placeholder="Category">
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" class="form-control" id="file" placeholder="File" accept=".docx">
            </div>
            <button type="submit" class="btn btn-lg btn-primary" role="button">Submit &raquo;</button>
        </form>
    </div>
    <div class="mt-4 mb-4">
        @include('session')
    </div>
    <table class="table table-striped mt-4" style="width: 100%">
        <thead>
        <tr>
            <th>Category</th>
            <th>File Url</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($letters as $letter)
            <tr>
                <td>{{ $letter->category }}</td>
                <td>
                    <a href="{{ $letter->getFirstMediaUrl('file') }}" class="btn btn-sm btn-success" target="_blank">Download</a>
                </td>
                <td>
                    <form action="{{ route('letter.destroy', $letter->slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection