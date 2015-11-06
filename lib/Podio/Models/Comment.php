<?php

namespace nlp\Podio\Models;

use DateTime;
use nlp\Podio\Collections\ArrayCollection;

/**
 * Class Comment
 * @package nlp\Podio\Models
 */
class Comment extends BaseModel
{
    /** @var integer */
    protected $id;

    /** @var string */
    protected $value;

    /** @var string */
    protected $richValue;

    /** @var integer */
    protected $externalId;

    /** @var integer */
    protected $spaceId;

    /** @var DateTime */
    protected $createdOn;

    /** @var integer */
    protected $likeCount;

    /** @var boolean */
    protected $isLiked;

    /** @var ByLine */
    protected $createdBy;

    /** @var Via */
    protected $createdVia;

    /** @var Reference */
    protected $reference;

    /** @var Embed */
    protected $embed;

    /** @var EmbedFile */
    protected $embedFile;

    /** @var ArrayCollection|File[] */
    protected $files;

    /** @var ArrayCollection|Question[] */
    protected $questions;

    public function __construct()
    {
        $this->files = new ArrayCollection();
        $this->questions = new ArrayCollection();
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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getRichValue()
    {
        return $this->richValue;
    }

    /**
     * @param string $richValue
     */
    public function setRichValue($richValue)
    {
        $this->richValue = $richValue;
    }

    /**
     * @return int
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param int $externalId
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    /**
     * @return int
     */
    public function getSpaceId()
    {
        return $this->spaceId;
    }

    /**
     * @param int $spaceId
     */
    public function setSpaceId($spaceId)
    {
        $this->spaceId = $spaceId;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @param DateTime $createdOn
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    }

    /**
     * @return int
     */
    public function getLikeCount()
    {
        return $this->likeCount;
    }

    /**
     * @param int $likeCount
     */
    public function setLikeCount($likeCount)
    {
        $this->likeCount = $likeCount;
    }

    /**
     * @return boolean
     */
    public function isIsLiked()
    {
        return $this->isLiked;
    }

    /**
     * @param boolean $isLiked
     */
    public function setIsLiked($isLiked)
    {
        $this->isLiked = $isLiked;
    }

    /**
     * @return ByLine
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param ByLine $createdBy
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return Via
     */
    public function getCreatedVia()
    {
        return $this->createdVia;
    }

    /**
     * @param Via $createdVia
     */
    public function setCreatedVia($createdVia)
    {
        $this->createdVia = $createdVia;
    }

    /**
     * @return Reference
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param Reference $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return Embed
     */
    public function getEmbed()
    {
        return $this->embed;
    }

    /**
     * @param Embed $embed
     */
    public function setEmbed($embed)
    {
        $this->embed = $embed;
    }

    /**
     * @return EmbedFile
     */
    public function getEmbedFile()
    {
        return $this->embedFile;
    }

    /**
     * @param EmbedFile $embedFile
     */
    public function setEmbedFile($embedFile)
    {
        $this->embedFile = $embedFile;
    }

    /**
     * @return ArrayCollection|File[]
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param ArrayCollection|File[] $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return ArrayCollection|Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }

    /**
     * @param ArrayCollection|Question[] $questions
     */
    public function setQuestions($questions)
    {
        $this->questions = $questions;
    }
}
