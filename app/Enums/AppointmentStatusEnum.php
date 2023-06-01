<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class AppointmentStatusEnum extends Enum
{
    public const WAITING_FOR_APPROVAL = 1;
    public const APPROVED = 2;
    public const REFUSED = 3;

    public static function getArrayView(): array
    {
        return [
            'Chờ phê duyệt'  => self::WAITING_FOR_APPROVAL,
            'Đã được phê duyệt'  => self::APPROVED,
            'Đã bị từ chối' => self::REFUSED,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }

}
