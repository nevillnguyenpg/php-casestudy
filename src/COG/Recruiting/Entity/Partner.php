<?php
namespace COG\Recruiting\Entity;

/**
 * Represents a single partner from a search result.
 * 
 * @author vovke
 */
class Partner
{
    /**
     * Name of the partner
     * @var string
     */
    public $name;

    /**
     * Url of the partner's homepage (root link)
     * 
     * @var string
     */
    public $homepage;

    /**
     * Unsorted list of prices received from the 
     * actual search query.
     * 
     * @var Price[]
     */
    public $prices = array();

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $homepage
     */
    public function setHomePage($homepage)
    {
        $this->homepage = $homepage;
    }

    /**
     * @param $prices
     */
    public function setPrices($prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return Price[]
     */
    public function getPrices()
    {
        return $this->prices;
    }
}