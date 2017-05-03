<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     *@test A Dusk test example.
     *
     * @return void
     */
    public function aUserCanSignIn()
    {
        $user = factory(User::class)->create([
            'email'    => 'cesar@test.com',
            'password' => bcrypt('secret'),
            'name'     => 'Cesar Test'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('LOGIN')
                    ->assertPathIs('/home')
                    ->assertSeeIn('.uk-navbar', strtoupper($user->name));
        });
    }
}
