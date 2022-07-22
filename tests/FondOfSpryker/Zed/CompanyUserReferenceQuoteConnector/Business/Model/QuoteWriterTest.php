<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepository;
use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteWriterTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface
     */
    protected $quoteReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteWriterInterface
     */
    protected $quoteWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteWriter = new QuoteWriter(
            $this->quoteFacadeMock,
            $this->quoteReaderMock
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserQuotes(): void
    {
        $quotes = new ArrayObject();
        $quotes->append($this->quoteTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUserReference')
            ->willReturn('COMPANY-USER-REFERENCE');

        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('findQuotesByCompanyUserReferences')
            ->willReturn($this->quoteCollectionTransferMock);

        $this->quoteCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getQuotes')
            ->willReturn($quotes);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCompanyUser')
            ->willReturn($this->companyUserTransferMock);

        $this->companyUserTransferMock->expects(static::atLeastOnce())
            ->method('getFkCompany')
            ->willReturn(1);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn('COMPANY-USER-REFERENCE');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->willReturnSelf();

        $this->quoteFacadeMock->expects(static::atLeastOnce())
            ->method('deleteQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $this->quoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);


        static::assertInstanceOf(
            CompanyUserResponseTransfer::class,
            $this->quoteWriter->deleteCompanyUserQuotes($this->companyUserTransferMock)
        );
    }

}
