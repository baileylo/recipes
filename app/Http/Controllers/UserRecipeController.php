<?php

namespace App\Http\Controllers;

use App\Image;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserRecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $recipes = $request->user()->recipes->load('lede', 'thumbnail')->map(function (Recipe $recipe) {
            $data = $recipe->toArray();
            $data['image_url'] = $recipe->thumbnail_url->width('600');

            return $data;
        });

        return view('user-recipe.index', [
            'recipes' => $recipes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Recipe $recipe)
    {
        if ($request->user()->id !== $recipe->user_id) {
            abort(403, 'You don\'t have access to this page.');
        }

        return view('user-recipe.edit', ['recipe' => $recipe]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        if ($request->user()->id !== $recipe->user_id) {
            abort(403, 'You don\'t have access to this page.');
        }

        $this->validate($request, [
            'title'            => 'string|required|max:255',
            'source'           => 'string|nullable|max:255',
            'serves'           => 'integer|min:1',
            'cooking_time'     => 'string|nullable|max:255',
            'oven_temperature' => 'integer|nullable|min:1',
            'ingredients'      => 'string|required',
            'directions'       => 'string|required',
            'image'            => 'image'
        ]);

        if ($request->hasFile('image')) {
            $image = Image::createFromUpload($request->file('image'), $request->user());

            $recipe->lede()->associate($image);
        }

        $recipe->update($request->only(
            'title',
            'source',
            'serves',
            'cooking_time',
            'oven_temperature',
            'ingredients',
            'directions'
        ));

        return redirect()->route('recipes.edit', $recipe)->with('interaction-notification', [
            'status'  => 'success',
            'message' => 'Recipe successfully updated!'
        ]);
    }

    public function create()
    {
        return view('user-recipe.create', ['recipe' => new Recipe]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title'            => 'string|required|max:255',
            'source'           => 'string|nullable|max:255',
            'serves'           => 'integer|nullable|min:1',
            'cooking_time'     => 'string|nullable|max:255',
            'oven_temperature' => 'integer|nullable|min:1',
            'ingredients'      => 'string|required',
            'directions'       => 'string|required',
            'image'            => 'image'
        ]);

        /** @var \App\User $user */
        /** @var \App\Recipe $recipe */
        $user   = $request->user();
        $recipe = $user->recipes()->create($request->only(
            'title',
            'source',
            'serves',
            'cooking_time',
            'oven_temperature',
            'ingredients',
            'directions'
        ));

        if ($request->hasFile('image')) {
            $image = Image::createFromUpload($request->file('image'), $request->user());

            $recipe->lede()->associate($image);
            $recipe->save();
        }

        return redirect()->route('recipes.edit', $recipe)->with('interaction-notification', [
            'status'  => 'success',
            'message' => "{$recipe->title} recipe created!"
        ]);
    }

    public function delete(Request $request, Recipe $recipe)
    {
        if (!$request->user()->can('delete', $recipe)) {
            return new Response('No access', 401);
        }

        $recipe->delete();
    }
}