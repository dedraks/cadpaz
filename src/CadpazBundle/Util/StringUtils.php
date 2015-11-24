<?php

namespace CadpazBundle\Utils;

class StringUtils
{
    public function LReplace($search, $replace, $subject)
    {
        return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
    }
}
