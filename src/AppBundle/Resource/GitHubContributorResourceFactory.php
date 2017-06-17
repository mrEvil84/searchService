<?php
declare(strict_types=1);

namespace AppBundle\Resource;

use stdClass;

/**
 * Class GitHubRepositoryResourceFactory
 * @package AppBundle\Resource
 */
class GitHubContributorResourceFactory
{
    const ONE_REPO_COUNT = 1;

    /**
     * @param array $rawData
     * @return GitHubContributorResourceCollection
     */
    public function buildGitHubContributorsResourceCollectionFromRawData(array $rawData): GitHubContributorResourceCollection
    {
        $collection = new GitHubContributorResourceCollection();

        foreach ($rawData as $item) {
            $collection->addItem($this->buildContributorResourceFromRawData($item));
        }

        return $collection;
    }

    /**
     * @param stdClass $rawData
     * @return GitHubContributorResource
     */
    public function buildContributorResourceFromRawData(stdClass $rawData): GitHubContributorResource
    {
        return new GitHubContributorResource($rawData->login, $rawData->avatar_url, $rawData->contributions);
    }

}