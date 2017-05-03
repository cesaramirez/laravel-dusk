<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Register;
use Tests\DuskTestCase;

class NotesTest extends DuskTestCase
{
    /**
     * @test A User Should See No Notes When Starting Their Account.
     *
     * @return void
     */
    public function aUserShouldSeeNoNotesWhenStartingTheirAccount()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Register)
                    ->signUp('Antonio Muñoz', 'antonio@test.com', 'awesome')
                    ->assertPathIs('/home')
                    ->assertSee('No notes yet')
                    ->assertSeeIn('.uk-card', 'Untitled')
                    ->assertValue('#title', '')
                    ->assertValue('#body', '');
        });
    }
}
