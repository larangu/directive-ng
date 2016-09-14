<?php namespace Larangu\DirectiveNg;

use Illuminate\Support\ServiceProvider;

class DirectiveNgServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('directive-ng.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/directive-ng'),
        ], 'views');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'directive-ng');

        $this->registerBladeDirectives();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'directive-ng');

        $this->app->singleton('directiveNg', function () {
            return $this->app->make(Generator::class);
        });
    }

    /**
     * REgistering blade directives for Angular generator.
     */
    protected function registerBladeDirectives()
    {
        \Blade::directive('ngAttr', function ($key, $expression) {
            return app('directiveNg')->attr($key, $expression);
        });

        \Blade::directive('ngEvent', function ($event, $expression) {
            return app('directiveNg')->event($event, $expression);
        });

        \Blade::directive('ngTemplate', function ($template, $expression = null) {
            return app('directiveNg')->template($template, $expression);
        });

        \Blade::directive('ngIf', function ($condition) {
            return app('directiveNg')->ngIf($condition);
        });

        \Blade::directive('ngFor', function ($expression, $singel = null, $index = null, $trackBy = null) {
            return app('directiveNg')->ngFor($expression, $singel, $index, $trackBy);
        });

        \Blade::directive('ngClass', function ($expression) {
            return app('directiveNg')->ngClass($expression);
        });

        \Blade::directive('ngStyle', function ($expression) {
            return app('directiveNg')->ngStyle($expression);
        });

        \Blade::directive('ngLink', function ($link, $fullExpresion = false) {
            if ($fullExpresion) {
                return app('directiveNg')->ngRouterLink($link);
            }
            return app('directiveNg')->ngLink($link);
        });

        \Blade::directive('ngSwitch', function ($expression) {
            return app('directiveNg')->ngSwitch($expression);
        });

        \Blade::directive('ngSwitchCase', function ($expression = null) {
            if (!$expression) {
                return app('directiveNg')->ngSwitchDefault();
            }
            return app('directiveNg')->ngSwitch($expression);
        });

        \Blade::directive('ngClick', function ($expression) {
            return app('directiveNg')->click($expression);
        });

        \Blade::directive('ngSubmit', function ($expression) {
            return app('directiveNg')->ngSubmit($expression);
        });

        \Blade::directive('nagModel', function ($expression) {
            return app('directiveNg')->model($expression);
        });
    }
}
