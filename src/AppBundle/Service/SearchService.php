<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\SearchDTO;
use AppBundle\Query\SearchQuery;

/**
 * Class SearchService
 * @package AppBundle\Service
 */
class SearchService
{
    /**
     * @var Provider
     */
    private $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function search(SearchQuery $searchQuery): SearchDTO
    {
        return $this->provider->getApiData($searchQuery);
    }

    public function getDbSearchHistory(): SearchDTO
    {
        return $this->provider->getDbData();
    }

}