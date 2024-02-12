<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


class PostalCodesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
    }
}
