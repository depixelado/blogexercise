<?php
namespace Djimenez\BlogBundle\Model;

interface RateInterface
{
    /**
     * Set value
     *
     * @param string $value
     * @return PageInterface
     */
    public function setValue($value);

    /**
     * Get value
     *
     * @return string
     */
    public function getValue();
}