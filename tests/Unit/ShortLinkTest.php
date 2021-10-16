<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortLinkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test to check
     * if link is shorten if not exists
     * @return void
     */
    public function test_can_shorten_a_link()
    {
        $formData = [
            'link' => 'http://testdomain.com',
        ];

        $this->post(route('shortlink.create'), $formData)->assertStatus(200);
    }

    /**
     * A basic unit test to check
     * if short link is displayed
     * if URL already shortened
     * @return void
     */
    public function test_display_shortlink_if_link_exists()
    {
        $formData = [
            'link' => 'http://testdomain.com',
        ];

        $this->post(route('shortlink.create'), $formData)->assertStatus(200);
    }

    /**
     * A basic unit test to check
     * if URL is displayed
     * in case of valid short URL
     * @return void
     */
    public function test_can_fetch_link_from_shortlink()
    {
        $this->get(route('shortlink.fetch.link', ['code' => 'AbcXyz']))->assertStatus(200);
    }

    /**
     * A basic unit test to check
     * if URL is not displayed
     * in case of invalid short URL
     * @return void
     */
    public function test_cannot_fetch_link_from_invalid_shortlink()
    {
        $this->get(route('shortlink.fetch.link', ['code' => 'invalid']))->assertStatus(404);
    }

    /**
     * A basic unit test to check
     * if hits are accessible
     * for a valid shortlink
     * @return void
     */
    public function test_can_fetch_hits_of_shortlink()
    {
        $this->get(route('shortlink.fetch.hits', ['code' => 'AbcXyz']))->assertStatus(200);
    }

    /**
     * A basic unit test to check
     * if hits are not accessible
     * for a invalid shortlink
     * @return void
     */
    public function test_cannot_fetch_hits_of_invalid_shortlink()
    {
        $this->get(route('shortlink.fetch.hits', ['code' => 'invalid']))->assertStatus(404);
    }
}
