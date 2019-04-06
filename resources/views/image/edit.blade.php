@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar publicación
                </div>

                <div class="card-body">
                <form enctype="multipart/form-data" action="{{ route('image.update')}}" method="post">
                    @csrf
                    <input type="hidden" name="image_id" value="{{$image->id}}">
                    <div class="form-group row">
                        <label for="image_path" class="col-md-3 form-label text-md-right">Imagen</label>
                         <div class="col-md-7">

                            @if ($image->user->image)
                                <div class="container-avatar">
                                        <img class="avatar" src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="">
                                </div>
                            @endif 

                            <input required type="file" name="image_path" id="image_path" class="form-control {{$errors->has('content') ? 'is-invalid':'' }}">
                            @if ($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('image_path') }} </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-3 form-label text-md-right">Descripción:</label>
                         <div class="col-md-7">
                             <textarea required  name="description" id="description" class="form-control {{$errors->has('description') ? 'is-invalid':'' }}">{{ $image->description }}</textarea>                            
                             @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }} </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                         <div class="col-md-6 offset-md-3">
                            <input type="submit" value="Actualizar" class="btn-btn-primary">
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection