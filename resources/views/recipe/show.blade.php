@extends('layouts.app')

@section('content')
    <div class="container">
        <header>
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $recipe->title }}</h1>
                    From: <span>{{ $recipe->source }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h1>{{ $recipe->serves }}</h1>
                    <small>serves</small>
                </div>
                <div class="col-lg-4">
                    <h1>{{ $recipe->cooking_time }}</h1>
                    <small>cooking time</small>
                </div>
                <div class="col-lg-4">
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
