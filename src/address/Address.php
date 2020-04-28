<?php

namespace integready\stamps\address;

/**
 * Class to represent a mailing address for a shipping label.
 */
class Address implements AddressInterface
{
    /**
     * @var string
     */
    protected $fullname;

    /**
     * @var string
     */
    protected $address1;

    /**
     * @var string
     */
    protected $address2;
    /**
     * @var string
     */
    protected $address3;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var string
     */
    protected $zipcode;

    /**
     * @var string
     */
    protected $zipcodeAddOn;

    /**
     * @var string
     */
    protected $country = 'US';

    /**
     * {@inheritdoc}
     */
    public function setFullname($fullname)
    {
        $this->fullname = (string)$fullname;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress1($address1)
    {
        $this->address1 = (string)$address1;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress2($address2)
    {
        $this->address2 = (string)$address2;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * {@inheritdoc}
     */
    public function setAddress3($address3)
    {
        $this->address3 = (string)$address3;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * {@inheritdoc}
     */
    public function setCity($city)
    {
        $this->city = (string)$city;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * {@inheritdoc}
     */
    public function setState($state)
    {
        $this->state = (string)$state;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * {@inheritdoc}
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = (string)$zipcode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     *  @param string $zipcodeAddOn
     *
     * {@inheritdoc}
     */
    public function setZipcodeAddOn($zipcodeAddOn)
    {
        $this->zipcodeAddOn = (string)$zipcodeAddOn;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipcodeAddOn()
    {
        return $this->zipcodeAddOn;
    }

    /**
     * {@inheritdoc}
     */
    public function setCountry($country = 'US')
    {
        $this->country = (string)$country;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }
}
