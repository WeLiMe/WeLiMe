<?php
/**
 * Created by PhpStorm.
 * User: a4i
 * Date: 1/5/15
 * Time: 8:37 PM
 */

namespace WeLiMe\Models\HTMLFormData;

class MessageForm
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    function __construct($content = "")
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }
}
