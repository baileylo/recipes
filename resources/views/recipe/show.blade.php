@extends('layouts.app')

@section('top-padding', '')

@section('content')
    <header class="container-fluid">
            <div class="row">
                <div class="col-md-12 permalink-lede-image" style="background-image: url({{ config('app.url') }}/{{ $recipe->image_url->w(1247)->h(701)->fit('crop')->dpr(2) }});" >
                    <div style="position: absolute; bottom: 0;background: black;opacity: .7;width:100%;color:white;text-align: right;padding-right:15px">
                        <h1>{{ $recipe->title }}</h1>
                        @if ($recipe->source)
                            <p>From: <span>{{ $recipe->source }}</span></p>
                        @endif
                    </div>
                </div>
            </div>
    </header>
    <section class="container-fluid recipe-view-highlight" style="background: white;border-top-width: 2px; border-bottom-width: 2px; border-color: #fff">
        <div class="row">
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->serves }}</h1>
                <small>serves</small>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->cooking_time }}</h1>
                <small>cooking time</small>
            </div>
            <div class="col-lg-4" style="text-align: center">
                <h1>{{ $recipe->oven_temperature?: '—' }}</h1>
                <small>Prehead Oven</small>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                {!! nl2br($recipe->ingredients) !!}
            </div>
            <div class="col-md-8">
                {!! nl2br($recipe->directions) !!}
            </div>
        </div>
    </section>
    </div>
@endsection
