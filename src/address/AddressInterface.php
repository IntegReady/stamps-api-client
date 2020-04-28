<?php

namespace integready\stamps\address;

/**
 * Interface for creating a mailing address.
 */
interface AddressInterface
{
    /**
     * @param string $fullname
     *
     * @return $this
     */
    public function setFullname($fullname);

    /**
     * @return string
     */
    public function getFullname();

    /**
     * @param string $address1
     *
     * @return $this
     */
    public function setAddress1($address1);

    /**
     * @return string
     */
    public function getAddress1();

    /**
     * @param string $address2
     *
     * @return $this
     */
    public function setAddress2($address2);

    /**
     * @return string
     */
    public function getAddress2();

    /**
     * @param string $address3
     *
     * @return $this
     */
    public function setAddress3($address3);

    /**
     * @return string
     */
    public function getAddress3();

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param string $state
     *
     * @return $this
     */
    public function setState($state);

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $zipcode
     *
     * @return $this
     */
    public function setZipcode($zipcode);

    /**
     * @return string
     */
    public function getZipcode();

    /**
     * @param string $zipcodeAddOn
     *
     * @return $this
     */
    public function setZipcodeAddOn($zipcodeAddOn);

    /**
     * @return string
     */

    public function getZipcodeAddOn();

    /**
     * @param string $country
     *
     * @return $this
     */
    public function setCountry($country = 'US');

    /**
     * @return string
     */
    public function getCountry();
}
