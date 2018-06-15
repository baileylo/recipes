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
                    <div class="card card-recipe">
                        @if ($recipe->image_url)
                            <a href="{{ route('recipes.show', $recipe) }}" name="{{ $recipe->title }}">
                                <img class="card-img-top" src="{{ $recipe->image_url }}" alt="{{ $recipe->title }}" />
                            </a>
                        @else
                            <a href="{{ route('recipes.show', $recipe) }}" name="{{ $recipe->title }}">
                                <div style="width: 100%; height: 0; padding-top:75%; background: #ccc"></div>
                            </a>
                        @endif
                        <div class="card-body">
                            <p class="card-text">
                                <a href="{{ route('recipes.show', $recipe) }}" name="{{ $recipe->title }}" class="text-muted">{{ $recipe->title }}</a>
                            </p>
                        </div>
                        <div class="card-footer text-muted text-right">
                            @if ($recipe->serves)
                                {{ $recipe->serves }} <i class="fas fa-users"></i>
                            @endif
                            @if ($recipe->oven_temperature)
                                {{ $recipe->oven_temperature }} <i class="fas fa-thermometer-three-quarters"></i>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
