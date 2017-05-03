<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;

class Notes extends BasePage
{
    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return '/home';
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

    public function typeNote(Browser $browser, $title = null, $body = null)
    {
        $browser->type('@title', $title)
                ->type('@body', $body);
    }

    public function saveNote(Browser $browser)
    {
        $browser->press('SAVE');
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [
            '@title' => '#title',
            '@body'  => '#body',
        ];
    }
}
