<?php

namespace integready\stamps\api;

use SoapClient;

/**
 * Base API client.
 */
abstract class AbstractClient implements ClientInterface
{
    /**
     * @var string
     */
    protected $apiUrl = 'https://swsim.stamps.com/swsim/swsimv75.asmx?WSDL';

    /**
     * @var string
     */
    protected $apiIntegrationId;

    /**
     * @var string
     */
    protected $apiUserId;

    /**
     * @var string
     */
    protected $apiPassword;

    /**
     * @var SoapClient
     */
    protected $soapClient;

    /**
     * @var string
     */
    protected $authenticateUser;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->soapClient = new SoapClient($this->apiUrl, [
            'exceptions' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUrl($url)
    {
        $this->apiUrl = $url;
        $this->soapClient->__setLocation($this->apiUrl);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiIntegrationId($integrationId)
    {
        $this->apiIntegrationId = (string)$integrationId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiIntegrationId()
    {
        return $this->apiIntegrationId;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiUserId($userId)
    {
        $this->apiUserId = (string)$userId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiUserId()
    {
        return $this->apiUserId;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiPassword($password)
    {
        $this->apiPassword = (string)$password;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getApiPassword()
    {
        return $this->apiPassword;
    }

    /**
     * Gets the auth token for API requests.
     *
     * @return string
     */
    protected function getAuthToken()
    {
        if (empty($this->authenticateUser)) {
            $response = $this->soapClient->AuthenticateUser([
                'Credentials' => $this->getCredentials(),
            ]);

            $this->authenticateUser = $response->Authenticator;
        }

        return $this->authenticateUser;
    }

    /**
     * @return array
     */
    protected function getCredentials()
    {
        return [
            'IntegrationID' => $this->apiIntegrationId,
            'Username'      => $this->apiUserId,
            'Password'      => $this->apiPassword,
        ];
    }
}
