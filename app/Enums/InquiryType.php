<?php

namespace App\Enums;

enum InquiryType: string
{
    case Estimate = 'estimate';
    case Recruit = 'recruit';
    case Other = 'other';
}