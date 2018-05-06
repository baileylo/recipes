<div class="form-row">
    <div class="form-group col-md-12">
        <label for="recipe-title">Title</label>
        <input type="text" class="form-control" id="recipe-title" name="title"
               value="{{ old('title', $recipe->title) }}">
        @if ($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-3">
        <label for="recipe-source">Source</label>
        <input type="text" class="form-control" id="recipe-source" placeholder="Aunt Banana"
               name="source" value="{{ old('source', $recipe->source) }}">
        @if ($errors->has('source'))
            <div class="invalid-feedback">{{ $errors->first('source') }}</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        <label for="recipe-serves">Serves</label>
        <input type="number" class="form-control" id="recipe-serves" name="serves"
               value="{{ old('serves', $recipe->serves) }}">
        @if ($errors->has('serves'))
            <div class="invalid-feedback">{{ $errors->first('serves') }}</div>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="recipe-cooking-time">Cooking Time</label>
        <input type="text" class="form-control" id="recipe-cooking-time" name="cooking_time"
               value="{{ old('cooking_time', $recipe->cooking_time) }}">
        @if ($errors->has('cooking_time'))
            <div class="invalid-feedback">{{ $errors->first('cooking_time') }}</div>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label for="recipe-oven-temperature">Oven Temperature</label>
        <input type="number" class="form-control" id="recipe-oven-temperature"
               name="oven_temperature"
               value="{{ old('oven_temperature', $recipe->oven_temperature) }}">
        @if ($errors->has('oven_temperature'))
            <div class="invalid-feedback">{{ $errors->first('oven_temperature') }}</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="recipe-ingredients">Ingredients</label>
        <textarea name="ingredients" id="recipe-ingredients" class="form-control" cols="30"
                  rows="10">{{ old('ingredients', $recipe->ingredients) }}</textarea>
        @if ($errors->has('ingredients'))
            <div class="invalid-feedback">{{ $errors->first('ingredients') }}</div>
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        <label for="recipe-directions">Directions</label>
        <textarea name="directions" id="recipe-directions" class="form-control" cols="30"
                  rows="10">{{ old('directions', $recipe->directions) }}</textarea>
        @if ($errors->has('directions'))
            <div class="invalid-feedback">{{ $errors->first('directions') }}</div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-md-right">
        <p class="">
            <a href="{{ route('my-recipes') }}" class="btn btn-warning">Cancel</a>
            <button type="submit" class="btn btn-primary">{{ $button }}</button>
        </p>
    </div>
</div>