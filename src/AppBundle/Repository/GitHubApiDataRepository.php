<?php
declare(strict_types=1);

namespace AppBundle\Repository;

use AppBundle\Form\GitHubSearchSort;
use AppBundle\Query\SearchQuery;
use AppBundle\Resource\GitHubContributorResourceCollection;
use AppBundle\Resource\GitHubRepositoryResourceCollection;
use AppBundle\Resource\GitHubContributorResourceFactory;
use Curl\Curl;
use AppBundle\Exception\RepositoryNotFoundException;
use stdClass;

/**
 * Class GitHub
 */
class GitHubApiDataRepository
{
    const FORMAT_JSON = ['format' => 'json'];
    const API_MESSAGE_NOT_FOUND = 'Not Found';

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var GitHubContributorResourceFactory
     */
    private $gitHubRepositoryResourceFactory;

    /**
     * GitHubDataRepository constructor.
     * @param GitHubContributorResourceFactory $gitHubRepositoryResourceFactory
     */
    public function __construct(GitHubContributorResourceFactory $gitHubRepositoryResourceFactory)
    {
        $this->gitHubRepositoryResourceFactory = $gitHubRepositoryResourceFactory;
        $this->curl = new Curl();
    }

    /**
     * Close curl connection
     */
    public function __destruct()
    {
        $this->curl->close();
    }

    /**
     * @param SearchQuery $searchQuery
     * @return GitHubContributorResourceCollection
     * @throws RepositoryNotFoundException
     */
    public function getGitHubContributorsResourceCollection(SearchQuery $searchQuery): GitHubContributorResourceCollection
    {
        $this->curl->get($searchQuery->getQueryUrl());

        if ($this->isCurlError()) {
            throw new RepositoryNotFoundException();
        }

        if ($this->isRepositoryNotFound()) {
            throw new RepositoryNotFoundException();
        }

        $rawData = [];
        $curlData = json_decode($this->getCurlReponse());

        if (GitHubSearchSort::SORT_BY_LOGIN === $searchQuery->getSortBy()) {
            $rawData = $this->sortByLogin($curlData, $searchQuery->getSortOrder());
        }

        if (GitHubSearchSort::SORT_BY_CONTRIBUTORS === $searchQuery->getSortBy()) {
            $rawData = $this->sortByContributions($curlData, $searchQuery->getSortOrder());
        }

        if(empty($rawData)) {
            $rawData = $curlData;
        }

        return $this->gitHubRepositoryResourceFactory->buildGitHubContributorsResourceCollectionFromRawData(
            $rawData
        );
    }

    /**
     * @param array $data
     * @param string $sortOrder
     * @return array
     */
    private function sortByLogin(array $data, string $sortOrder = 'ASC'): array
    {
        $sortedData = $data;

        if (GitHubSearchSort::SORT_ORDER_ASC === $sortOrder) {
            usort($sortedData, function($one, $two) {
                return strcasecmp($one->login, $two->login);
            });
        } else {
            usort($sortedData, function($one, $two) {
                return strcasecmp($two->login, $one->login);
            });
        }

        return $sortedData;
    }

    /**
     * @param array $data
     * @param string $sortOrder
     * @return array
     */
    public function sortByContributions(array $data, string $sortOrder = 'ASC')
    {
        $sortedData = $data;

        if (GitHubSearchSort::SORT_ORDER_ASC === $sortOrder) {
            usort($sortedData, function($one, $two) {
                if ($one->contributions === $two->contributions) {
                    return 0;
                }
                return ($one->contributions > $two->contributions) ? 1 : -1;
            });
        } else {
            usort($sortedData, function($one, $two) {
                if ($one->contributions === $two->contributions) {
                    return 0;
                }
                return ($one->contributions < $two->contributions) ? 1 : -1;
            });
        }

        return $sortedData;
    }

    /**
     * @return bool
     */
    private function isRepositoryNotFound():bool
    {
        $gitHubResponse = json_decode($this->getCurlReponse());

        if(($gitHubResponse instanceof stdClass) && (self::API_MESSAGE_NOT_FOUND === $gitHubResponse->message)) {

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function getCurlReponse():string
    {
        return $this->curl->response;
    }

    /**
     * @return bool
     */
    private function isCurlError():bool
    {
        return ($this->curl->curl_error) ? true : false;
    }

}