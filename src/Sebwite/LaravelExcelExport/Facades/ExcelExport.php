<?php namespace Sebwite\LaravelExcelExport\Facades;

use Illuminate\Support\Facades\Facade;

class ExcelExport extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'excelexport';
    }

}