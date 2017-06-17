<?php
declare(strict_types=1);

namespace AppBundle\DTO;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GitHubSearchHistoryDTOCollection
 * @package AppBundle\DTO
 */
class GitHubSearchHistoryDTOCollection extends ArrayCollection implements SearchDTO
{
    /**
     * @var array
     */
    private $collection;

    /**
     * @param GitHubSearchHistoryDTO $gitHubSearchHistoryDTO
     */
    public function addItem(GitHubSearchHistoryDTO $gitHubSearchHistoryDTO)
    {
        $this->collection[] = $gitHubSearchHistoryDTO;
    }

    /**
     * @return array
     */
    public function getIterator(): array
    {
        return $this->collection;
    }

}