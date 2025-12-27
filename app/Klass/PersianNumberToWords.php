<?php

namespace App\Klass;
namespace App\Klass;

class PersianNumberToWords
{
    private Dictionary $dictionary;

    public function __construct(Dictionary $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    public function convert(int $number)
    {
        return (new Converter($this->dictionary))->convert($number);
    }

}
