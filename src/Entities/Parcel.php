<?php

namespace V1nk0\LaravelPostat\Entities;

class Parcel
{
    /**
     * @param string $identCode
     * @param string|null $referenceIdentCode
     * @param string|null $referencedParcelIdentCode
     * @param string|null $colliRefNr
     * @param float|null $weight
     * @param IconDescription[] $iconDescriptionList
     * @param ParcelEvent[] $parcelEvents
     */
    public function __construct(
        public string $identCode,
        public ?string $referenceIdentCode = null,
        public ?string $referencedParcelIdentCode = null,
        public ?string $colliRefNr = null,
        public ?float $weight = null,
        public array $iconDescriptionList = [],
        public array $parcelEvents = [],
    ){}

    public function addIconDescription(IconDescription $iconDescription)
    {
        $this->iconDescriptionList[] = $iconDescription;
    }

    public function addParcelEvent(ParcelEvent $parcelEvent)
    {
        $this->parcelEvents[] = $parcelEvent;
    }

    public function getLastParcelEvent(): ?ParcelEvent
    {
        if(count($this->parcelEvents) < 1) {
            return null;
        }

        $events = $this->parcelEvents;
        return end($events);
    }

    // Shortcut for addIconDescription()
    public function addIcon(IconDescription $iconDescription)
    {
        $this->addIconDescription($iconDescription);
    }

    // Shortcut for addParcelEvent()
    public function addEvent(ParcelEvent $parcelEvent)
    {
        $this->addParcelEvent($parcelEvent);
    }

    // Shortcut for getLastParcelEvent()
    public function getLastEvent()
    {
        $this->getLastParcelEvent();
    }
}
