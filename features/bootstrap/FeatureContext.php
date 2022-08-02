<?php

declare(strict_types=1);

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\ResponseInterface;

class FeatureContext implements Context
{
    private ResponseInterface $response;

    public function __construct()
    {
    }

    /**
     * @Given I am an unauthenticated user
     */
    public function iAmAnUnauthenticatedUser()
    {
        $httpClient = HttpClient::create();
        $this->response = $httpClient->request('GET', 'http://localhost:8001/customer');

        if (Response::HTTP_OK !== $this->response->getStatusCode()) {
            throw new Exception('No able to access');
        }
    }

    /**
     * @When I request a list of customers from :arg1
     */
    public function iRequestAListOfCustomersFrom($arg1)
    {
        $httpClient = HttpClient::create();
        $this->response = $httpClient->request('GET', $arg1);
        $statusCode = $this->response->getStatusCode();

        if (Response::HTTP_OK !== $statusCode) {
            throw new Exception('Expected a 200, but received '.$statusCode);
        }
    }

    /**
     * @Then The results should include a customer with ID :arg1
     */
    public function theResultsShouldIncludeACustomerWithId($arg1)
    {
        $customers = json_decode($this->response->getContent());
        foreach ($customers as $customer) {
            if ($customer->id === $arg1) {
                return true;
            }
        }

        throw new Exception('Expected to find customer with an ID of '.$arg1.', but didnt.');
    }
}
