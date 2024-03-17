<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class PostalCode extends Model
{
    use Sushi;

    public function getRows()
    {
        require_once base_path('data/postal_codes.php');

        return $postal_codes;
    }

    protected function sushiShouldCache()
    {
        return true;
    }
}
