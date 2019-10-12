<?php


namespace App\Dto;


class IdLabelValue
{
    public $id;

    public $lablel;

    public $value;

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLablel()
    {
        return $this->lablel;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $lablel
     */
    public function setLablel($lablel): void
    {
        $this->lablel = $lablel;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }

}