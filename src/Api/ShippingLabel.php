<?php

namespace integready\Stamps\Api;

use Exception as ApiException;
use integready\Stamps\Address\AddressInterface;

/**
 * Client to generate shipping labels.
 */
class ShippingLabel extends AbstractClient implements ShippingLabelInterface
{
    const RATE_SERVICE_TYPE_US_FC     = 'US-FC';
    const RATE_SERVICE_TYPE_US_MM     = 'US-MM';
    const RATE_SERVICE_TYPE_US_PP     = 'US-PP';
    const RATE_SERVICE_TYPE_US_PM     = 'US-PM';
    const RATE_SERVICE_TYPE_US_XM     = 'US-XM';
    const RATE_SERVICE_TYPE_US_EMI    = 'US-EMI';
    const RATE_SERVICE_TYPE_US_PMI    = 'US-PMI';
    const RATE_SERVICE_TYPE_US_FCI    = 'US-FCI';
    const RATE_SERVICE_TYPE_US_PS     = 'US-PS';
    const RATE_SERVICE_TYPE_US_LM     = 'US-LM';
    const RATE_SERVICE_TYPE_DHL_PE    = 'DHL-PE';
    const RATE_SERVICE_TYPE_DHL_PG    = 'DHL-PG';
    const RATE_SERVICE_TYPE_DHL_PPE   = 'DHL-PPE';
    const RATE_SERVICE_TYPE_DHL_PPG   = 'DHL-PPG';
    const RATE_SERVICE_TYPE_DHL_BPME  = 'DHL-BPME';
    const RATE_SERVICE_TYPE_DHL_BPMG  = 'DHL-BPMG';
    const RATE_SERVICE_TYPE_DHL_MPE   = 'DHL-MPE';
    const RATE_SERVICE_TYPE_DHL_MPG   = 'DHL-MPG';
    const RATE_SERVICE_TYPE_AS_IPA    = 'AS-IPA';
    const RATE_SERVICE_TYPE_AS_ISAL   = 'AS-ISAL';
    const RATE_SERVICE_TYPE_AS_EPKT   = 'AS-EPKT';
    const RATE_SERVICE_TYPE_DHL_PIPA  = 'DHL-PIPA';
    const RATE_SERVICE_TYPE_DHL_PISAL = 'DHL-PISAL';
    const RATE_SERVICE_TYPE_GG_IPA    = 'GG-IPA';
    const RATE_SERVICE_TYPE_GG_ISAL   = 'GG-ISAL';
    const RATE_SERVICE_TYPE_GG_EPKT   = 'GG-EPKT';
    const RATE_SERVICE_TYPE_IBC_IPA   = 'IBC-IPA';
    const RATE_SERVICE_TYPE_IBC_ISAL  = 'IBC-ISAL';
    const RATE_SERVICE_TYPE_IBC_EPKT  = 'IBC-EPKT';
    const RATE_SERVICE_TYPE_RRD_IPA   = 'RRD-IPA';
    const RATE_SERVICE_TYPE_RRD_ISAL  = 'RRD-ISAL';
    const RATE_SERVICE_TYPE_RRD_EPKT  = 'RRD-EPKT';
    const RATE_SERVICE_TYPE_AS_GNRC   = 'AS-GNRC';
    const RATE_SERVICE_TYPE_GG_GNRC   = 'GG-GNRC';
    const RATE_SERVICE_TYPE_RRD_GNRC  = 'RRD-GNRC';
    const RATE_SERVICE_TYPE_SC_GPE    = 'SC-GPE';
    const RATE_SERVICE_TYPE_SC_GPP    = 'SC-GPP';
    const RATE_SERVICE_TYPE_SC_GPESS  = 'SC-GPESS';
    const RATE_SERVICE_TYPE_SC_GPPSS  = 'SC-GPPSS';
    const RATE_SERVICE_TYPE_DHL_EWW   = 'DHL-EWW';
    const RATE_SERVICE_TYPE_FX_GD     = 'FX-GD';
    const RATE_SERVICE_TYPE_FX_HD     = 'FX-HD';
    const RATE_SERVICE_TYPE_FX_2D     = 'FX-2D';
    const RATE_SERVICE_TYPE_FX_ES     = 'FX-ES';
    const RATE_SERVICE_TYPE_FX_SO     = 'FX-SO';
    const RATE_SERVICE_TYPE_FX_PO     = 'FX-PO';
    const RATE_SERVICE_TYPE_FX_GDI    = 'FX-GDI';
    const RATE_SERVICE_TYPE_FX_EI     = 'FX-EI';
    const RATE_SERVICE_TYPE_FX_PI     = 'FX-PI';

    const RATE_PRINT_LAYOUT_NORMAL          = 'Normal';
    const RATE_PRINT_LAYOUT_NORMALLEFT      = 'NormalLeft';
    const RATE_PRINT_LAYOUT_NORMALRIGHT     = 'NormalRight';
    const RATE_PRINT_LAYOUT_NORMAL4X6       = 'Normal4X6';
    const RATE_PRINT_LAYOUT_NORMAL4X45      = 'Normal4X45';
    const RATE_PRINT_LAYOUT_NORMAL4X5       = 'Normal4x5';
    const RATE_PRINT_LAYOUT_NORMAL4X825     = 'Normal4x825';
    const RATE_PRINT_LAYOUT_NORMAL6X4       = 'Normal6X4';
    const RATE_PRINT_LAYOUT_NORMAL75X2      = 'Normal75X2';
    const RATE_PRINT_LAYOUT_NORMALRECEIPT   = 'NormalReceipt';
    const RATE_PRINT_LAYOUT_NORMALCN22      = 'NormalCN22';
    const RATE_PRINT_LAYOUT_NORMALCP72      = 'NormalCP72';
    const RATE_PRINT_LAYOUT_NORMAL4X6CN22   = 'Normal4X6CN22';
    const RATE_PRINT_LAYOUT_NORMAL6X4CN22   = 'Normal6X4CN22';
    const RATE_PRINT_LAYOUT_NORMAL4X6CP72   = 'Normal4X6CP72';
    const RATE_PRINT_LAYOUT_NORMAL6X4CP72   = 'Normal6X4CP72';
    const RATE_PRINT_LAYOUT_NORMAL4X675     = 'Normal4X675';
    const RATE_PRINT_LAYOUT_NORMAL4X675CN22 = 'Normal4X675CN22';
    const RATE_PRINT_LAYOUT_NORMAL4X675CP72 = 'Normal4X675CP72';
    const RATE_PRINT_LAYOUT_RETURN          = 'Return';
    const RATE_PRINT_LAYOUT_RETURNCN22      = 'ReturnCN22';
    const RATE_PRINT_LAYOUT_RETURNCP72      = 'ReturnCP72';
    const RATE_PRINT_LAYOUT_RETURN4X675     = 'Return4X675';
    const RATE_PRINT_LAYOUT_RETURN4X825     = 'Return4x825';
    const RATE_PRINT_LAYOUT_RETURN6X4       = 'Return6X4';
    const RATE_PRINT_LAYOUT_RETURN4X45      = 'Return4X45';
    const RATE_PRINT_LAYOUT_RETURN4X675CN22 = 'Return4X675CN22';
    const RATE_PRINT_LAYOUT_RETURN4X675CP72 = 'Return4X675CP72';
    const RATE_PRINT_LAYOUT_SDC3510         = 'SDC3510';
    const RATE_PRINT_LAYOUT_SDC3520         = 'SDC3520';
    const RATE_PRINT_LAYOUT_SDC3530         = 'SDC3530';
    const RATE_PRINT_LAYOUT_SDC3610         = 'SDC3610';
    const RATE_PRINT_LAYOUT_SDC3710         = 'SDC3710';
    const RATE_PRINT_LAYOUT_SDC3810         = 'SDC3810';
    const RATE_PRINT_LAYOUT_SDC3820         = 'SDC3820';
    const RATE_PRINT_LAYOUT_SDC3830         = 'SDC3830';
    const RATE_PRINT_LAYOUT_SDC3910         = 'SDC3910';
    const RATE_PRINT_LAYOUT_SDC3930         = 'SDC3930';

    const RATE_PACKAGE_TYPE_UNKNOWN                   = 'Unknown';
    const RATE_PACKAGE_TYPE_POSTCARD                  = 'Postcard';
    const RATE_PACKAGE_TYPE_LETTER                    = 'Letter';
    const RATE_PACKAGE_TYPE_LARGE_ENVELOPE_OR_FLAT    = 'Large Envelope or Flat';
    const RATE_PACKAGE_TYPE_THICK_ENVELOPE            = 'Thick Envelope';
    const RATE_PACKAGE_TYPE_PACKAGE                   = 'Package';
    const RATE_PACKAGE_TYPE_SMALL_FLAT_RATE_BOX       = 'Small Flat Rate Box';
    const RATE_PACKAGE_TYPE_FLAT_RATE_BOX             = 'Flat Rate Box';
    const RATE_PACKAGE_TYPE_LARGE_FLAT_RATE_BOX       = 'Large Flat Rate Box';
    const RATE_PACKAGE_TYPE_FLAT_RATE_ENVELOPE        = 'Flat Rate Envelope';
    const RATE_PACKAGE_TYPE_FLAT_RATE_PADDED_ENVELOPE = 'Flat Rate Padded Envelope';
    const RATE_PACKAGE_TYPE_LARGE_PACKAGE             = 'Large Package';
    const RATE_PACKAGE_TYPE_OVERSIZED_PACKAGE         = 'Oversized Package';
    const RATE_PACKAGE_TYPE_REGIONAL_RATE_BOX_A       = 'Regional Rate Box A';
    const RATE_PACKAGE_TYPE_REGIONAL_RATE_BOX_B       = 'Regional Rate Box B';
    const RATE_PACKAGE_TYPE_REGIONAL_RATE_BOX_C       = 'Regional Rate Box C';
    const RATE_PACKAGE_TYPE_LEGAL_FLAT_RATE_ENVELOPE  = 'Legal Flat Rate Envelope';
    const RATE_PACKAGE_TYPE_EXPRESS_ENVELOPE          = 'Express Envelope';
    const RATE_PACKAGE_TYPE_DOCUMENTS                 = 'Documents';
    const RATE_PACKAGE_TYPE_ENVELOPE                  = 'Envelope';
    const RATE_PACKAGE_TYPE_PAK                       = 'Pak';

    const IMAGE_TYPE_AUTO            = 'Auto';
    const IMAGE_TYPE_AZPL            = 'AZpl';
    const IMAGE_TYPE_BZPL            = 'BZpl';
    const IMAGE_TYPE_ENCRYPTEDPNGURL = 'EncryptedPngUrl';
    const IMAGE_TYPE_EPL             = 'Epl';
    const IMAGE_TYPE_GIF             = 'Gif';
    const IMAGE_TYPE_JPG             = 'Jpg';
    const IMAGE_TYPE_PDF             = 'Pdf';
    const IMAGE_TYPE_PRINTONCEPDF    = 'PrintOncePdf';
    const IMAGE_TYPE_PNG             = 'Png';
    const IMAGE_TYPE_ZPL             = 'Zpl';
    const IMAGE_TYPE_BMP             = 'Bmp';
    const IMAGE_TYPE_BMPMONOCHROME   = 'BmpMonochrome';
    const IMAGE_TYPE_PNGMONOCHROME   = 'PngMonochrome';
    const IMAGE_TYPE_JPGMONOCHROME   = 'JpgMonochrome';
    const IMAGE_TYPE_GIFMONOCHROME   = 'GifMonochrome';

