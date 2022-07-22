<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use Generated\Shared\Transfer\CompanyUserTransfer;

interface QuoteWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserQuotes(CompanyUserTransfer $companyUserTransfer): void;
}
