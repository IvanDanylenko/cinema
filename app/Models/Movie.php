<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $year
 * @property int $country_id
 */
class Movie extends Model
{
    use HasFactory;
}
