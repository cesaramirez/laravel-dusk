<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Notes;
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

    /**
     * @test A User Can Save A New Note
     *
     * @return void
     */
    public function aUserCanSaveANewNote()
    {
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->typeNote('One', 'Some body')
                    ->saveNote()
                    ->pause(500)
                    ->assertSeeIn('.uk-notification', 'Your new note has been saved.')
                    ->assertSeeIn('.uk-list', 'ONE')
                    ->assertInputValue('#title', 'One')
                    ->assertInputValue('#body', 'Some body');
        });
    }

    /**
     * @test A User Can Save A New Note
     *
     * @return void
     */
    public function aUserCanSeeTheWordCountOfTheirNote()
    {
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->typeNote('One', 'There are five words here')
                    ->assertSee('Word count: 5');
        });
    }

    /**
     * @test A User Can Save A New Note
     *
     * @return void
     */
    public function aUserCanStartAFreshNote()
    {
        $user = factory(User::class)->create();

        $this->browse(function(Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->typeNote('One', 'First Note')
                    ->saveNote()
                    ->pause(500)
                    ->clickLink('Create new note')
                    ->pause(500)
                    ->assertSeeIn('.uk-notification', 'A fresh note has been created.')
                    ->assertInputValue('#title', '')
                    ->assertInputValue('#body', '');
        });
    }
}
