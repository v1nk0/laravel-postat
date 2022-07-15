<?php

namespace V1nk0\LaravelPostat\Entities;

class IconDescription
{
    public function __construct(
        public string $iconCode,
        public bool $iconStatus,
        public int $iconOrder,
    ){}
}
