<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReader;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\CompanyUserReferenceQuoteConnectorDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepository;
use Spryker\Zed\Kernel\Container;

class CompanyUserReferenceQuoteConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepository
     */
    protected $repositoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorBusinessFactory
     */
    protected $companyUserReferenceQuoteConnectorBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceQuoteConnectorBusinessFactory = new CompanyUserReferenceQuoteConnectorBusinessFactory();
        $this->companyUserReferenceQuoteConnectorBusinessFactory->setContainer($this->containerMock);
        $this->companyUserReferenceQuoteConnectorBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteReader(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(CompanyUserReferenceQuoteConnectorDependencyProvider::FACADE_QUOTE)
            ->willReturn($this->quoteFacadeMock);

        $quoteReader = $this->companyUserReferenceQuoteConnectorBusinessFactory->createQuoteReader();

        self::assertInstanceOf(QuoteReader::class, $quoteReader);
    }
}
