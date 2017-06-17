<?php
declare(strict_types=1);

namespace AppBundle\Query;

/**
 * Class SearchQuery
 * @package AppBundle\Query
 */
class GitHubSearchContributorsQuery implements SearchQuery
{
    const GITHUB_API_URL = 'https://api.github.com';

    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';

    const SORT_BY_LOGIN = 'login';
    const SORT_BY_CONTRIBUTORS = 'contributors';

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $sortBy;

    /**
     * @var string
     */
    private $sortOrder;

    /**
     * GitHubSearchContributorsQuery constructor.
     * @param string $query
     * @param string $sortBy
     * @param string $sortOrder
     */
    public function __construct(string $query, string $sortBy='', string $sortOrder='')
    {
        $this->query = $query;
        $this->sortBy = $sortBy;
        $this->sortOrder = $sortOrder;
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getQueryUrl(): string
    {
        return self::GITHUB_API_URL . '/repos/' . $this->query . '/contributors';
    }

    /**
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->sortBy;
    }

    /**
     * @return string
     */
    public function getSortOrder(): string
    {
        return $this->sortOrder;
    }

}