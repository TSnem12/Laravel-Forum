@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">Add Disccussion</div>

    <div class="card-body">
        
        <form action="{{ route('discussions.store') }}" method="POST">
        
            @csrf
            <div class="form-group">

                <label for="title">Title</label>

                <input id="title" name="title" class="form-control" type="text" value="">

            </div>

            <div class="form-group">

                <label for="content">Content</label>

                
                <input id="contet" type="hidden" name="content">
                <trix-editor input="content"></trix-editor>
                

                <textarea id="content" name="content" cols="5" rows="5" class="form-control"></textarea>

            </div>

            <div class="form-group">
            
                <label for="channel">Channel</label>

                <select class="form-control" name="channel" id="channel">
                    
                    @foreach($channels as $channel)
                    
                        <option value="{{ $channel->id }}">

                            {{ $channel->name }}

                        </option>
                
                    @endforeach
                </select>

            </div>
            
            
            <button type="submit" class="btn btn-success">Create Discussion</button>

        </form>
    
    </div>
</div>
@endsection


@section('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.min.css">

@endsection


@section('js')

<script src="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.umd.min.js"></script>

@endsection