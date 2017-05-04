<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Login extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/login';
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Sign In User
     *
     * @param  \Laravel\Dusk\Browser $browser
     * @param  string  $email
     * @param  string  $password
     * @return void
     */
    public function signIn(Browser $browser, $email = null, $password = null)
    {
        $browser->type('@email', $email)
                ->type('@password', $password)
                ->press('LOGIN');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@email'    => '#email',
            '@password' => '#password',
        ];
    }
}
