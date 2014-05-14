<?php

namespace Cubbyhole\WebApiBundle\Entity;

use JMS\Serializer\Annotation\Type;

class Plan
{
    /**
     * @Type("integer")
     */
    protected $id;
    
    /**
     * @Type("string")
     */
    protected $name;
    
    /**
     * @Type("integer")
     */
    protected $price;
    
    /**
     * @Type("integer")
     */
    protected $bandwidthDownload;
    
    /**
     * @Type("integer")
     */
    protected $bandwidthUpload;
    
    /**
     * @Type("integer")
     */
    protected $space;
    
    /**
     * @Type("integer")
     */
    protected $shareQuota;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getBandwidthDownload() {
        return $this->bandwidthDownload;
    }

    public function getBandwidthUpload() {
        return $this->bandwidthUpload;
    }

    public function getSpace() {
        return $this->space;
    }

    public function getShareQuota() {
        return $this->shareQuota;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function setBandwidthDownload($bandwidthDownload) {
        $this->bandwidthDownload = $bandwidthDownload;
    }

    public function setBandwidthUpload($bandwidthUpload) {
        $this->bandwidthUpload = $bandwidthUpload;
    }

    public function setSpace($space) {
        $this->space = $space;
    }

    public function setShareQuota($shareQuota) {
        $this->shareQuota = $shareQuota;
    }
}
