@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header">
                Stories
                @can('create', App\Story::class)
                    <a href="{{ route('stories.create') }}" class="float-right btn btn-sm btn-primary">Add</a>
                @endcan
            </div>
            <div class="card-body">

            <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $key => $story)
                            <tr>
                                <td>{{ $story->title }}</td>
                                <td>{{ $story->type }}</td>
                                <td>
                                    @if ($story->status === 1)
                                        <label class="badge badge-success">Active</label>
                                    @else
                                        <label class="badge badge-danger">Inactive</label>
                                    @endif
                        
                                </td>
                                <td>
                                    @can('view', $story)
                                        <a href="{{route('stories.show',[$story])}}" class="btn btn-sm btn-primary">view</a>
                                    @endcan
                                    @can('update', $story)
                                        <a href="{{route('stories.edit',[$story])}}" class="btn btn-sm btn-success">edit</a>
                                    @endcan
                                    @can('delete', $story)
                                        <form class="delete" style="display: inline-flex" action="{{ route('stories.destroy',[$story])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endcan
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $stories->links() }}

            </div>
        </div>
</div>
@endsection

