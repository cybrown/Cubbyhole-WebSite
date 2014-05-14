<?php

namespace Cubbyhole\WebApiBundle\Entity;

class Plan
{
    protected $name;
    protected $price;
    protected $bandwidthDownload;
    protected $bandwidthUpload;
    protected $space;
    protected $shareQuota;
    
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
