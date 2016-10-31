<?php
namespace PHPSTL\Reader;


use PHPSTL\Handler\HandlerInterface;
use PHPSTL\Handler\STLModelHandler;
use PHPSTL\Model\Facet;
use PHPSTL\Model\STLModel;

abstract class BaseSTLReader
{
    protected $handle;
    /** @var HandlerInterface */
    protected $handler;

    /** @return string ModelName */
    abstract protected function readModelName();

    /** @return Facet|null */
    abstract protected function getNextFacet();

    public function __construct($handle)
    {
        $this->handler = new STLModelHandler();
        $this->handle = $handle;
    }

    /** @return STLModel|mixed */
    public function readModel()
    {
        rewind($this->handle);
        $modelName = $this->readModelName();
        $this->handler->onModelName($modelName);
        while ($facet = $this->getNextFacet()) {
            $this->handler->onFacet($facet);
        }

        return $this->handler->result();
    }

    /**
     * @param HandlerInterface $handler
     */
    public function setHandler(HandlerInterface $handler)
    {
        $this->handler = $handler;
    }
}