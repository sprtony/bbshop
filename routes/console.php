<?php

ini_set('memory_limit', '-1');
ini_set('max_execution_time', 3000);

use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\PostalCode;
use App\Imports\PostalCodesImport;

Artisan::command('postal-codes', function () {
    $data = Excel::toArray(new PostalCodesImport, 'postal_codes.xls');
    foreach ($data as $sheet) {
        foreach ($sheet as $colonia) {
            $cp = new PostalCode;
            $cp->postal_code = $colonia['d_codigo'];
            $cp->department = $colonia['d_asenta'];
            $cp->state = $colonia['d_estado'];
            $cp->city = $colonia['d_mnpio'];
            $cp->save();
        }
    }
});
