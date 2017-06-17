<?php
declare(strict_types=1);

namespace AppBundle\Form;

/**
 * Class GitHubSearchSort
 * @package AppBundle\Form
 */
class GitHubSearchSort
{
    const SORT_ORDER_ASC = 'ASC';
    const SORT_ORDER_DESC = 'DESC';

    const SORT_BY_LOGIN = 'login';
    const SORT_BY_CONTRIBUTORS = 'contributors';
}