<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCategory()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/category');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Categories');
    }

    public function testPosts()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/posts');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Posts');
    }

    public function testPost()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/post/1');

        $this->assertSelectorTextContains('h1', 'PostTest');

        $link = $crawler
            ->filter('a:contains("Retour")') // find all links with the text "Retour"
            ->eq(0) // select the second link in the list
            ->link()
        ;
        $crawler = $client->click($link);

        $this->assertResponseIsSuccessful();
    }
}
