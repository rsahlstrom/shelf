<?php

namespace Shelf\V2\Response;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

abstract class Thing implements ResponseClassInterface
{
    protected $rawData;
    protected $processed = false;

    public function __construct(\SimpleXMLElement $xml)
    {
        $this->rawXml = $xml;
    }

    public function isProcessed()
    {
        return $this->processed;
    }

    abstract public function process();

    public function processString($string)
    {
        return trim(html_entity_decode($string));
    }

    public static function fromCommand(OperationCommand $command)
    {
        return new static($command->getResponse()->xml());
    }
}
