<!--mostrar tarjeta de imagen (recibe objeto $imagen)-->
<div class="card pub_image">
        <div class="card-header">
            @if ($image->user->image)
                <div class="container-avatar">
                        <img class="avatar" src="{{ route('user.avatar',[ $image->user->image ]) }}" alt=""/>
                </div>
            @endif  

            <div class="data_user">
                <a href="{{ route('profile', ['id' => $image->user->id] ) }}">
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
                <?php $user_like = false; ?>

                @foreach ($image->likes as $like)
                    @if ($like->user->id == Auth::user()->id)
                       <?php $user_like = true; ?> 
                    @endif
                @endforeach

                @if ($user_like)
                    <img src="{{ asset('img/like-red.png') }}" data-id="{{$image->id}}" alt="" class="btn-dislike">   
                @else
                    <img src="{{ asset('img/like-gray.png') }}" data-id="{{$image->id}}" alt="" class="btn-like">
                @endif
                <span class="number_likes">
                        {{ count($image->likes) }}
                </span>
                
            </div>
            
            <div class="comments">
                    <a href="{{ route('image.detail', ['id' => $image->id] ) }}" class="btn btn-sm btn-warning btn-comments" href="">
                            Comentarios ({{ count($image->comments) }})
                    </a>
            </div> 
        </div>
</div>