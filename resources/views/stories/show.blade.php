@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    {{ $story->title }}

                    <a href="{{ route('stories.index') }}" class="float-right btn btn-sm btn-primary">Back</a>
                </div>
                <div class="card-body">
                    {{ $story->body }}
                    <p >
                        <span class="font-weight-bold">Status :</span> {{ $story->status == 1 ? 'active' : 'inactive' }}
                        <span class="font-weight-bold">Type :</span> {{ $story->type }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
