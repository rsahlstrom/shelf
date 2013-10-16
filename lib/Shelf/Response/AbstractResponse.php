<?php

namespace Shelf\Response;

use Shelf\Factory\FactoryInterface;

use Guzzle\Service\Command\OperationCommand;
use Guzzle\Service\Command\ResponseClassInterface;

/**
 * Common response class for all the types returned from the thing api endpoint
 */
abstract class AbstractResponse implements ResponseClassInterface
{
    /**
     * Raw xml data from the api end point
     *
     * @var SimpleXmlElement
     */
    protected $rawData;

    /**
     * Processed data from the response
     *
     * @var Shelf\Common\Model\DataAbstract[]
     */
    protected $processedData;

    /**
     * Factory in charge of turning the xml data into the correct data array
     *
     * @var Factory
     */
    protected $factory = null;

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
        $this->rawData = $xml;
    }

    /**
     * Sets the factory to be used in processing
     *
     * @param FactoryInterface $factory
     */
    public function setFactory(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Returns the factory to be used in processing. If no factory is set, the
     * default factory is returned instead
     *
     * @return FactoryInterface
     */
    public function getFactory()
    {
        if ($this->factory === null) {
            return $this->getDefaultFactory();
        }

        return $this->factory;
    }

    /**
     * Returns the default factory to be used if no other factory is defined
     *
     * @return FactoryInterface
     */
    abstract protected function getDefaultFactory();

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
     * @return Shelf\Common\Model\DataAbstract[]
     */
    public function process()
    {
        if ($this->isProcessed()) {
            return $this->processedData;
        }

        $factory = $this->getFactory();
        $this->processedData = $factory->fromBggXml($this->rawData);

        $this->processed = true;

        return $this->processedData;
    }

    /**
     * Returns the processed data
     *
     * @return Shelf\Common\Model\DataAbstract[]
     */
    public function getProcessedData()
    {
        return $this->process();
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
