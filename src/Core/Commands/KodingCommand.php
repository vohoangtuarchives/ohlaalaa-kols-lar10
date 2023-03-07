<?php
namespace App\Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

abstract class KodingCommand extends Command{
    protected function replace($name,$type){
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}',
                '{{modelNamePluralUpperCase}}',
                '{{modelNameSingularUpperCase}}',
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name),
                ucfirst(Str::plural($name)),
                ucfirst($name)
            ],
            $this->getStub($type)
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(app_path("Console/Commands/stub/$type.stub"));
    }
}