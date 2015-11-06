<?php

namespace nlp\Podio\Models;

use nlp\Podio\Collections\ArrayCollection;

/**
 * Class Action
 * @package nlp\Podio\Models
 */
class Action
{
    /** @var integer */
    protected $id;

    /** @var string */
    protected $type;

    /** @var string */
    protected $data;

    /** @var ArrayCollection|Comment[] */
    protected $comments;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return array|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param array|ArrayCollection $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }
}
