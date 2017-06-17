<?php
declare(strict_types=1);

namespace AppBundle\Service;

use AppBundle\DTO\GitHubDTOFactory;
use AppBundle\DTO\GitHubSearchHistoryDTO;
use AppBundle\DTO\GitHubSearchHistoryDTOCollection;
use AppBundle\DTO\SearchDTO;
use AppBundle\Entity\GitHubContributor;
use AppBundle\Entity\GitHubSearchHistory;
use AppBundle\Query\SearchQuery;
use AppBundle\Repository\GitHubApiDataRepository;
use AppBundle\Resource\GitHubContributorResourceCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class GithubSearchService
 * @package AppBundle\Service
 */
class GitHubSearchService implements Provider, SearchDTO
{
    /**
     * @var GitHubApiDataRepository
     */
    private $apiDataRepository;

    /**
     * @var GitHubDTOFactory
     */
    private $gitGubSearchDtoFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * GitHubSearchService constructor.
     * @param GitHubApiDataRepository $apiDataRepository
     * @param GitHubDTOFactory $gitHubSearchDtoFactory
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        GitHubApiDataRepository $apiDataRepository,
        GitHubDTOFactory $gitHubSearchDtoFactory,
        EntityManagerInterface $entityManager
    )
    {
        $this->apiDataRepository = $apiDataRepository;
        $this->gitGubSearchDtoFactory = $gitHubSearchDtoFactory;
        $this->entityManager = $entityManager;
    }

    /**
     * @param SearchQuery $searchQuery
     * @return SearchDTO
     */
    public function getApiData(SearchQuery $searchQuery): SearchDTO
    {
        return $this->searchContributors($searchQuery);
    }

    /**
     * @return SearchDTO
     */
    public function getDbData(): SearchDTO
    {
        return $this->getContributorSearchHistory();
    }

    /**
     * @return \AppBundle\DTO\GitHubSearchHistoryDTOCollection
     */
    public function getContributorSearchHistory(): GitHubSearchHistoryDTOCollection
    {
        /** @var  $gitHubSearchHistory GitHubSearchHistory*/
        $gitHubSearchHistoryCollection =
            $this->entityManager->getRepository('AppBundle:GitHubSearchHistory')->findBy([],['searchDate'=>'DESC']);

        return $this->gitGubSearchDtoFactory->buildGitHubSearchHistoryDTOCollectionFromEntityCollection($gitHubSearchHistoryCollection);
    }

    /**
     * @param SearchQuery $gitHubSearchQuery
     * @return GitHubSearchHistoryDTO
     */
    public function searchContributors(SearchQuery $gitHubSearchQuery): GitHubSearchHistoryDTO
    {
        $contributorsResourceCollection =  $this->apiDataRepository->getGitHubContributorsResourceCollection($gitHubSearchQuery);
        $repositoryName = $gitHubSearchQuery->getQuery();

        $this->saveContributorSearchHistory(
            $repositoryName,
            $contributorsResourceCollection
        );

        return $this->gitGubSearchDtoFactory->buildGitHubSearchHistoryDTOFromResourceCollection($repositoryName, $contributorsResourceCollection);
    }

    /**
     * @param string $name
     * @param GitHubContributorResourceCollection $gitHubContributorResourceCollection
     */
    private function saveContributorSearchHistory(string $name, GitHubContributorResourceCollection $gitHubContributorResourceCollection)
    {
        $repoSearch = new GitHubSearchHistory();
        $repoSearch->setRepoSearch($name);
        $repoSearch->setSearchDate(new \DateTime('now'));

        /** @var GitHubContributorResourceCollection */
        $contributors = $gitHubContributorResourceCollection->getIterator();

        foreach ($contributors as $contributor)  {

            $entityContributor = new GitHubContributor(
                $contributor->getName(),
                $contributor->getAvatarUrl(),
                $contributor->getContributions()
            );
            $entityContributor->setGitHubSearch($repoSearch);

            $repoSearch->addContributor(
                $entityContributor
            );

            $this->entityManager->persist($entityContributor);
        }

        $this->entityManager->persist($repoSearch);
        $this->entityManager->flush();
    }
}