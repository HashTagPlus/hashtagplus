<?php

namespace Entry\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entry
 *
 * @ORM\Table(name="Entry", indexes={@ORM\Index(name="entrytype", columns={"entrytype"})})
 * @ORM\Entity
 */
class Entry
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $description;

    /**
     * @var \Entry\Entity\Entrytype
     *
     * @ORM\ManyToOne(targetEntity="Entry\Entity\Entrytype")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="entrytype", referencedColumnName="id", nullable=true)
     * })
     */
    private $entrytype;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Entry
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    
    /**
     * Set description
     *
     * @param string $description
     * @return Entry
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
     * Set entrytype
     *
     * @param \Entry\Entity\Entrytype $entrytype
     * @return Entry
     */
    public function setEntrytype(\Entry\Entity\Entrytype $entrytype = null)
    {
        $this->entrytype = $entrytype;

        return $this;
    }

    /**
     * Get entrytype
     *
     * @return \Entry\Entity\Entrytype 
     */
    public function getEntrytype()
    {
        return $this->entrytype;
    }
    
    public function getArrayCopy()
    {
    	return get_object_vars($this);
    }
    
}
