<?php

namespace App\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use WendellAdriel\Lift\Lift;

final class Banner extends Model
{
    use HasFactory, Lift;

    public int $id;

    public string $image;

    public ?string $mobile;

    public ?string $link;

    public ?int $order;

    public bool $active;

    public ?CarbonImmutable $from;

    public ?CarbonImmutable $to;
}
