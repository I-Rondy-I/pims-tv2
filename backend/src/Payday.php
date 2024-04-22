<?php

namespace PimsTv;

use Carbon\Carbon;

class Payday
{
    public function __construct(private Carbon $date)
    {
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }
}
