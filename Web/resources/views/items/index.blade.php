<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Items</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Welcome, {{ Auth::user()->email }}</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('items.store') }}" method="POST" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="item" class="form-control" placeholder="Enter item" required>
                <button type="submit" class="btn btn-primary">Add Item</button>
            </div>
        </form>

        <ul class="list-group">
            @foreach($items as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $item->item }}</span>
                    <div>
                        <form action="{{ route('items.update', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <input type="text" name="item" value="{{ $item->item }}" required>
                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                        </form>

                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
