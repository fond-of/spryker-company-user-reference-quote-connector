<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business;

use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepositoryInterface getRepository()
 * @method \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\CompanyUserReferenceQuoteConnectorBusinessFactory getFactory()
 */
class CompanyUserReferenceQuoteConnectorFacade extends AbstractFacade implements CompanyUserReferenceQuoteConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function findQuotesByCompanyUserReferences(
        CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
    ): QuoteCollectionTransfer {
        return $this->getFactory()
            ->createQuoteReader()
            ->findQuotesByCompanyUserReferences($companyUserReferenceCollectionTransfer);
    }
}
