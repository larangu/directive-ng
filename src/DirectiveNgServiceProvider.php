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
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'directive-ng');

        $this->app->singleton('directiveGeneratorNg', function () {
            return $this->app->make(Generator::class);
        });
    }
}
