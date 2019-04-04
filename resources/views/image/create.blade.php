@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Subir nueva imagen
                </div>

                <div class="card-body">
                <form enctype="multipart/form-data" action="{{route('image.save')}}" method="post">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="image_path" class="col-md-3 form-label text-md-right">Imagen</label>
                         <div class="col-md-7">
                             <input required type="file" name="image_path" id="image_path" class="form-control">
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
                             <textarea required  name="description" id="description" class="form-control"></textarea>                            
                             @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }} </strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                         <div class="col-md-6 offset-md-3">
                            <input type="submit" value="Subir imagen" class="btn-btn-primary">
                        </div>
                    </div>

                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection