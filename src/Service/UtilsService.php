<?php

namespace App\Service;

class UtilsService {
    public function removeChars(string $string): string {
        return str_replace([' ', '(',')','-','.','/'],'', $string);
    }
}