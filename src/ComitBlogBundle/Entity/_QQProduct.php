<?php
namespace ComitBlogBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 * @package ComitBlogBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name="test2")
 */
class Product2
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", length=100)
     */
    protected $name;
    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;
    /**
     * @ORM\Column(type="text")
     */
    protected $description;

}