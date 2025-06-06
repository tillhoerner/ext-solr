<?php

declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\Parser;

use ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\Result\SearchResultBuilder;
use ApacheSolrForTypo3\Solr\Domain\Search\ResultSet\SearchResultSet;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * A ResultParser is responsible to create the result object structure from the \Apache_Solr_Response
 * and assign it to the SearchResultSet.
 */
abstract class AbstractResultParser
{
    protected SearchResultBuilder $searchResultBuilder;

    protected DocumentEscapeService $documentEscapeService;

    public function __construct(
        ?SearchResultBuilder $resultBuilder = null,
        ?DocumentEscapeService $documentEscapeService = null,
    ) {
        $this->searchResultBuilder = $resultBuilder ?? GeneralUtility::makeInstance(SearchResultBuilder::class);
        $this->documentEscapeService = $documentEscapeService ?? GeneralUtility::makeInstance(DocumentEscapeService::class);
    }

    /**
     * Enriches and hydrates the SearchResultSet with required data structures.
     */
    abstract public function parse(
        SearchResultSet $resultSet,
        bool $useRawDocuments = true,
    ): SearchResultSet;

    /**
     * Checks whether the given SearchResultSet can be parsed with parser implementation.
     */
    abstract public function canParse(SearchResultSet $resultSet): bool;
}
