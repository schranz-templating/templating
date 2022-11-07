<?php

declare(strict_types=1);

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
            'plates' => [
                'extension' => 'php',
            ],
            'twig' => [
                'extension' => 'html.twig',
            ],
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\TemplateTwigHandler::class => Handler\TemplateTwigHandler::class,
                Handler\TemplatePlatesHandler::class => Handler\TemplatePlatesHandler::class,
                Handler\TemplateHandlebarsHandler::class => Handler\TemplateHandlebarsHandler::class,
                Handler\TemplateMustacheHandler::class => Handler\TemplateMustacheHandler::class,
                Handler\TemplateSmartyHandler::class => Handler\TemplateSmartyHandler::class,
                Handler\TemplateMezzioHandler::class => Handler\TemplateMezzioHandler::class,
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories' => [
                Handler\TemplateHandler::class => Handler\TemplateHandlerFactory::class,
                Handler\TemplateTwigHandler::class => Handler\TemplateTwigHandlerFactory::class,
                Handler\TemplatePlatesHandler::class => Handler\TemplatePlatesHandlerFactory::class,
                Handler\TemplateHandlebarsHandler::class => Handler\TemplateHandlebarsHandlerFactory::class,
                Handler\TemplateMustacheHandler::class => Handler\TemplateMustacheHandlerFactory::class,
                Handler\TemplateSmartyHandler::class => Handler\TemplateSmartyHandlerFactory::class,
                Handler\TemplateMezzioHandler::class => Handler\TemplateMezzioHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                ''    => [__DIR__ . '/../templates'],
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
