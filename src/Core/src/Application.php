<?php

namespace MiPaPo\Core;

class Application extends \Illuminate\Foundation\Application
{
    /**
     * Create a new Illuminate application instance.
     *
     * @return void
     */
    public function __construct()
    {
        $basePath = dirname(__DIR__, 3);

        $this->storagePath = __DIR__.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'storage';

        parent::__construct($basePath);
    }

    public function basePath($path = '')
    {
        if ($path === 'composer.json') {
            return parent::basePath('src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.$path);
        }

        return parent::basePath($path);
    }

    /**
     * Get the path to the application "src" directory.
     *
     * @param  string  $path
     * @return string
     */
    public function path($path = '')
    {
        $path = parent::path($path);

        return str_replace('app', 'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'src', $path);
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path Optionally, a path to append to the config path
     * @return string
     */
    public function configPath($path = '')
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Resources'.DIRECTORY_SEPARATOR.'config';
    }

    /**
     * Get the application namespace.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getNamespace()
    {
        if (! is_null($this->namespace)) {
            return $this->namespace;
        }

        $composer = json_decode(file_get_contents($this->basePath('composer.json')), true);

        foreach ((array) data_get($composer, 'autoload.psr-4') as $namespace => $path) {
            foreach ((array) $path as $pathChoice) {
                if (realpath($this->path()) === realpath($this->basePath($pathChoice.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'src'))) {
                    return $this->namespace = $namespace;
                }
            }
        }

        throw new \RuntimeException('Unable to detect application namespace.');
    }
}