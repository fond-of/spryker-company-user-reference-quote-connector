<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Deleter;

use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;

class QuoteDeleter implements QuoteDeleterInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface $quoteReader
     * @param \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        QuoteReaderInterface $quoteReader,
        CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade
    ) {
        $this->quoteReader = $quoteReader;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return void
     */
    public function deleteByCompanyUser(CompanyUserTransfer $companyUserTransfer): void
    {
        $quoteCollectionTransfer = $this->quoteReader->findByCompanyUser($companyUserTransfer);

        foreach ($quoteCollectionTransfer->getQuotes() as $quoteTransfer) {
            $this->quoteFacade->deleteQuote($quoteTransfer);
        }
    }
}
