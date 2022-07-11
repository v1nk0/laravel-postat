<?php

namespace V1nk0\PostatPlc\Enums;

enum SecurePickupLocationType
{
    case FrontDoor;
    case ApartmentDoor;
    case Letterbox;
    case Garage;
    case Fence;
    case Other;

    public function code(): int
    {
        return match($this) {
            SecurePickupLocationType::FrontDoor => 1,
            SecurePickupLocationType::ApartmentDoor => 2,
            SecurePickupLocationType::Letterbox => 3,
            SecurePickupLocationType::Garage => 4,
            SecurePickupLocationType::Fence => 5,
            SecurePickupLocationType::Other => 6,
        };
    }

    public function description(): string
    {
        return match($this) {
            SecurePickupLocationType::FrontDoor => 'on doorstep of front door',
            SecurePickupLocationType::ApartmentDoor => 'on doorstep of apartment door',
            SecurePickupLocationType::Letterbox => 'below / on top of letterbox',
            SecurePickupLocationType::Garage => 'in the garage',
            SecurePickupLocationType::Fence => 'behind the fence',
            SecurePickupLocationType::Other => 'other pickup location',
        };
    }
}
