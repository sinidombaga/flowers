<?php
namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('example')]
class ExampleComponent
{
    public string $message;
}