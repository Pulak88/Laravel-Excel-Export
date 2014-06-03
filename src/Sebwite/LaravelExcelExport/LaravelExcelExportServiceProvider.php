<?php namespace Sebwite\LaravelExcelExport;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class LaravelExcelExportServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['excelexport'] = $this->app->share(function($app)
        {
            return new ExcelExport;
        });
	}

    public function boot()
    {
        $this->package('sebwite/laravel-excel-export');

        AliasLoader::getInstance()->alias('ExcelExport', 'Sebwite\LaravelExcelExport\Facades\ExcelExport');
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
