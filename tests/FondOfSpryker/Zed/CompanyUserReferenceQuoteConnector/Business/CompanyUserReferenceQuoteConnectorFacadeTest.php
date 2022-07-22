<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteWriterInterface;
use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;

class CompanyUserReferenceQuoteConnectorFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|CompanyUserReferenceQuoteConnectorBusinessFactory
     */
    protected $companyUserReferenceQuoteConnectorBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface
     */
    protected $quoteReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteWriterInterface
     */
    protected $quoteWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    protected $quoteCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer
     */
    protected $companyUserReferenceCollectionTransferMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacade
     */
    protected $companyUserReferenceQuoteConnectorFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    protected $companyUserResponseTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserReferenceQuoteConnectorBusinessFactoryMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteWriterMock = $this->getMockBuilder(QuoteWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteCollectionTransferMock = $this->getMockBuilder(QuoteCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceCollectionTransferMock = $this->getMockBuilder(CompanyUserReferenceCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserResponseTransferMock = $this->getMockBuilder(CompanyUserResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceQuoteConnectorFacade = new CompanyUserReferenceQuoteConnectorFacade();
        $this->companyUserReferenceQuoteConnectorFacade->setFactory(
            $this->companyUserReferenceQuoteConnectorBusinessFactoryMock
        );
    }

    /**
     * @return void
     */
    public function testFindQuotesByCompanyUserReferences(): void
    {
        $this->companyUserReferenceQuoteConnectorBusinessFactoryMock->expects(self::atLeastOnce())
            ->method('createQuoteReader')
            ->willReturn($this->quoteReaderMock);

        $this->quoteReaderMock->expects(self::atLeastOnce())
            ->method('findQuotesByCompanyUserReferences')
            ->with($this->companyUserReferenceCollectionTransferMock)
            ->willReturn($this->quoteCollectionTransferMock);

        self::assertEquals(
            $this->quoteCollectionTransferMock,
            $this->companyUserReferenceQuoteConnectorFacade->findQuotesByCompanyUserReferences(
                $this->companyUserReferenceCollectionTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testDeleteCompanyUserQuotes(): void
    {
        $this->companyUserReferenceQuoteConnectorBusinessFactoryMock->expects(self::atLeastOnce())
            ->method('createQuoteWriter')
            ->willReturn($this->quoteWriterMock);

        $this->quoteWriterMock->expects(self::atLeastOnce())
            ->method('deleteCompanyUserQuotes')
            ->with($this->companyUserTransferMock)
            ->willReturn($this->companyUserResponseTransferMock);

        self::assertInstanceOf(
            CompanyUserResponseTransfer::class,
            $this->companyUserReferenceQuoteConnectorFacade->deleteCompanyUserQuotes(
                $this->companyUserTransferMock
            )
        );
    }


}
