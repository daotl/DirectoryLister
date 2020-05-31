<?php

namespace Tests\Factories;

use App\Exceptions\InvalidConfiguration;
use App\Factories\TranslationFactory;
use Symfony\Component\Translation\MessageCatalogue;
use Tests\TestCase;

class TranslationFactoryTest extends TestCase
{
    public function test_it_registers_the_translation_component(): void
    {
        $translator = (new TranslationFactory($this->container, $this->cache))();

        $this->assertEquals('en', $translator->getLocale());
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('de'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('en'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('es'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('fr'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('id'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('it'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('kr'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('nl'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('pl'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('pt-BR'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('ro'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('ru'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('zh-CN'));
        $this->assertInstanceOf(MessageCatalogue::class, $translator->getCatalogue('zh-TW'));
    }

    public function test_it_throws_an_exception_for_an_invalid_language(): void
    {
        $this->expectException(InvalidConfiguration::class);

        $this->container->set('language', 'xx');
        (new TranslationFactory($this->container, $this->cache))();
    }
}
