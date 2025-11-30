<?php

namespace App\Enums;

enum InquiryType: string
{
    case Estimate = 'estimate';
    case Recruit = 'recruit';
    case Other = 'other';

    public function label()
    {
        return match ($this) {
            self::Estimate => '見積もり',
            self::Recruit => '採用',
            self::Other => 'その他',
        };
    }
}