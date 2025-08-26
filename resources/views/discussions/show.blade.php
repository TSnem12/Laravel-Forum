@extends('layouts.app')

@section('content')


<div class="card">
    
    @include('partials.discussion-header')

    <div class="card-body">
    
        <div class="text-center">
                
            <strong>
                {{ $discussion->title }}
            </strong>
        
        </div>


        <hr>

        {!! $discussion->content !!}

        @if($discussion->bestReply)

            <div class="card card-success my-5">

                <div class="card-header" style="color: blue; font-weight: bold">
                    
                    <div class="d-flex justify-content-between">
                
                        <div>
                            <img class="mr-2" src="{{ Gravatar::src($discussion->BestReply->owner->email) }}" style="border-radius: 50%" width="40px" height="40px" alt="">
        
                            <strong>{{ $discussion->BestReply->owner->name }}</strong>
                        </div>    
                    

                        <div class="mt-2">

                            <strong>Best Reply</strong>

                        </div>    

                    </div>    
                
                </div>


                <div class="card-body">

                    {!! $discussion->bestReply->content !!}

                </div>    

            </div>

        @endif

    </div>
</div>



@foreach($discussion->replies()->paginate(3) as $reply)

    <div class="card my-5">

        <div class="card-header">
            
            <div class="d-flex justify-content-between">
                
                <div>
                    <img src="{{ Gravatar::src($reply->owner->email) }}" style="border-radius: 50%" width="40px" height="40px" alt="">

                    <span>{{ $reply->owner->name }}</span>
                </div>    
            
                <div>

                    @if(auth()->user()->id === $discussion->user_id)
                        <form action="{{ route('discussions.best-reply', ['discussion' => $discussion->slug, 'reply' => $reply->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm">Mark as best reply</button>
                         
                        </form>    
                    
                    @endif    
                
                </div>


            </div>    
        </div>


        <div class="card-body">

            {!! $reply->content !!}

        </div>    

    </div>  
        
@endforeach

{{ $discussion->replies()->paginate(3)->links() }}
  



<div class="card my-5">
    
    <div class="card-header">

        Add a reply

    </div>    

    <div class="card-body">
    
      @auth  
      
        <form action="{{ route('replies.store', $discussion->slug) }}" method="POST">
            
            @csrf
            <input type="hidden" name="content" id="content">  
            
            <trix-editor input="content"></trix-editor>

            <button type="submit" class="btn btn-success btn-sm my-2">Add reply</button>
        </form>


       @else

        <a href="{{ route('login') }}" class="btn btn-info" style="color: #fff">Sign in to add a reply</a>

       @endauth

    </div>
</div>

@endsection





@section('css')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.min.css">

@endsection


@section('js')

    <script src="https://cdn.jsdelivr.net/npm/trix@2.1.15/dist/trix.umd.min.js"></script>

@endsection



