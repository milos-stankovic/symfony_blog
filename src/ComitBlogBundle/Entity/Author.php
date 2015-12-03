<?php
namespace ComitBlogBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Author
{
    /**
     * @var
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * @var
     * @Assert\Choice(choices={"male", "female", "other"}, message="Choose a valid gender")
     *     OR:
     * @Assert\Choice({"male", "female", "other"})
     */
    public $gender;

    /**
     * @var
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $firstName;

    /**
     * @var
     * @Assert\NotBlank()
     * @Assert\Length(min = 6)
     */
    private $password;


}