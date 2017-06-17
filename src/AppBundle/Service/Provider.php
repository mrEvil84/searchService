<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\SearchDTO;
use AppBundle\Query\SearchQuery;

/**
 * Interface Provider
 * @package AppBundle\Service
 */
interface Provider
{
    public function getApiData(SearchQuery $searchQuery): SearchDTO;

    public function getDbData(): SearchDTO;

}