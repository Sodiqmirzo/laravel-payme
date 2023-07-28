<?php

namespace Ittech\Payme\Enums;

enum ReceiptState: int
{
    case NEW = 0;
    case CREATE_TRANSACTION_MERCHANT = 1;
    case WITHDRAWING_MONEY_FROM_CARD = 2;
    case CLOSE_TRANSACTION_MERCHANT = 3;
    case PAID = 4;
    case CANCELLED = 50;
}
