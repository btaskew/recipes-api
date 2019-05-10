<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RecipeTest extends TestCase
{
    /** @test */
    public function can_add_a_new_recipe()
    {
        $this->post('/recipes', ['name' => 'Test recipe'])
            ->seeInDatabase('recipes', ['name' => 'Test recipe'])
            ->assertResponseStatus(200);

        $this->assertContains('success', $this->response->content());
        $this->assertContains('recipe_id', $this->response->content());
    }

    /** @test */
    public function a_name_is_required_when_adding_a_recipe()
    {
        $this->post('/recipes', [])->assertResponseStatus(422);
    }
}
