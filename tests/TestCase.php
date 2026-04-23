<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Str;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        Str::createUuidsUsing(function () {
            $bytes = random_bytes(16);

            $bytes[6] = chr((ord($bytes[6]) & 0x0f) | 0x40);
            $bytes[8] = chr((ord($bytes[8]) & 0x3f) | 0x80);

            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($bytes), 4));

            return new class($uuid)
            {
                public function __construct(private string $uuid)
                {
                }

                public function toString(): string
                {
                    return $this->uuid;
                }

                public function __toString(): string
                {
                    return $this->uuid;
                }
            };
        });
    }

    protected function tearDown(): void
    {
        Str::createUuidsUsing();

        parent::tearDown();
    }
}
