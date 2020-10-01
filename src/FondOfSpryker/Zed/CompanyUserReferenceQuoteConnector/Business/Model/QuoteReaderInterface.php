<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;

interface QuoteReaderInterface
{
    /**
     * @param string[] $companyUserReferences
     *
     * @return int[]
     */
    public function findQuoteIdsByCompanyUserReferences(array $companyUserReferences): array;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function findQuotesByCompanyUserReferences(
        CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
    ): QuoteCollectionTransfer;
}
