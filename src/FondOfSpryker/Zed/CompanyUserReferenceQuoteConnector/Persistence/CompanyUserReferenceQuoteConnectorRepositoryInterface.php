<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence;

interface CompanyUserReferenceQuoteConnectorRepositoryInterface
{
    /**
     * @param string[] $companyUserReferences
     *
     * @return int[]
     */
    public function findQuoteIdsByCompanyUserReferences(array $companyUserReferences): array;
}
