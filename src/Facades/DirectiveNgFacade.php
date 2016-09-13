<?php namespace Larangu\FormNg\Facades;

use Illuminate\Support\Facades\Facade;

class DirectiveNgFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'directiveGeneratorNg';
    }
}
