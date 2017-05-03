<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Register;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    /**
     * @test A User Can Register.
     *
     * @return void
     */
    public function aUserCanRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Register)
                    ->signUp('Antonio Muñoz', 'antonio@email.com', 'awesome')
                    ->assertPathIs('/home')
                    ->assertSeeIn('.uk-navbar', 'ANTONIO MUÑOZ');
        });
    }
}
