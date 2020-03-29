<?php namespace EmadHa\EloquentViews;


class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        # Adds config to publish list
        $this->publishes([
            __DIR__ . '/../config/eloquent-views.php' => config_path('eloquent-views.php'),
        ], 'config');

        # Attach commands
        $this->commands([
            Commands\CreateView::class
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/eloquent-views.php', 'eloquent-views');
    }

}
