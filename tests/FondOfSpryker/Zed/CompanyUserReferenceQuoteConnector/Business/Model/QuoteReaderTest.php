<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepository;
use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;

class QuoteReaderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepository
     */
    protected $companyUserReferenceQuoteConnectorRepositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer
     */
    protected $companyUserReferenceCollectionTransferMock;

    /**
     * @var string[]
     */
    protected $companyUserReferences;

    /**
     * @var int[]
     */
    protected $quoteIds;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReader
     */
    protected $quoteReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReferenceQuoteConnectorRepositoryMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceCollectionTransferMock = $this->getMockBuilder(CompanyUserReferenceCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferences = ['STORE--CU-1'];
        $this->quoteIds = [1, 2, 5];

        $this->quoteReader = new QuoteReader(
            $this->companyUserReferenceQuoteConnectorRepositoryMock,
            $this->quoteFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFindQuotesByCompanyUserReferences(): void
    {
        $self = $this;

        $this->companyUserReferenceCollectionTransferMock->expects(self::atLeastOnce())
            ->method('getCompanyUserReferences')
            ->willReturn($this->companyUserReferences);

        $this->companyUserReferenceQuoteConnectorRepositoryMock->expects(self::atLeastOnce())
            ->method('findQuoteIdsByCompanyUserReferences')
            ->with($this->companyUserReferences)
            ->willReturn($this->quoteIds);

        $this->quoteFacadeMock->expects(self::atLeastOnce())
            ->method('getQuoteCollection')
            ->with(
                self::callback(static function (QuoteCriteriaFilterTransfer $quoteCriteriaFilterTransfer) use ($self) {
                    return $self->quoteIds === $quoteCriteriaFilterTransfer->getQuoteIds();
                })
            )->willReturn($this->quoteCollectionTransferMock);

        $quoteCollectionTransfer = $this->quoteReader->findQuotesByCompanyUserReferences(
            $this->companyUserReferenceCollectionTransferMock
        );

        self::assertEquals(
            $this->quoteCollectionTransferMock,
            $quoteCollectionTransfer
        );
    }

    /**
     * @return void
     */
    public function testFindQuotesByCompanyUserReferencesWithEmptyResult(): void
    {
        $this->companyUserReferenceCollectionTransferMock->expects(self::atLeastOnce())
            ->method('getCompanyUserReferences')
            ->willReturn($this->companyUserReferences);

        $this->companyUserReferenceQuoteConnectorRepositoryMock->expects(self::atLeastOnce())
            ->method('findQuoteIdsByCompanyUserReferences')
            ->with($this->companyUserReferences)
            ->willReturn([]);

        $quoteCollectionTransfer = $this->quoteReader->findQuotesByCompanyUserReferences(
            $this->companyUserReferenceCollectionTransferMock
        );

        self::assertCount(0, $quoteCollectionTransfer->getQuotes());
    }
}