    const MODE_NORMAL    = 'Normal';
    const MODE_SAMPLE    = 'Sample';
    const MODE_NOPOSTAGE = 'NoPostage';
    const MODE_PREVIEW   = 'Preview';

    /**
     * If true, generates a sample label without real value.
     * @var bool
     */
    protected $isSampleOnly = true;

    /**
     * If true, the price will not be printed on the label.
     * @var bool
     */
    protected $showPrice = false;

    /**
     * The weight of the package in ounces.
     * @var float
     */
    protected $weightOz = 0.0;

    /**
     * The file type of shipping label.
     * @var string
     */
    protected $imageType = self::IMAGE_TYPE_AUTO;

    /**
     * The manner in which the envelope image is created. Default is Normal.
     * @var string
     */
    protected $mode = self::MODE_NORMAL;

    /**
     * The package type.
     * @var string
     */
    protected $packageType = self::RATE_PACKAGE_TYPE_UNKNOWN;

    /**
     * Print layout.
     * @var string
     */
    protected $printLayout = self::RATE_PRINT_LAYOUT_NORMAL;

    /**
     * The mail service type.
     * @var string
     */
    protected $serviceType = self::RATE_SERVICE_TYPE_US_FC;

    /**
     * The sender's adddress.
     * @var AddressInterface
     */
    protected $from;

    /**
     * The recipient's address.
     * @var AddressInterface
     */
    protected $to;

    /**
     * This is the date the package will be picked up or officially enter the mail system.
     * Defaults to the current date('Y-m-d').
     * @var string
     */
    protected $shipDate;

