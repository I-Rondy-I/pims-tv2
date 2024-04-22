<?php

namespace PimsTv;

use Carbon\Carbon;

class PaydayCalculate
{
    private function getPaydayDate(Carbon $date): Carbon
    {
        $endOfMonth = $date->endOfMonth();
        $endOfMonthWeekDay = $date->endOfMonth()->dayOfWeek;

        return match ($endOfMonthWeekDay) {
            2, 3, 4, 5 => $endOfMonth->subDays(),
            6 => $endOfMonth->subDays(2),
            1, 7 => $endOfMonth->subDays(3)
        };
    }

    public function calculate(): Payday
    {
        $payday = $this->getPaydayDate(Carbon::today());

        if ($payday->isPast()) {
            $payday = $this->getPaydayDate(Carbon::today()->endOfMonth()->addSecond());
        }

        return new Payday($payday);
    }
}
