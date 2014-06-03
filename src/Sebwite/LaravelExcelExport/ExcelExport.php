<?php namespace Sebwite\LaravelExcelExport;
/**
|--------------------------------------------------------------------------
|   ExcelExport
|--------------------------------------------------------------------------
|
|  Simple Excel Export script.
|
|  User: Silvan
|  Date: 03-06-14
|  Time: 10:40
*/

use Sebwite\LaravelExcelExport\Classes\ExportXLS;

class ExcelExport {

    /**
     * @var
     */
    protected $xls;

    /**
     * @param $fileName
     * @param $headers
     * @param $data
     */
    public function getDownloadableXLS($fileName, $headers, $data)
    {
        $fileName   = $this->checkFileName($fileName);
        $this->xls  = new ExportXLS($fileName);

        $this->setHeaders($headers);
        $this->addData($data);
        $this->sendFile();
    }

    /**
     * Check if the filename has the right extension
     *
     * @param $filename
     * @return string
     */
    private function checkFileName($filename){
        $parts = pathinfo($filename);

        if(isset($parts['extension']) and ($parts['extension'] == 'xlsx' or $parts['extension'] == 'xls')) {
            return $filename;
        } else {
            return $filename . '.xls';
        }
    }

    /**
     * Set headers for Excel file
     *
     * @param $headersArray
     */
    public function setHeaders($headersArray)
    {
        // Check for multidimensional array
        if ( ! (count($headersArray) == count($headersArray, COUNT_RECURSIVE))) {
            foreach($headersArray as $headerItem) {
                $this->xls->addHeader($headerItem);
            }
        } else {
            $this->xls->addHeader($headersArray);
        }
    }

    /**
     * Add data to Excel file
     *
     * @param $data
     */
    public function addData($data)
    {
        // Check for multidimensional array
        if( ! (count($data) == count($data, COUNT_RECURSIVE)) ) {

            // Multidimensional array - loop through arrays
            foreach($data as $line) {
                $this->xls->addRow( $line );
            }

        } else {
            // Not multi - just add the array
            $this->xls->addRow($data);
        }
    }

    /**
     * Send the file to the client's browser
     *
     * @return mixed
     */
    public function sendFile()
    {
        return $this->xls->sendFile();
    }
} 