    /**
     * {@inheritdoc}
     */
    public function setFrom(AddressInterface $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * {@inheritdoc}
     */
    public function setTo(AddressInterface $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * {@inheritdoc}
     */
    public function setIsSampleOnly($flag)
    {
        $this->isSampleOnly = (bool)$flag;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIsSampleOnly()
    {
        return $this->isSampleOnly;
    }

    /**
     * {@inheritdoc}
     */
    public function setImageType($type)
    {
        $this->imageType = (string)$type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getImageType()
    {
        return $this->imageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setMode($mode)
    {
        $this->mode = (string)$mode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * {@inheritdoc}
     */
    public function setPackageType($type)
    {
        $this->packageType = (string)$type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPackageType()
    {
        return $this->packageType;
    }

    /**
     * {@inheritdoc}
     */
    public function setPrintLayout($type)
    {
        $this->printLayout = (string)$type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPrintLayout()
    {
        return $this->printLayout;
    }

    /**
     * {@inheritdoc}
     */
    public function setServiceType($type)
    {
        $this->serviceType = (string)$type;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * {@inheritdoc}
     */
    public function setWeightOz($weight)
    {
        $this->weightOz = (float)$weight;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeightOz()
    {
        return $this->weightOz;
    }

    /**
     * {@inheritdoc}
     */
    public function setShipDate($date)
    {
        $this->shipDate = date('Y-m-d', strtotime($date));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShipDate()
    {
        return $this->shipDate;
    }

    /**
     * {@inheritdoc}
     */
    public function setShowPrice($flag)
    {
        $this->showPrice = (bool)$flag;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getShowPrice()
    {
        return $this->showPrice;
    }

    /**
     * {@inheritdoc}
     */
    public function create($filename = null)
    {
        // 1. Check account balance

        $accountInfoResponse = $this->soapClient->GetAccountInfo([
            'Credentials' => $this->getCredentials(),
        ]);

        $availableBalance = (double)$accountInfoResponse->AccountInfo->PostageBalance->AvailablePostage;

        if ($availableBalance < 3) {
            throw new ApiException('Insufficient funds: ' . $availableBalance);
        }

        // 2. Cleanse addresses

        $cleanseFromAddressResponse = $this->soapClient->CleanseAddress([
            'Credentials' => $this->getCredentials(),
            'Address'     => [
                'FullName'    => $this->from->getFullname(),
                'Address1'    => $this->from->getAddress1(),
                'Address2'    => $this->from->getAddress2(),
                'City'        => $this->from->getCity(),
                'State'       => $this->from->getState(),
                'ZIPcode'     => $this->from->getZipcode(),
                'FromZIPCode' => substr($this->from->getZipcode(), 0, 3),
            ],
            'FromZIPCode' => $this->from->getZipcode(),
        ]);

        if (!$cleanseFromAddressResponse->CityStateZipOK) {
            throw new ApiException('Invalid from address.');
        }

        $cleanseToAddressResponse = $this->soapClient->CleanseAddress([
            'Credentials' => $this->getCredentials(),
            'Address'     => [
                'FullName'    => $this->to->getFullname(),
                'Address1'    => $this->to->getAddress1(),
                'Address2'    => $this->to->getAddress2(),
                'City'        => $this->to->getCity(),
                'State'       => $this->to->getState(),
                'ZIPcode'     => $this->to->getZipcode(),
                'FromZIPCode' => substr($this->from->getZipcode(), 0, 3),
            ],
            'FromZIPCode' => $this->from->getZipcode(),
        ]);

        if (!$cleanseToAddressResponse->CityStateZipOK) {
            throw new ApiException('Invalid to address.');
        }

        // 3. Get rates

        $rateOptions = [
            'FromZIPCode'  => substr($this->from->getZipcode(), 0, 3),
            'ToZIPCode'    => $this->to->getZipcode(),
            'ToCountry'    => $this->to->getCountry(),
            'WeightOz'     => $this->weightOz,
            'WeightLb'     => '0.0',
            'ShipDate'     => $this->shipDate,
            'ServiceType'  => $this->serviceType,
            'PackageType'  => $this->packageType,
            'PrintLayout'  => $this->printLayout,
            'InsuredValue' => '0.0',
            'AddOns'       => [],
        ];

        if (!$this->showPrice) {
            $rateOptions['AddOns'][] = [
                'AddOnType' => 'SC-A-HP' // Hide price on label
            ];
        }

        $rates = $this->soapClient->GetRates([
            'Credentials' => $this->getCredentials(),
            'Rate'        => $rateOptions,
        ]);

        $rateOptions['Rate']['Amount'] = $rates->Rates->Rate->Amount;

        // 4. Generate label

        $labelOptions = [
            'Credentials'    => $this->getCredentials(),
            'IntegratorTxID' => time(),
            'SampleOnly'     => $this->isSampleOnly,
            'ImageType'      => $this->imageType,
            'Mode'           => $this->mode,

            'Rate' => $rateOptions,

            'From' => [
                'FullName' => $this->from->getFullname(),
                'Address1' => $this->from->getAddress1(),
                'Address2' => $this->from->getAddress2(),
                'City'     => $this->from->getCity(),
                'Country'  => $this->from->getCountry(),
                'State'    => $this->from->getState(),
                'ZIPCode'  => $this->from->getZipcode(),
            ],

            'To' => [
                'FullName' => $this->to->getFullname(),
                'Address1' => $this->to->getAddress1(),
                'Address2' => $this->to->getAddress2(),
                'City'     => $this->to->getCity(),
                'Country'  => $this->to->getCountry(),
                'State'    => $this->to->getState(),
                'ZIPCode'  => $this->to->getZipcode(),
            ],
        ];

        $indiciumResponse = $this->soapClient->CreateIndicium($labelOptions);

        if ($filename) {
            $ch = curl_init($indiciumResponse->URL);
            $fp = fopen($filename, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
        }

        return $indiciumResponse->URL;
    }
}
