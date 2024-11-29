@extends('layouts.app')

@section('content')
<div class="container">
   <h4>User Lists</h4>
   <div class="mb-3">
        <form action="{{ route('admin.users.index') }}" method="GET" class="form-inline">
            <input type="text" name="search" class="form-control mr-2" placeholder="Search user name..." value="{{ request()->query('search') }}">
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
                <th>Product Count</th>
                <th>Owner</th>
                <th>Is Admin</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->products->count() }}</td>
                    <td>
                        @if($user->products->isNotEmpty())
                            {{ $user->products->first()->user->name }}
                        @endif
                    </td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->created_at->format('M d, Y H:i, A') }}</td>
                    <td>{{ $user->updated_at->format('M d, Y H:i, A') }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#productsModal{{ $user->id }}">
                            <i class="fas fa-box-open"></i> Products
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="productsModal{{ $user->id }}" tabindex="-1" aria-labelledby="productsModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="productsModalLabel{{ $user->id }}">Products of {{ $user->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                                        @if($user->products->isNotEmpty())
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($user->products as $product)
                                                        <tr>
                                                            <td>{{ $product->name }}</td>
                                                            <td>${{ $product->price }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <p>No products found for this user.</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection