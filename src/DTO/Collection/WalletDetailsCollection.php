<?php

declare(strict_types=1);

namespace Bank131\SDK\DTO\Collection;

use Bank131\SDK\DTO\WalletDetails;

class WalletDetailsCollection extends AbstractCollection
{
    public function getType(): string
    {
        return WalletDetails::class;
    }
}