<?php
declare(strict_types=1);

namespace AppBundle\Query;

/**
 * Class GitHubQuery
 * @package AppBundle\Query
 */
interface SearchQuery
{
    public function __construct(string $query);

    public function getQuery(): string ;

    public function getQueryUrl(): string;

    public function getSortBy(): string;

    public function getSortOrder(): string;

}