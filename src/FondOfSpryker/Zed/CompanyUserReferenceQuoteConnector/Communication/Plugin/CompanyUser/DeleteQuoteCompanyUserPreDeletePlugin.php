<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Communication\Plugin\CompanyUser;

use Generated\Shared\Transfer\CompanyUserTransfer;
use Spryker\Zed\CompanyUserExtension\Dependency\Plugin\CompanyUserPreDeletePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorFacadeInterface getFacade()
 */
class DeleteQuoteCompanyUserPreDeletePlugin extends AbstractPlugin implements CompanyUserPreDeletePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return void
     */
    public function preDelete(CompanyUserTransfer $companyUserTransfer): void
    {
        $this->getFacade()->deleteCompanyUserQuotes($companyUserTransfer);
    }
}
