@extends('layouts.app')

@section('content')
<div class="container">
    <section>
        <div class="row mb-5 mt-4">
            <div class="col-lg-12">
                <form class="form">
                    <div role="search">
                        <div class="input-group input-group-lg">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="search" class="form-control" placeholder="Search all recipes" aria-label="Search Recipes" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-columns">
                    @foreach($recipes as $recipe)
                    <div class="card">
                        @if ($recipe->image_url)
                            <img class="card-img-top" src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" />
                        @else
                            <div style="width: 100%; height: 0; padding-top:75%; background: #ccc"></div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-text">
                                <a href="#" name="{{ $recipe->title }}">{{ $recipe->title }}</a>
                            </h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
