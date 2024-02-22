<?php

namespace App\Service;

class DateFormatter
{
    public function format(array $data): string
    {
        /** @var \DateTime $date */
        $requestDate = $data['date'];
        $requestTz = new \DateTimeZone($data['timezone']);
        $date = new \DateTime($requestDate->format('Y-m-d'), $requestTz);

        if ($requestDate->format('Y-m-d') < '1960-01-01') {
            $date = new \DateTime('now', $requestTz);
        }

        $offset = $requestTz->getOffset($date);

        return sprintf("The time zone %s has %s%s minutes offset to UTC on the given day at noon.<br/>
                February in this year is %s days long.<br />
                The specified month (%s) has %s days.",
            $data['timezone'],
            $offset > 0 ? '+' : '',
            (int)($offset/60),
            (new \DateTime($requestDate->format('Y-02-01')))->modify('last day of this month')->format('d'),
            $requestDate->format('F'),
            $requestDate->modify('last day of this month')->format('d')
        );
    }
}
