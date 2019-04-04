@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                
            @include('includes.message')

            @foreach ($images as $image)
                
                <div class="card pub_image">
                    <div class="card-header">
                        @if ($image->user->image)
                            <div class="container-avatar">
                                    <img class="avatar" src="{{ route('user.avatar',[ $image->user->image ]) }}" alt=""/>
                            </div>
                        @endif  

                        <div class="data_user">
                            <a href="{{ route('image.detail', ['id' => $image->id] ) }}">
                                    {{$image->user->name.' '.$image->user->surname}}
                                    <span class="nickname">
                                            {{' | @'.$image->user->nick}}
                                    </span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <div class="image-container">
                                <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">
                        </div>

                        <div class="description">
                            <span class="nickname">
                                    {{ '@'.$image->user->nick}}
                            </span>

                            <span class="nickname">
                                    {{ ' | '.\FormatTime::LongTimeFilter($image->created_at)}}
                            </span>
                            <p>{{$image->description}}</p>    
                        </div>

                        <div class="likes">
                                <img src="{{ asset('img/like-gray.png') }}" alt="">
                        </div>
                        
                        <div class="comments">
                                <a class="btn btn-sm btn-warning btn-comments" href="">
                                        Comentarios ({{ count($image->comments) }})
                                </a>
                        </div> 
                    </div>
                </div>
            @endforeach
            <!--paginacion-->
            <div class="clearfix"></div>
                {{$images->links()}}
            </div>
    </div>
</div>
@endsection
