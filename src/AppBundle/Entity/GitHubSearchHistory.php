<?php

namespace AppBundle\Entity;

use AppBundle\Entity\GitHubContributor;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * GitHubSearchHistory
 *
 * @ORM\Table(name="git_hub_search_history")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GitHubSearchHistoryRepository")
 */
class GitHubSearchHistory
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="repoSearch", type="string", length=255)
     */
    private $repoSearch;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="searchDate", type="datetime")
     */
    private $searchDate;

    /**
     * @ORM\OneToMany(targetEntity="GitHubContributor", mappedBy="gitHubSearch")
     */
    private $contributors;


    public function __construct()
    {
        $this->contributors = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set repoSearch
     *
     * @param string $repoSearch
     *
     * @return GitHubSearchHistory
     */
    public function setRepoSearch($repoSearch)
    {
        $this->repoSearch = $repoSearch;

        return $this;
    }

    /**
     * Get repoSearch
     *
     * @return string
     */
    public function getRepoSearch()
    {
        return $this->repoSearch;
    }

    /**
     * Set searchDate
     *
     * @param DateTime $searchDate
     *
     * @return GitHubSearchHistory
     */
    public function setSearchDate($searchDate)
    {
        $this->searchDate = $searchDate;

        return $this;
    }

    /**
     * Get searchDate
     *
     * @return DateTime
     */
    public function getSearchDate()
    {
        return $this->searchDate;
    }

    /**
     * Add contributor
     *
     * @param GitHubContributor $contributor
     *
     * @return GitHubSearchHistory
     */
    public function addContributor(GitHubContributor $contributor)
    {
        $this->contributors[] = $contributor;

        return $this;
    }

    /**
     * Remove contributor
     *
     * @param GitHubContributor $contributor
     */
    public function removeContributor(GitHubContributor $contributor)
    {
        $this->contributors->removeElement($contributor);
    }

    /**
     * Get contributors
     *
     * @return Collection
     */
    public function getContributors()
    {
        return $this->contributors;
    }
}
