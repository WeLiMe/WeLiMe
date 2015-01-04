<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/1/15
 * Time: 8:36 PM
 */

namespace WeLiMe\Models\Entities;

class Conversation
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    function __construct()
    {
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
