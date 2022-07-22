<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

interface QuoteWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function deleteCompanyUserQuotes(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer;
}
