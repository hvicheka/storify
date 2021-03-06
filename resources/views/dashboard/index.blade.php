@extends('layouts.app')

@section('content')
<div class="container">
        <div class="card">
            <div class="card-header">
                Home Page
                <div class="float-right">
                    <a href="{{ route('dashboard.index') }}">All</a> |
                    <a href="{{ route('dashboard.index',['type'=> 'short']) }}">Short</a> | 
                    <a href="{{ route('dashboard.index',['type'=> 'long']) }}">Long</a>
                </div>
            </div> 
            <div class="card-body">

            <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Type</th>
                                <th>Author</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stories as $key => $story)
                            <tr>
                                <td>
                                    <a href="{{ route('dashboard.show',[$story]) }}">
                                        {{ $story->title }}
                                    </a>
                                </td>
                                <td>{{ $story->type }}</td>
                                <td>{{ $story->user->name }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $stories->withQueryString()->links() }}
            </div>
        </div>
</div>
@endsection

{{-- {{ dd(DB::getQueryLog()) }} --}}

