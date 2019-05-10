<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Routing\Controller;

class IngredientRecipesController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function show(Request $request)
    {
        $ingredient = $this->validate($request, [
            'ingredient' => 'required|string'
        ])['ingredient'];

        return Recipe::whereHas('ingredients', function ($query) use ($ingredient) {
            $query->where('name', $ingredient);
        })->get();
    }
}
