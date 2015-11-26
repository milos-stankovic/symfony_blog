<?php

namespace ComitBlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Product
 *
 * @ORM\Table(name="products")
 * @ORM\Entity(repositoryClass="ComitBlogBundle\Entity\ProductRepository")
 */
class Product
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     *
     */

    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     minMessage="Minimum 2 characters!",
     *     max = 15,
     *     maxMessage="Not more than 15 characters!"
     * )
     * @Assert\Regex(
     *     pattern="/^\w+/",
     *
     *     message="Your name cannot contain a number."
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min=1,
     *     max=9,
     *     minMessage="There's nothing for free here!"
     * )
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


    /**
     * Get id
     *
     * @return integer
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = 2,
     *     minMessage="Minimum 2 characters!",
     *     max = 15,
     *     maxMessage="Not more than 15 characters!"
     * )
     * @Assert\Regex(
     *     pattern="/^\w+/",
     *     match=false,
     *     message="Your name cannot contain a number."
     * )
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
     * @return Product
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
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set category
     *
     * @param \ComitBlogBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\ComitBlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \ComitBlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }



}
