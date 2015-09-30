<?php

class MageHost_CacheBuster_Block_Html_Head extends Mage_Page_Block_Html_Head
{
    /**
     * {@inheritdoc}
     */
    protected function &_prepareStaticAndSkinElements( $format,
                                                       array $staticItems,
                                                       array $skinItems,
                                                       $mergeCallback = null ) {

        $html = parent::_prepareStaticAndSkinElements( $format, $staticItems, $skinItems, $mergeCallback );

        if ( Mage::getStoreConfigFlag('web/cache_buster/active') ) {
            $add  = sprintf( '?%s=%s',
                             Mage::getStoreConfig('web/cache_buster/param'),
                             Mage::getStoreConfig('web/cache_buster/value') );
            $html = preg_replace( '/\.(css|js)"/i', '.$1'.$add.'"', $html );
        }

        return $html;
    }
}
