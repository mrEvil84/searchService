<?php
declare(strict_types=1);

namespace AppBundle\DTO;

/**
 * Class GitHubSearchHistoryDTO
 * @package AppBundle\DTO
 */
class GitHubSearchHistoryDTO implements SearchDTO
{
    /**
     * @var string
     */
    private $repositoryName;

    /**
     * @var GitHubContributorDTOCollection
     */
    private $contributorDTOCollection;

    /**
     * @var string
     */
    private $searchDate;

    /**
     * GitHubSearchHistoryDTO constructor.
     * @param string $repositoryName
     * @param string $searchDate
     * @param GitHubContributorDTOCollection $contributorDTOCollection
     */
    public function __construct(string $repositoryName, string $searchDate, GitHubContributorDTOCollection $contributorDTOCollection)
    {
        $this->repositoryName = $repositoryName;
        $this->searchDate = $searchDate;
        $this->contributorDTOCollection = $contributorDTOCollection;
    }

    /**
     * @return string
     */
    public function getRepositoryName(): string
    {
        return $this->repositoryName;
    }

    /**
     * @return GitHubContributorDTOCollection
     */
    public function getContributorDTOCollection(): GitHubContributorDTOCollection
    {
        return $this->contributorDTOCollection;
    }

    /**
     * @return string
     */
    public function getSearchDate(): string
    {
        return $this->searchDate;
    }

}