<?php

namespace Tests\Browser;

use App\Note;
use App\User;
use Carbon\Carbon;
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
                    ->assertSeeIn('.uk-notification',
                                  'Your new note has been saved.')
                    ->assertSeeIn('.uk-list', 'ONE')
                    ->assertInputValue('#title', 'One')
                    ->assertInputValue('#body', 'Some body');
        });
    }

    /**
     * @test A User Can See The Word Count Of Their Note
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
     * @test A User Can Start A Fresh Note
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
                    ->assertSeeIn('.uk-notification',
                                  'A fresh note has been created.')
                    ->assertInputValue('#title', '')
                    ->assertInputValue('#body', '');
        });
    }

    /**
     * @test A Users Current Note Is Saved When Starting A New Note
     *
     * @return void
     */
    public function aUsersCurrentNoteIsSavedWhenStartingANewNote()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->typeNote('One', 'First Note')
                    ->saveNote()
                    ->pause(500)
                    ->type('#title', 'One updated')
                    ->type('#body', 'First note updated')
                    ->clickLink('Create new note')
                    ->pause(500)
                    ->assertSeeIn('.uk-list', 'ONE UPDATED')
                    ->clickLink('One updated')
                    ->pause(500)
                    ->assertInputValue('#title', 'One updated')
                    ->assertInputValue('#body', 'First note updated');
        });
    }

    /**
     * @test A User Cant Save Note With No Title
     *
     * @return void
     */
    public function aUserCantSaveNoteWithNoTitle()
    {
        $user = factory(User::class)->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->saveNote()
                    ->pause(500)
                    ->assertMissing('.uk-notification')
                    ->assertSee('No notes yet')
                    ->assertDontSeeIn('.notes', 'You have one note')
                    ->assertMissing('.notes ul li:nth-child(2)');
        });
    }

    /**
     * @test A User Can Open A Previous Note
     *
     * @return void
     */
    public function aUserCanOpenAPreviousNote()
    {
        $user = factory(User::class)->create();
        $note = factory(Note::class)->create([
            'user_id' => $user->id
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->pause(1000)
                    ->clickLink($note->title)
                    ->pause(500)
                    ->assertInputValue('#title', $note->title)
                    ->assertInputValue('#body', $note->body);
        });
    }

    /**
     * @test A User Can Delete Notes
     *
     * @return void
     */
    public function aUserCanDeleteNotes()
    {
        $user = factory(User::class)->create();
        $notes = factory(Note::class, 2)->create([
            'user_id' => $user->id
        ]);

        $this->browse(function (Browser $browser) use ($user, $notes) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->pause(500);

            foreach ($notes as $note) {
                $browser->click('.notes .uk-list > li:nth-child(2)
                                 a:nth-child(2)')
                        ->pause(500)
                        ->assertSeeIn('.uk-notification',
                                      'Your note has been deleted.')
                        ->assertDontSeeIn('.notes', $note->title);
            }

            $browser->pause(500)
                    ->assertSeeIn('.notes', 'No notes yet');
        });
    }

    /**
     * @test A Users Note Is Cleared When Deleted If Currently Being Viewed
     *
     * @return void
     */
    public function aUsersNoteIsClearedWhenDeletedIfCurrentlyBeingViewed()
    {
        $user = factory(User::class)->create();
        $note = factory(Note::class)->create([
            'user_id' => $user->id
        ]);

        $this->browse(function (Browser $browser) use ($user, $note) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->pause(500)
                    ->clickLInk($note->title)
                    ->pause(500)
                    ->click('.notes .uk-list > li:nth-child(2) a:nth-child(2)')
                    ->assertInputValue('#title', '')
                    ->assertInputValue('#body', '');
        });
    }

    /**
     * @test A Users Notes Are Ordered By Last Updated In Descending Order
     *
     * @return void
     */
    public function aUsersNotesAreOrderedByLastUpdatedInDescendingOrder()
    {
        $user = factory(User::class)->create();
        $notes = factory(Note::class, 3)->create([
            'user_id'    => $user->id,
            'updated_at' => Carbon::now()->subDays(2)
        ]);

        $this->browse(function (Browser $browser) use ($user, $notes) {
            $browser->loginAs($user)
                    ->visit(new Notes)
                    ->pause(500)
                    ->screenshot('before_sorting');

            foreach ($notes as $note) {
                $browser->clickLink($note->title)
                        ->pause(500)
                        ->typeNote($newTitle = $note->title . ' updated',
                                   'Woo')
                        ->pause(500)
                        ->saveNote()
                        ->pause(1000)
                        ->assertSeeIn('.notes .uk-list > li:nth-child(2)',
                                      strtoupper($newTitle));
            }

            $browser->screenshot('after_sorting');
        });
    }
}
