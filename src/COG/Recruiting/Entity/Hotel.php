<?php
namespace COG\Recruiting\Entity;

/**
 * Represents a single hotel in the result.
 *
 * @author vovke
 */
class Hotel 
{
    /**
     * Name of the hotel.
     *
     * @var string
     */
    public $name;

    /**
     * Street adr. of the hotel.
     * 
     * @var string
     */
    public $adr;

    /**
     * Unsorted list of partners with their corresponding prices.
     * 
     * @var Partner[]
     */
    public $partners = array();

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $adr
     */
    public function setAdr($adr)
    {
        $this->adr = $adr;
    }

    /**
     * @param $partners
     */
    public function setPartner($partners)
    {
        $this->partners = $partners;
    }

    /**
     * @return Partner[]
     */
    public function getPartner()
    {
        return $this->partners;
    }
}