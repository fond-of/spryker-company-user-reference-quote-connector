<?php

namespace FondOfSpryker\Zed\CompanyUserReferenceQuoteConnector\Persistence;

interface CompanyUserReferenceQuoteConnectorRepositoryInterface
{
    /**
     * @param array<string> $companyUserReferences
     *
     * @return array<int>
     */
    public function findQuoteIdsByCompanyUserReferences(array $companyUserReferences): array;
}
