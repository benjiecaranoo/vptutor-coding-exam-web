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
                <th>Created At</th>
                <th>Updated At</th>
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
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
</div>
@endsection