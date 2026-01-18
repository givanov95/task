<?php

namespace App\Enums;

enum DocumentTypeEnum: string
{
    case INVOICE = 'invoice';
    case PROFORMA = 'pro-forma';
}