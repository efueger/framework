<?php

namespace Framework\Service\Config\Call;

interface CallInterface
{
    /**
     * @return array
     */
    public function args();

    /**
     * @return string
     */
    public function config();
}
