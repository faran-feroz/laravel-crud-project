<html>
<head>
    <title>List Books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row">
        <h2 class="col-md-6">Book listing</h2>
        <a class="btn btn-primary" href="{{ url('/create/books') }}"
           style="float: right; margin-top: 20px; margin-bottom: 4px; margin-right: 15px;">Add Book</a>
    </div>

    @if(session()->has('message'))
        <div class="alert alert-success">
            <p>{{ session()->get('message') }}</p>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="alert alert-danger">
            <p>{{ session()->get('error') }}</p>
        </div>
    @endif

    <table class="table">
        <thead>
        <tr>
            <th>Sr#</th>
            <th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $key => $book)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->price }}</td>
                <td>
                    <a href="{{ url('/edit/books', ['id' => $book->id]) }}" class="btn btn-sm btn-default"
                       style="float: left; margin-right: 4px;">Edit</a>
                    <form action="{{ url('delete/book', ['id' => $book->id]) }}" method="post">
                        <input class="btn btn-sm btn-default" type="submit" value="Delete"/>
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endpush
</body>

</html>
