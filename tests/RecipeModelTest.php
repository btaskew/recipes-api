<?php

use App\Ingredient;
use App\Recipe;

class RecipeModelTest extends TestCase
{
    /** @test */
    public function a_recipe_has_ingredients()
    {
        $recipe = factory(Recipe::class)->create();
        $ingredient = factory(Ingredient::class)->create(['recipe_id' => $recipe->id]);

        $this->assertTrue($recipe->ingredients->first()->is($ingredient));
    }
}
