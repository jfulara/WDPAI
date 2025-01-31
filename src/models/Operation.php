<?php

class Operation
{
    private $title;
    private $amount;
    private $date;
    private $category;

    public function __construct(string $title, string $amount, string $date, string $category) {
        $this->title = $title;
        $this->amount = $amount;
        $this->date = $date;
        $this->category = $category;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getAmount(): string
    {
        return $this->amount;
    }

    public function setAmount(string $amount)
    {
        $this->amount = $amount;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    public function setCategory(string $category)
    {
        $this->category = $category;
    }
}