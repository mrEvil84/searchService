<?php
declare(strict_types=1);

namespace AppBundle\Validator;

use AppBundle\Form\GitHubSearchType;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormError;

/**
 * Class GitHubSearchValidator
 */
class GitHubSearchFormValidator
{
    const REPOSITORY_NAME_VALID_PATTERN = "/(.*)\/(.*)/";
    /**
     * @var Form
     */
    private $form;

    /**
     * @var
     */
    private $formData;

    /**
     * GitHubSearchFormValidator constructor.
     * @param Form $form
     */
    public function __construct(Form $form)
    {
        $this->form = $form;
        $this->formData = $form->getData();
    }

    /**
     * @return Form
     */
    public function validate()
    {
        if($this->form->isSubmitted()) {
            $this->validateRepositoryName();
        }

        return $this->form;
    }

    private function validateRepositoryName()
    {
        if(empty($this->formData[GitHubSearchType::REPOSITORY_NAME])) {
            $this->form->addError(new FormError(GitHubSearchFormError::FIELD_IS_EMPTY_MESSAGE));
        }

        $matches = [];
        preg_match(self::REPOSITORY_NAME_VALID_PATTERN, $this->formData[GitHubSearchType::REPOSITORY_NAME], $matches);

        if(empty($matches)) {
            $this->form->addError(new FormError(GitHubSearchFormError::REPOSITORY_NAME_NOT_VALID_MESSAGE));
        }
    }

}