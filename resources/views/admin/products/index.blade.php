@extends('layouts.app')

@section('content')
<div class="container">
   <h4>Product Lists</h4>
    <div class="mb-3">
        <form action="{{ route('admin.products.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search products..." value="{{ request()->query('search') }}">
            <br/>
            <button type="submit" class="btn btn-secondary">Search</button>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Product Owner</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->user->name }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                        @if($product->user)
                            <button class="btn btn-danger" onclick="alert('Product with ID {{ $product->id }} cannot be deleted because it has an owner.')" title="Cannot delete product with an owner">Delete</button>
                        @else
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mb-3">
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Create Product</a>
    </div>
</div>
@endsection

