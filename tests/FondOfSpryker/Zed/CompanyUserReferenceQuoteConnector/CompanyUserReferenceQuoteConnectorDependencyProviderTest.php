<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Quote\Business\QuoteFacadeInterface;
use Spryker\Zed\Testify\Locator\Business\Container;

class CompanyUserReferenceQuoteConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacadeInterface
     */
    protected $quoteFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyBusinessUnitSales\CompanyBusinessUnitSalesDependencyProvider
     */
    protected $companyUserReferenceQuoteConnectorDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReferenceQuoteConnectorDependencyProvider = new CompanyUserReferenceQuoteConnectorDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(self::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(self::atLeastOnce())
            ->method('__call')
            ->with('quote')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(self::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->quoteFacadeMock);

        $container = $this->companyUserReferenceQuoteConnectorDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        self::assertEquals($this->containerMock, $container);

        self::assertInstanceOf(
            CompanyUserReferenceQuoteConnectorToQuoteFacadeBridge::class,
            $container[CompanyUserReferenceQuoteConnectorDependencyProvider::FACADE_QUOTE],
        );
    }
}
