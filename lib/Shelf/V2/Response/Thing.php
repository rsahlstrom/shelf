<?php

namespace Shelf\V2\Response;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * Common response class for all the types returned from the thing api endpoint
 */
abstract class Thing implements ResponseClassInterface
{
    /**
     * Raw xml data from the api end point
     *
     * @var SimpleXmlElement
     */
    protected $rawData;

    /**
     * Flag to keep track whether the rawData returned from the api endpoint
     * has been processed
     *
     * @var boolean
     */
    protected $processed = false;

    /**
     * Constructor for the response
     *
     * @param \SimpleXMLElement $xml XML response from BGG API
     */
    public function __construct(\SimpleXMLElement $xml)
    {
        $this->rawXml = $xml;
    }

    /**
     * Has the raw xml been processed?
     *
     * @return boolean
     */
    public function isProcessed()
    {
        return $this->processed;
    }

    /**
     * Process the raw xml data
     *
     * @return void
     */
    abstract public function process();

    /**
     * Process a string from the xml api to remove entities, trim the result, and
     * run any other needed methods
     *
     * @param string $string
     *
     * @return string
     */
    public function processString($string)
    {
        return trim(html_entity_decode($string));
    }

    /**
     * Static method required by guzzle's ResponseClassInterface to process the
     * response from the API. Turns the response into a thing request object.
     *
     * @param OperationCommand $command
     *
     * @return Thing
     */
    public static function fromCommand(OperationCommand $command)
    {
        return new static($command->getResponse()->xml());
    }
}
