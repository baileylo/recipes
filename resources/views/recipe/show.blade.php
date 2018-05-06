@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <header>
            <div class="row">
                <div class="col-md-12" style="background-image: url(https://food.fnr.sndimg.com/content/dam/images/food/fullset/2003/9/29/0/ig1a07_roasted_potatoes.jpg); background-size: cover; height: 690px; width: 1024px;position: relative;padding:0">
                    <div style="position: absolute; bottom: 0;background: black;opacity: .7;width:100%;color:white;text-align: right;padding-right:15px">
                        <h1>{{ $recipe->title }}</h1>
                        @if ($recipe->source)
                            <p>From: <span>{{ $recipe->source }}</span></p>
                        @endif
                    </div>
                </div>
            </div>
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
                    <h1>{{ $recipe->oven_temperature?: '&mdash;' }}</h1>
                    <small>Prehead Oven</small>
                </div>
            </div>
        </header>
        <section>
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
