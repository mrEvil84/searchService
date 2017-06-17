<?php

namespace AppBundle\Entity;

use AppBundle\Entity\GitHubSearchHistory;
use Doctrine\ORM\Mapping as ORM;

/**
 * GitHubContributor
 *
 * @ORM\Table(name="git_hub_contributor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GitHubContributorRepository")
 */
class GitHubContributor
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnailUrl", type="string", length=255)
     */
    private $thumbnailUrl;

    /**
     * @var int
     *
     * @ORM\Column(name="contributions", type="integer")
     */
    private $contributions;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GitHubSearchHistory", inversedBy="contributors")
     * @ORM\JoinColumn(name="search_history_id", referencedColumnName="id")
     */
    private $gitHubSearch;

    /**
     * GitHubContributor constructor.
     * @param $name
     * @param $thumbnailUrl
     * @param $contributions
     */
    public function __construct($name, $thumbnailUrl, $contributions)
    {
        $this->name = $name;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->contributions = $contributions;
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
     * Set name
     *
     * @param string $name
     *
     * @return GitHubContributor
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set thumbnailUrl
     *
     * @param string $thumbnailUrl
     *
     * @return GitHubContributor
     */
    public function setThumbnailUrl($thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * Get thumbnailUrl
     *
     * @return string
     */
    public function getThumbnailUrl()
    {
        return $this->thumbnailUrl;
    }

    /**
     * Set gitHubSearch
     *
     * @param GitHubSearchHistory $gitHubSearch
     *
     * @return GitHubContributor
     */
    public function setGitHubSearch(GitHubSearchHistory $gitHubSearch = null)
    {
        $this->gitHubSearch = $gitHubSearch;

        return $this;
    }

    /**
     * Get gitHubSearch
     *
     * @return GitHubSearchHistory
     */
    public function getGitHubSearch()
    {
        return $this->gitHubSearch;
    }

    /**
     * @return int
     */
    public function getContributions(): int
    {
        return $this->contributions;
    }

    /**
     * @param int $contributions
     */
    public function setContributions(int $contributions)
    {
        $this->contributions = $contributions;
    }
}
