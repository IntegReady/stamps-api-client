# Stamps.com API Client

Stamps API Client for creating shipping labels, envelopes, checking addresses, etc.

### Usage

```php
$to   = []; // Sender's address
$from = []; // Address of the recipient

$toAddress = (new \integready\stamps\address\Address())
    ->setFullname($to['fullname'])
    ->setAddress1($to['address1'])
    ->setAddress2($to['address2'])
    ->setCity($to['city'])
    ->setState($to['state'])
    ->setZipcode($to['zipCode'])
    ->setCountry($to['country']);

$fromAddress = (new \integready\stamps\address\Address())
    ->setFullname($from['fullname'])
    ->setAddress1($from['address1'])
    ->setAddress2($from['address2'])
    ->setCity($from['city'])
    ->setState($from['state'])
    ->setZipcode($from['zipCode'])
    ->setCountry($from['country']);

try {
    $shippingLabel = (new  \integready\stamps\api\Envelope())
        ->setApiUrl(API_URL) // Leave out for default
        ->setApiIntegrationId(YOUR_API_INTEGRATION_ID)
        ->setApiUserId(YOUR_API_USER_ID)
        ->setApiPassword(YOUR_API_PASSWORD)
        ->setImageType(\integready\stamps\api\Envelope::IMAGE_TYPE_PNG)
        ->setPackageType(\integready\stamps\api\Envelope::RATE_PACKAGE_TYPE_LETTER)
        ->setServiceType(\integready\stamps\api\Envelope::RATE_SERVICE_TYPE_US_FC)
        ->setPrintLayout(\integready\stamps\api\Envelope::RATE_PRINT_LAYOUT_ENVELOPE10)
        ->setMode(\integready\stamps\api\Envelope::MODE_NOPOSTAGE)
        ->setFrom($fromAddress)
        ->setTo($toAddress)
        ->setIsSampleOnly(false)
        ->setShowPrice(true)
        ->setWeightOz(100)
        ->setShipDate(date('Y-m-d'));

    $labelUrl = $shippingLabel->create();
} catch(Exception $e) {
    // Handle exception
}
```
