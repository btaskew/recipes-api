<?php

use App\Ingredient;
use App\Recipe;

class IngredientTest extends TestCase
{
    /** @test */
    public function can_add_an_ingredient_to_a_recipe()
    {
        $recipe = factory(Recipe::class)->create();

        $this->post('recipes/' . $recipe->id . '/ingredients', ['name' => 'Test ingredient'])
            ->seeInDatabase('ingredients', ['name' => 'Test ingredient', 'recipe_id' => $recipe->id])
            ->assertResponseStatus(200);

        $this->assertContains('success', $this->response->content());
    }

    /** @test */
    public function a_name_is_required_when_adding_an_ingredient()
    {
        $recipe = factory(Recipe::class)->create();

        $this->post('recipes/' . $recipe->id . '/ingredients', [])->assertResponseStatus(422);
    }

    /** @test */
    public function cant_add_same_ingredient_twice_to_the_same_recipe()
    {
        $recipe = factory(Recipe::class)->create();
        $ingredient = factory(Ingredient::class)->create(['recipe_id' => $recipe->id]);

        $this->post('recipes/' . $recipe->id . '/ingredients', ['name' => $ingredient->name])
            ->assertResponseStatus(422);

        $this->assertContains('Ingredient present', $this->response->content());
    }
}
