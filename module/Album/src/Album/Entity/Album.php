<?php
namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 */
class Album
{
	/**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
	private $id;
	
	
	
	/** @ORM\Column(type="string") */
	private $name;
	
	
	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	* @return string
	*/
	public function getName() {
		return $this->name;
	}
	
	
	
}