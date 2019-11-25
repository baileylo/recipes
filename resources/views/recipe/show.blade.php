@extends('layouts.app')

@section('top-padding', '')

@section('content')
    <header class="container-fluid">
            <div class="row">
                @if ((string)$recipe->image_url)
                    <div class="permalink-lede-image">
                        <div class="col-md-12" style="background-image: url({{ config('app.url') }}/{{ $recipe->image_url->w(1247)->h(701)->fit('crop')->dpr(2) }});" >
                            <div>
                                <h1>{{ $recipe->title }}</h1>
                                @if ($recipe->source)
                                    <p>From: <span>{{ $recipe->source }}</span></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                <div class="col-md-12 pt-3">
                    <h1>{{ $recipe->title }}</h1>
                    @if ($recipe->source)
                        <p>From: <span>{{ $recipe->source }}</span></p>
                    @endif
                </div>
                @endif
                </div>
            </div>
    </header>
    <section class="container-fluid recipe-view-highlight" style="background: white;border-top-width: 2px; border-bottom-width: 2px; border-color: #fff">
        <div class="row p-3">
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->serves?: '—' }}</h1>
                <small>serves</small>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->cooking_time?: '—' }}</h1>
                <small>cooking time</small>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->oven_temperature?: '—' }}</h1>
                <small>Preheat Oven</small>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row mt-5">
            <div class="col-md-3">
                <h5>Ingredients</h5>
                <ol class="list-unstyled">
                @foreach (explode("\n", $recipe->ingredients) as $ingredient)
                    <li class="pb-2">{{ $ingredient }}</li>
                @endforeach
                </ol>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h5>Directions</h5>
                <article class="lead">
                    {!! nl2br($recipe->directions) !!}
                </article>

            </div>
        </div>
    </section>
@endsection
