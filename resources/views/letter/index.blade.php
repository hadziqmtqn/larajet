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
    <div class="bg-light p-5 rounded">
        <h1>Letter</h1>
        <form action="{{ route('letter-template.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="select-category" class="form-label">Category</label>
                <select name="category" id="select-category" class="form-select">
                    @foreach($letters as $letter)
                        <option value="{{ $letter->category }}">{{ $letter->category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" class="form-control" id="date" placeholder="Date">
            </div>
            <button type="submit" class="btn btn-lg btn-primary" role="button">Submit &raquo;</button>
        </form>
    </div>
    <table class="table table-striped mt-4" style="width: 100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>File Url</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($letterTemplates as $letterTemplate)
            <tr>
                <td>{{ $letterTemplate->name }}</td>
                <td>{{ $letterTemplate->email }}</td>
                <td>{{ \Carbon\Carbon::parse($letterTemplate->date)->isoFormat('DD MMM Y') }}</td>
                <td>
                    <a href="{{ $letterTemplate->getFirstMediaUrl('letters') }}" class="btn btn-sm btn-success" target="_blank">Download</a>
                </td>
                <td>
                    <form action="{{ route('letter-template.destroy', $letterTemplate->slug) }}" method="POST">
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