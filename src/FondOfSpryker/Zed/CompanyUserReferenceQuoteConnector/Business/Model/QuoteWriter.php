<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use \Exception;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Customer\Business\Customer\Customer;

class QuoteWriter implements QuoteWriterInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface
     */
    protected $quoteReader;

    /**
     * @param CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade
     *
     * @param QuoteReaderInterface $quoteReader
     */
    public function __construct(
        CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade,
        QuoteReaderInterface $quoteReader
    ) {
        $this->quoteFacade = $quoteFacade;
        $this->quoteReader = $quoteReader;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return Generated\Shared\Transfer\CompanyUserResponseTransfer
     *
     * @throws Exception
     */
    public function deleteCompanyUserQuotes(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer
    {
        $companyUserReferenceCollection = (new CompanyUserReferenceCollectionTransfer())
            ->addCompanyUserReference($companyUserTransfer->getCompanyUserReference());
        $quoteCollectionTransfer = $this->quoteReader->findQuotesByCompanyUserReferences($companyUserReferenceCollection);

        if (count($quoteCollectionTransfer->getQuotes()) === 0) {
            return;
        }

        foreach ($quoteCollectionTransfer->getQuotes() as $quoteTransfer) {
            $this->deleteQuote($quoteTransfer);
        }

        return (new CompanyUserResponseTransfer())
            ->setIsSuccessful(true)
            ->setCompanyUser($companyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteResponseTransfer
     *
     * @throws Exception
     */
    protected function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer
    {
        if ($quoteTransfer->getCustomer() === null) {
            $customer = (new CustomerTransfer())
                ->setIdCustomer($quoteTransfer->getCompanyUser()->getFkCompany())
                ->setCustomerReference($quoteTransfer->getCustomerReference());

            $quoteTransfer->setCustomer($customer);
        }

        $quoteResponseTransfer = $this->quoteFacade->deleteQuote($quoteTransfer);

        if ($quoteResponseTransfer->getIsSuccessful() === false) {
            throw new Exception("Quote could not be deleted.");
        }

        return $quoteResponseTransfer;
    }

}
