<?php

namespace V1nk0\LaravelPostat;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use V1nk0\LaravelPostat\Entities\IconDescription;
use V1nk0\LaravelPostat\Entities\Parcel;
use V1nk0\LaravelPostat\Entities\ParcelDetail;
use V1nk0\LaravelPostat\Entities\ParcelEvent;
use V1nk0\LaravelPostat\Enums\EventTypeCode;
use V1nk0\LaravelPostat\Enums\ReasonCode;
use V1nk0\LaravelPostat\Enums\TrackingState;

class Tracking
{
    private string $username;

    private string $password;

    public function __construct()
    {
        $this->username = config('services.postat.tracking.username');
        $this->password = config('services.postat.tracking.password');
    }

    /** @throws Exception */
    public function parcelDetail(string $trackingNumber): ?ParcelDetail
    {
        try {
            $response = Http::withBasicAuth($this->username, $this->password)
                ->withoutVerifying() // hopefully prevents cURL SSL-errors that only occur sometimes
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->post('https://customerservices.post.at/api/v1/GetParcelDetail?format=json', [
                    'IdentCode' => $trackingNumber,
                    'WithDescription' => "true",
                ]);

            $response->throw();

            if(!$response->successful()) {
                return null;
            }

            $body = json_decode($response->body());

            $parcels = [];
            foreach($body->Parcels as $parcel) {
                $iconDescriptionList = [];
                foreach($parcel->IconDescriptionList as $iconDescription) {
                    $iconDescriptionList[] = new IconDescription(
                        (string)$iconDescription->IconCode,
                        (bool)$iconDescription->IconStatus,
                        (int)$iconDescription->IconOrder,
                    );
                }

                $events = [];

                foreach($parcel->ParcelEvents as $event) {

                    $reasonCode =  ReasonCode::tryFrom($event->ParcelEventReasonCode);
                    if(!$reasonCode) {
                        Log::error('Unknown reasonCode ' . $event->ParcelEventReasonCode);
                        continue;
                    }

                    $eventTypeCode = EventTypeCode::tryFrom($event->ParcelEventTypeCode);
                    if(!$eventTypeCode) {
                        Log::error('Unknown eventTypeCode ' . $event->ParcelEventTypeCode);
                        continue;
                    }

                    $trackingState = TrackingState::tryFrom($event->TrackingState);
                    if(!$trackingState) {
                        Log::error('Unknown trackingState ' . $event->TrackingState);
                        continue;
                    }

                    $events[] = new ParcelEvent(
                        Carbon::parse($event->EventTimestamp),
                        $reasonCode,
                        $eventTypeCode,
                        $trackingState,
                        $event->EventCountry ?? null,
                        $event->EventLocation ?? null,
                        $event->EventPostalCode ?? null,
                        $event->ConsigneeName ?? null,
                        $event->Remark ?? null,
                        $event->BranchKey ?? null,
                        $event->Depository ?? null,
                        ($event->EndOfStorageDate) ? Carbon::parse($event->EndOfStorageDate) : null,
                        $event->PickupCode ?? null,
                        $event->Amount ?? null,
                        $event->PickupLink ?? null,
                    );
                }

                $parcels[] = new Parcel(
                    $parcel->IdentCode,
                    $parcel->ReferenceIdentCode ?? null,
                    $parcel->ReferencedParcelIdentCode ?? null,
                    $parcel->ColliRefNr ?? null,
                    ($parcel->Weight) ? (float)$parcel->Weight : null,
                    $iconDescriptionList,
                    $events,
                );
            }
        }
        catch(Exception $e) {
            throw new Exception($e->getMessage());
        }

        return new ParcelDetail(
            $body->CustomerIdentCode,
            $body->ProductName,
            $body->CustomerShipmentNr ?? null,
            $body->ShpRefNr ?? null,
            $body->CostCenterRefNr ?? null,
            $body->AlternativeRefNr ?? null,
            ($body->DeliveryDay) ? Carbon::parse($body->DeliveryDay) : null,
            $body->DeliveryTimeFrameFrom ?? null,
            $body->DeliveryTimeFrameTo ?? null,
            $body->SapOrderNr ?? null,
            $body->SapInvoiceNr ?? null,
            $parcels,
        );
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
