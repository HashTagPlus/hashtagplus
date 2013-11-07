<?php
namespace Entry\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 */
class Entry
{
	/**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
	private $id;
	
	
	
	/** @ORM\Column(type="string") */
	private $url;
	
	
	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	* @return string
	*/
	public function getUrl() {
		return $this->url;
	}
	
	public function setUrl($value) {
		$this->url = $value;
	}
	
	
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
	
	
	
}