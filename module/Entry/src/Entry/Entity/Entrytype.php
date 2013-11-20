<?php

namespace Entry\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Entrytype
 *
 * @ORM\Table(name="Entrytype")
 * @ORM\Entity
 */
class Entrytype
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="entrytype", type="string", length=100, nullable=true)
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="$entrytype", cascade={"all"})
     */
    private $entrytype;

    
    /**
     * Get url
     *
     * @return string
     */
    public function getEntryTypeString()
    {
    	return $this->entrytype;
    }

}
