<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence;

use Orm\Zed\Quote\Persistence\Map\SpyQuoteTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence\CompanyUserReferenceQuoteConnectorPersistenceFactory getFactory()
 */
class CompanyUserReferenceQuoteConnectorRepository extends AbstractRepository implements CompanyUserReferenceQuoteConnectorRepositoryInterface
{
    /**
     * @param string[] $companyUserReferences
     *
     * @return int[]
     */
    public function findQuoteIdsByCompanyUserReferences(array $companyUserReferences): array
    {
        if (count($companyUserReferences) === 0) {
            return [];
        }

        return $this->getFactory()->getQuoteQuery()
            ->clear()
            ->filterByCompanyUserReference_In($companyUserReferences)
            ->select([SpyQuoteTableMap::COL_ID_QUOTE])
            ->find()
            ->toArray();
    }
}
