<?php

namespace Secomm\ObPlRe\Plugin;

class DemoPlugin
{
    public function beforeSetTitle(\Secomm\ObPlRe\Controller\Index\Index $subject, $title)
    {
        $title = $title . " to ";
        echo __METHOD__ . "</br>";

        return [$title];
    }

    public function afterGetTitle(\Secomm\ObPlRe\Controller\Index\Index $subject, $result)
    {
        echo __METHOD__ . "</br>";

        return '<h1>' . $result . 'secomm' . '</h1>';
    }

    public function aroundGetTitle(\Secomm\ObPlRe\Controller\Index\Index $subject, callable $proceed)
    {
        echo __METHOD__ . " - Before proceed() </br>";
        $result = $proceed();
        echo __METHOD__ . " - After proceed() </br>";

        return $result;
    }
}
