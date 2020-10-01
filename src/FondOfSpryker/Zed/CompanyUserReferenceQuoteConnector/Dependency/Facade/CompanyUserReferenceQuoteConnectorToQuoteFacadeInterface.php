<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade;

use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;

interface CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteCriteriaFilterTransfer $quoteCriteriaFilterTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function getQuoteCollection(
        QuoteCriteriaFilterTransfer $quoteCriteriaFilterTransfer
    ): QuoteCollectionTransfer;
}
