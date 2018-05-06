@extends('layouts.app')

@section('content')
    <div class="container">
        <my-recipe-list></my-recipe-list>
    </div>

    <script type="application/javascript">
        window.myRecipes = @json($recipes);
    </script>
@endsection
