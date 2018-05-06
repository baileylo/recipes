@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('interaction-notification'))
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="alert alert-{{ session('interaction-notification')['status'] }}  alert-dismissible fade show" role="alert">
                        {{ session('interaction-notification')['message'] }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('recipes.create') }}">
            {!! csrf_field() !!}
            <div class="row">
                <div class="offset-lg-2 col-lg-8">

                    <?php var_dump($errors->toArray()); ?>

                    <fieldset>
                        <div style="position: absolute; right: 0; top:0;">
                            <small><a href="#">Import From URL</a></small>
                        </div>
                        <legend>Add Recipe</legend>

                        @include('user-recipe.form', ['recipe' => new \App\Recipe(), 'button' => 'Create', 'errors' => $errors])
                    </fieldset>
                </div>
            </div>
        </form>
    </div>
@endsection
