<?php

namespace MiPaPo\Core\System\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Symfony\Component\Console\Input\InputArgument;

class AddWebRoutesCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'add:web-routes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new web routes file';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Web Route File';

    /**
     * @var string
     */
    private $component;

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '/stubs/route.web.stub';

        return __DIR__.$stub;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     *
     * @return string
     * @throws FileNotFoundException
     */
    protected function buildClass($name)
    {
        $replace = $this->buildReplacements();

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function getNameInput()
    {
        $this->component = strtolower($this->argument('component'));
        $this->component = ucfirst($this->component);

        return 'MiPaPo\Core\Components\\'.$this->component.'\\Routes\web';
    }

    /**
     * Build the replacements for the file.
     *
     * @return array
     */
    protected function buildReplacements()
    {
        return [
            'DummyComponent' => $this->component,
            'DummyRoute' => strtolower($this->component),
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['component', InputArgument::REQUIRED, 'The name of the component'],
        ];
    }
}
