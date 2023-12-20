<?php

namespace Framework\Tests;

class AreaWeb
{
    public function __construct(
        private readonly Telegram $telegram,
        private readonly Yotube $yotube,
    )
    {

    }

    /**
     * @return Telegram
     */
    public function getTelegram(): Telegram
    {
        return $this->telegram;
    }

    /**
     * @return Yotube
     */
    public function getYotube(): Yotube
    {
        return $this->yotube;
    }

}