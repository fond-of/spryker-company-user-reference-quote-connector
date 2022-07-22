<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Communication\Plugin\CompanyUser;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;

class DeleteQuoteCompanyUserPreDeletePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Generated\Shared\Transfer\CompanyUserTransfer
     */
    protected $companyUserTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Communication\Plugin\CompanyUser\DeleteQuoteCompanyUserPreDeletePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyUserReferenceQuoteConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserTransferMock = $this->getMockBuilder(CompanyUserTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DeleteQuoteCompanyUserPreDeletePlugin();
    }

    /**
     * @return void
     */
    public function testPreDelete(): void
    {
        $this->facadeMock->expects(self::atLeastOnce())
            ->method('deleteCompanyUserQuotes')
            ->with($this->companyUserTransferMock);

        $this->plugin->preDelete($this->companyUserTransferMock);
    }
}
