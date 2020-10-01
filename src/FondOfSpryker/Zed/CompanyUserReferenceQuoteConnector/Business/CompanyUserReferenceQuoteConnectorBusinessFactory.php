<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business;

use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReader;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\CompanyUserReferenceQuoteConnectorDependencyProvider;
use FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorRepositoryInterface getRepository()
 */
class CompanyUserReferenceQuoteConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Business\Model\QuoteReaderInterface
     */
    public function createQuoteReader(): QuoteReaderInterface
    {
        return new QuoteReader(
            $this->getRepository(),
            $this->getQuoteFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Dependency\Facade\CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
     */
    protected function getQuoteFacade(): CompanyUserReferenceQuoteConnectorToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(CompanyUserReferenceQuoteConnectorDependencyProvider::FACADE_QUOTE);
    }
}
