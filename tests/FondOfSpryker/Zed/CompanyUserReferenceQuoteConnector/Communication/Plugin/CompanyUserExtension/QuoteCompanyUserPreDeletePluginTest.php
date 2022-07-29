<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Communication\Plugin\CompanyUserExtension;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacade;
use Generated\Shared\Transfer\CompanyUserTransfer;

class QuoteCompanyUserPreDeletePluginTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;
    /**
     * @var \Generated\Shared\Transfer\CompanyUserTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserTransferMock;
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Communication\Plugin\CompanyUserExtension\QuoteCompanyUserPreDeletePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new QuoteCompanyUserPreDeletePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPreDelete(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('deleteQuotesByCompanyUser')
            ->with($this->companyUserTransferMock);

        $this->plugin->preDelete($this->companyUserTransferMock);
    }
}
