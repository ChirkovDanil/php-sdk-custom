<?php

declare(strict_types=1);

namespace Bank131\SDK\Tests\Unit\API\Request\Builder\Session\Payout;

use Bank131\SDK\API\Request\Builder\Session\Payout\StartPayoutSessionWithFiscalizationRequestBuilder;
use Bank131\SDK\API\Request\Session\StartPayoutSessionRequestWithFiscalization;
use Bank131\SDK\DTO\Card\BankCard;
use Bank131\SDK\DTO\Card\CardEnum;
use Bank131\SDK\DTO\Customer;
use Bank131\SDK\DTO\FiscalizationDetails;
use Bank131\SDK\DTO\Participant;
use PHPUnit\Framework\TestCase;

class StartPayoutSessionRequestWithFiscalizationBuilderTest extends TestCase
{
    /**
     * @var StartPayoutSessionWithFiscalizationRequestBuilder
     */
    private $builder;

    protected function setUp(): void
    {
        $this->builder = new StartPayoutSessionWithFiscalizationRequestBuilder(
            'session_id',
            $this->createMock(FiscalizationDetails::class)
        );
    }

    public function testSuccessBuildEmptySession(): void
    {
        $request = $this->builder->build();
        $this->assertInstanceOf(StartPayoutSessionRequestWithFiscalization::class, $request);
    }

    public function testSuccessBuildFullSession(): void
    {
        $bankCardMock = $this->createMock(BankCard::class);
        $bankCardMock->method('getType')->willReturn(CardEnum::BANK_CARD);

        $request = $this->builder
            ->setCard($bankCardMock)
            ->setCustomer(
                $this->createMock(Customer::class)
            )
            ->setSender(
                $this->createMock(Participant::class)
            )
            ->setRecipient(
                $this->createMock(Participant::class)
            )
            ->setAmount(100, 'rub')
            ->setMetadata(json_encode(['key' => 'value']))
            ->build();
        $this->assertInstanceOf(StartPayoutSessionRequestWithFiscalization::class, $request);
    }
}