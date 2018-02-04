<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    const MONTH_RUS = [
        1 => 'Январь',
        'Февраль',
        'Март',
        'Апрель',
        'Май',
        'Июнь',
        'Июль',
        'Фвгуст',
        'Сентябрь',
        'Октябрь',
        'Ноябрь',
        'Декабрь',
    ];

    // Table name
    protected $table = 'reports';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
