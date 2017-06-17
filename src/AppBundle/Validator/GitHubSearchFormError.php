<?php
declare(strict_types=1);

namespace AppBundle\Validator;

/**
 * Class GitHubSearchFormValidationException
 * @package AppBundle\Exception
 */
class GitHubSearchFormError
{
    const FIELD_IS_EMPTY = 1000;
    const FIELD_IS_EMPTY_MESSAGE = 'Field is empty';

    const REPOSITORY_NAME_NOT_VALID = 1001;
    const REPOSITORY_NAME_NOT_VALID_MESSAGE = 'Repository name is not valid';
}