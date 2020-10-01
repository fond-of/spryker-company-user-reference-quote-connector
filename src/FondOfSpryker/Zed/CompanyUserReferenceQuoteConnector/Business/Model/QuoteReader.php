<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model;

use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer;
use Generated\Shared\Transfer\QuoteCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @param \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepositoryInterface $repository
     * @param \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade
     */
    public function __construct(
        CompanyUserReferenceQuoteConnectorRepositoryInterface $repository,
        CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface $quoteFacade
    ) {
        $this->repository = $repository;
        $this->quoteFacade = $quoteFacade;
    }

    /**
     * @param string[] $companyUserReferences
     *
     * @return int[]
     */
    public function findQuoteIdsByCompanyUserReferences(array $companyUserReferences): array
    {
        return $this->repository->findQuoteIdsByCompanyUserReferences($companyUserReferences);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteCollectionTransfer
     */
    public function findQuotesByCompanyUserReferences(
        CompanyUserReferenceCollectionTransfer $companyUserReferenceCollectionTransfer
    ): QuoteCollectionTransfer {
        $companyUserReferences = $companyUserReferenceCollectionTransfer->getCompanyUserReferences();

        $quoteIds = $this->findQuoteIdsByCompanyUserReferences($companyUserReferences);

        if (count($quoteIds) === 0) {
            return new QuoteCollectionTransfer();
        }

        $quoteCriteriaFilterTransfer = (new QuoteCriteriaFilterTransfer())
            ->setQuoteIds($quoteIds);

        return $this->quoteFacade->getQuoteCollection($quoteCriteriaFilterTransfer);
    }
}
