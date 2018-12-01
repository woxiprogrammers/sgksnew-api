<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassifiedPackages extends Model
{
    protected $table = 'classified_packages';

    protected $fillable = ['package_name','slug'];
}
