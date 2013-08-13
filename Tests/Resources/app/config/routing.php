<?php
/**
 * @author Nicolas Bastien <nbastien@prestaconcept.net>
 */
use Symfony\Component\Routing\RouteCollection;

$collection = new RouteCollection();
$collection->addCollection(
    $loader->import(CMF_TEST_CONFIG_DIR.'/routing/sonata_routing.yml')
);
//$collection->addCollection(
//    $loader->import(__DIR__.'/routing/test.yml')
//);

return $collection;