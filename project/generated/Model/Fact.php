<?php

namespace CatFacts\Api\Model;

class Fact
{
    /**
     * Unique ID for the `Fact`
     *
     * @var string
     */
    protected $id;
    /**
     * Version number of the `Fact`
     *
     * @var int
     */
    protected $v;
    /**
     * ID of the `User` who added the `Fact`
     *
     * @var string
     */
    protected $user;
    /**
     * The `Fact` itself
     *
     * @var string
     */
    protected $text;
    /**
     * Date in which `Fact` was last modified
     *
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * If the `Fact` is meant for one time use, this is the date that it is used
     *
     * @var string
     */
    protected $sendDate;
    /**
     * Weather or not the `Fact` has been deleted (Soft deletes are used)
     *
     * @var bool
     */
    protected $deleted;
    /**
     * Can be `user` or `api`, indicates who added the fact to the DB
     *
     * @var string
     */
    protected $source;
    /**
     * Weather or not the `Fact` has been sent by the CatBot. This value is reset each time every `Fact` is used
     *
     * @var bool
     */
    protected $used;
    /**
     * Type of animal the `Fact` describes (e.g. ‘cat’, ‘dog’, ‘horse’)
     *
     * @var string
     */
    protected $type;
    /**
     * Unique ID for the `Fact`
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    /**
     * Unique ID for the `Fact`
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->id = $id;
        return $this;
    }
    /**
     * Version number of the `Fact`
     *
     * @return int
     */
    public function getV() : int
    {
        return $this->v;
    }
    /**
     * Version number of the `Fact`
     *
     * @param int $v
     *
     * @return self
     */
    public function setV(int $v) : self
    {
        $this->v = $v;
        return $this;
    }
    /**
     * ID of the `User` who added the `Fact`
     *
     * @return string
     */
    public function getUser() : string
    {
        return $this->user;
    }
    /**
     * ID of the `User` who added the `Fact`
     *
     * @param string $user
     *
     * @return self
     */
    public function setUser(string $user) : self
    {
        $this->user = $user;
        return $this;
    }
    /**
     * The `Fact` itself
     *
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }
    /**
     * The `Fact` itself
     *
     * @param string $text
     *
     * @return self
     */
    public function setText(string $text) : self
    {
        $this->text = $text;
        return $this;
    }
    /**
     * Date in which `Fact` was last modified
     *
     * @return \DateTime
     */
    public function getUpdatedAt() : \DateTime
    {
        return $this->updatedAt;
    }
    /**
     * Date in which `Fact` was last modified
     *
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt) : self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * If the `Fact` is meant for one time use, this is the date that it is used
     *
     * @return string
     */
    public function getSendDate() : string
    {
        return $this->sendDate;
    }
    /**
     * If the `Fact` is meant for one time use, this is the date that it is used
     *
     * @param string $sendDate
     *
     * @return self
     */
    public function setSendDate(string $sendDate) : self
    {
        $this->sendDate = $sendDate;
        return $this;
    }
    /**
     * Weather or not the `Fact` has been deleted (Soft deletes are used)
     *
     * @return bool
     */
    public function getDeleted() : bool
    {
        return $this->deleted;
    }
    /**
     * Weather or not the `Fact` has been deleted (Soft deletes are used)
     *
     * @param bool $deleted
     *
     * @return self
     */
    public function setDeleted(bool $deleted) : self
    {
        $this->deleted = $deleted;
        return $this;
    }
    /**
     * Can be `user` or `api`, indicates who added the fact to the DB
     *
     * @return string
     */
    public function getSource() : string
    {
        return $this->source;
    }
    /**
     * Can be `user` or `api`, indicates who added the fact to the DB
     *
     * @param string $source
     *
     * @return self
     */
    public function setSource(string $source) : self
    {
        $this->source = $source;
        return $this;
    }
    /**
     * Weather or not the `Fact` has been sent by the CatBot. This value is reset each time every `Fact` is used
     *
     * @return bool
     */
    public function getUsed() : bool
    {
        return $this->used;
    }
    /**
     * Weather or not the `Fact` has been sent by the CatBot. This value is reset each time every `Fact` is used
     *
     * @param bool $used
     *
     * @return self
     */
    public function setUsed(bool $used) : self
    {
        $this->used = $used;
        return $this;
    }
    /**
     * Type of animal the `Fact` describes (e.g. ‘cat’, ‘dog’, ‘horse’)
     *
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }
    /**
     * Type of animal the `Fact` describes (e.g. ‘cat’, ‘dog’, ‘horse’)
     *
     * @param string $type
     *
     * @return self
     */
    public function setType(string $type) : self
    {
        $this->type = $type;
        return $this;
    }
}