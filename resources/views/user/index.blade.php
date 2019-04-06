@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <h1>Gente</h1> 
        <form id="buscador" action="{{ route('user.index')}}" method="get">
            <div class="row">
                    <div class="form-group col-md-10">
                            <input autocomplete="off" placeholder="Buscar personas" type="text" id="search" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                        <input class="btn btn-success btn-search" type="submit" value="Buscar">
                    </div>
            </div>
        </form>
            <hr>
            @foreach ($users as $user)
                <div class="profile-user">
                        @if ($user->image)
                            <div class="container-avatar">
                                    <img class="avatar" src="{{ route('user.avatar',[ $user->image ]) }}" alt=""/>
                            </div>
                        @endif
                    <div class="user-info">
                        <h2>{{ '@' .$user->nick }}</h2>
                        <h3>{{ $user->name .' '.$user->surname }}</h3>
                        <p>{{'Se unió' .\FormatTime::LongTimeFilter($user->created_at) }}</p>
                    <a href="{{ route('profile', ['id'=> $user->id]) }}" class="btn btn-success">Visitar perfil</a>
                    </div> 
                    <div class="clearfix"></div>
                    <hr>
                </div>
            @endforeach
            <!--paginacion de objeto users-->
            <div class="clearfix"></div>
                {{$users->links()}}
            </div>
    </div>
</div>
@endsection
