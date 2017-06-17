<?php
declare(strict_types=1);

namespace AppBundle\DTO;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Interface SearchDto
 */
class GitHubDTOFactory
{
    /**
     * @param string $repositoryName
     * @param ArrayCollection $collection
     * @return GitHubSearchHistoryDTO
     */
    public function buildGitHubSearchHistoryDTOFromResourceCollection(string $repositoryName, ArrayCollection $collection): GitHubSearchHistoryDTO
    {
        $contributorsResourceCollection = $collection->getIterator();

        $gitHubContributorDTOCollection = new GitHubContributorDTOCollection();

        foreach ($contributorsResourceCollection as $contributor) {
            $gitHubContributorDTOCollection->addItem(
                new GitHubContributorDTO(
                    $contributor->getName(),
                    $contributor->getAvatarUrl(),
                    $contributor->getContributions()
                )
            );
        }

        return new GitHubSearchHistoryDTO(
            $repositoryName,
            $this->getDateTime(new DateTime()),
            $gitHubContributorDTOCollection);
    }

    /**
     * @param array $rawCollection
     * @return GitHubSearchHistoryDTOCollection
     */
    public function buildGitHubSearchHistoryDTOCollectionFromEntityCollection(array $rawCollection): GitHubSearchHistoryDTOCollection
    {
        $gitHubSearchHistoryDTOCollection = new GitHubSearchHistoryDTOCollection();

        foreach ($rawCollection as $item) {

            $contributors = $item->getContributors();

            $gitHubContributorDTOCollection = new GitHubContributorDTOCollection();
            foreach ($contributors as $contributor) {

                    $gitHubContributorDTOCollection->addItem(
                        new GitHubContributorDTO(
                            $contributor->getName(),
                            $contributor->getThumbnailUrl(),
                            0
                        )
                    );
            }

            $gitHubSearchHistoryDTOCollection->addItem(
                new GitHubSearchHistoryDTO(
                    $item->getRepoSearch(),
                    $this->getDateTime($item->getSearchDate()),
                    $gitHubContributorDTOCollection
                )
            );
        }

        return $gitHubSearchHistoryDTOCollection;
    }

    /**
     * @param DateTime $dateTime
     * @return string
     */
    private function getDateTime(DateTime $dateTime): string
    {
        return $dateTime->format('Y-m-d H:i:s');
    }


}