<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;

class CompanyUserReferenceQuoteConnectorToQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCriteriaFilterTransfer
     */
    protected $quoteCriteriaFilterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeBridge
     */
    protected $companyUserReferenceQuoteConnectorToQuoteFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCriteriaFilterTransferMock = $this->getMockBuilder(QuoteCriteriaFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceQuoteConnectorToQuoteFacadeBridge = new CompanyUserReferenceQuoteConnectorToQuoteFacadeBridge(
            $this->quoteFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testGetQuoteCollection(): void
    {
        $this->quoteFacadeMock->expects(self::atLeastOnce())
            ->method('getQuoteCollection')
            ->with($this->quoteCriteriaFilterTransferMock)
            ->willReturn($this->quoteCollectionTransferMock);

        self::assertEquals(
            $this->quoteCollectionTransferMock,
            $this->companyUserReferenceQuoteConnectorToQuoteFacadeBridge->getQuoteCollection(
                $this->quoteCriteriaFilterTransferMock,
            ),
        );
    }
}
