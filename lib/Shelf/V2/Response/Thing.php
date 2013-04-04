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

    public static function fromCommand(OperationCommand $command)
    {
        echo $command->getRequest();exit;
        return new static($command->getResponse()->xml());
    }
}
