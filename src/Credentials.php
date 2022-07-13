<?php

namespace V1nk0\LaravelPostat;

class Credentials
{
    public function __construct(
        private int $clientId,
        private string $orgUnitGuid,
        private string $orgUnitId
    ){}

    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function setOrgUnitGuid(string $orgUnitGuid): void
    {
        $this->orgUnitGuid = $orgUnitGuid;
    }

    public function setOrgUnitId(int $orgUnitId): void
    {
        $this->orgUnitId = $orgUnitId;
    }

    public function getClientId(): int
    {
        return $this->clientId;
    }

    public function getOrgUnitGuid(): string
    {
        return $this->orgUnitGuid;
    }

    public function getOrgUnitId(): int
    {
        return $this->orgUnitId;
    }
}