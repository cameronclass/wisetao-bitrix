<?php

/**
 * PHP version 5.3
 *
 * API client class
 *
 * @category RetailCrm
 * @package  RetailCrm
 * @author   RetailCrm <integration@retailcrm.ru>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.retailcrm.ru/docs/Developers/ApiVersion5
 */

namespace RetailCrm;

use RetailCrm\Http\Client;
use RetailCrm\Response\ApiResponse;

/**
 * PHP version 5.3
 *
 * API client class
 *
 * @category RetailCrm
 * @package  RetailCrm
 * @author   RetailCrm <integration@retailcrm.ru>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     http://www.retailcrm.ru/docs/Developers/ApiVersion5
 */
class ApiClient
{

    const VERSION = 'v5';

    protected $client;

    /**
     * Site code
     */
    protected $siteCode;

    /**
     * Client creating
     *
     * @param string $url    api url
     * @param string $apiKey api key
     * @param string $site   site code
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($url, $apiKey, $site = null)
    {
        if ('/' !== $url[strlen($url) - 1]) {
            $url .= '/';
        }

        $url = $url . 'api/' . self::VERSION;

        $this->client = new Client($url, array('apiKey' => $apiKey));
        $this->siteCode = $site;
    }

    /**
     * Returns users list
     *
     * @param array $filter
     * @param null  $page
     * @param null  $limit
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \InvalidArgumentException
     *
     * @return ApiResponse
     */
    public function usersList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/users',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Get user groups
     *
     * @param null $page
     * @param null $limit
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     *
     * @return ApiResponse
     */
    public function usersGroups($page = null, $limit = null)
    {
        $parameters = array();

        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/user-groups',
            Client::METHOD_GET,
            $parameters
        );
    }
    
    /**
     * Change user status
     *
     * @param integer $id     user ID
     * @param string  $status user status
     *
     * @return ApiResponse
     */
    public function usersStatus($id, $status)
    {
        $statuses = array("free", "busy", "dinner", "break");

        if (empty($status) || !in_array($status, $statuses)) {
            throw new \InvalidArgumentException(
                'Parameter `status` must be not empty & must be equal one of these values: free|busy|dinner|break'
            );
        }

        /** @noinspection PhpUndefinedMethodInspection */
        return $this->client->makeRequest(
            "/users/$id/status",
            Client::METHOD_POST,
            array('status' => $status)
        );
    }

    /**
     * Returns user data
     *
     * @param integer $id user ID
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \InvalidArgumentException
     *
     * @return ApiResponse
     */
    public function usersGet($id)
    {
        return $this->client->makeRequest("/users/$id", Client::METHOD_GET);
    }

    /**
     * Returns filtered orders list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/orders',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create a order
     *
     * @param array  $order order data
     * @param string $site  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersCreate(array $order, $site = null)
    {
        if (!count($order)) {
            throw new \InvalidArgumentException(
                'Parameter `order` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/orders/create',
            Client::METHOD_POST,
            $this->fillSite($site, array('order' => json_encode($order)))
        );
    }

    /**
     * Save order IDs' (id and externalId) association in the CRM
     *
     * @param array $ids order identificators
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersFixExternalIds(array $ids)
    {
        if (! count($ids)) {
            throw new \InvalidArgumentException(
                'Method parameter must contains at least one IDs pair'
            );
        }

        return $this->client->makeRequest(
            '/orders/fix-external-ids',
            Client::METHOD_POST,
            array('orders' => json_encode($ids)
            )
        );
    }

    /**
     * Returns statuses of the orders
     *
     * @param array $ids         (default: array())
     * @param array $externalIds (default: array())
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersStatuses(array $ids = array(), array $externalIds = array())
    {
        $parameters = array();

        if (count($ids)) {
            $parameters['ids'] = $ids;
        }
        if (count($externalIds)) {
            $parameters['externalIds'] = $externalIds;
        }

        return $this->client->makeRequest(
            '/orders/statuses',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Upload array of the orders
     *
     * @param array  $orders array of orders
     * @param string $site   (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersUpload(array $orders, $site = null)
    {
        if (!count($orders)) {
            throw new \InvalidArgumentException(
                'Parameter `orders` must contains array of the orders'
            );
        }

        return $this->client->makeRequest(
            '/orders/upload',
            Client::METHOD_POST,
            $this->fillSite($site, array('orders' => json_encode($orders)))
        );
    }

    /**
     * Get order by id or externalId
     *
     * @param string $id   order identificator
     * @param string $by   (default: 'externalId')
     * @param string $site (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersGet($id, $by = 'externalId', $site = null)
    {
        $this->checkIdParameter($by);

        return $this->client->makeRequest(
            "/orders/$id",
            Client::METHOD_GET,
            $this->fillSite($site, array('by' => $by))
        );
    }

    /**
     * Edit a order
     *
     * @param array  $order order data
     * @param string $by    (default: 'externalId')
     * @param string $site  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersEdit(array $order, $by = 'externalId', $site = null)
    {
        if (!count($order)) {
            throw new \InvalidArgumentException(
                'Parameter `order` must contains a data'
            );
        }

        $this->checkIdParameter($by);

        if (!array_key_exists($by, $order)) {
            throw new \InvalidArgumentException(
                sprintf('Order array must contain the "%s" parameter.', $by)
            );
        }

        return $this->client->makeRequest(
            sprintf('/orders/%s/edit', $order[$by]),
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('order' => json_encode($order), 'by' => $by)
            )
        );
    }

    /**
     * Get orders history
     * @param array $filter
     * @param null $page
     * @param null $limit
     *
     * @return ApiResponse
     */
    public function ordersHistory(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/orders/history',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Returns filtered customers list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/customers',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create a customer
     *
     * @param array  $customer customer data
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersCreate(array $customer, $site = null)
    {
        if (! count($customer)) {
            throw new \InvalidArgumentException(
                'Parameter `customer` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/customers/create',
            Client::METHOD_POST,
            $this->fillSite($site, array('customer' => json_encode($customer)))
        );
    }

    /**
     * Save customer IDs' (id and externalId) association in the CRM
     *
     * @param array $ids ids mapping
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersFixExternalIds(array $ids)
    {
        if (! count($ids)) {
            throw new \InvalidArgumentException(
                'Method parameter must contains at least one IDs pair'
            );
        }

        return $this->client->makeRequest(
            '/customers/fix-external-ids',
            Client::METHOD_POST,
            array('customers' => json_encode($ids))
        );
    }

    /**
     * Upload array of the customers
     *
     * @param array  $customers array of customers
     * @param string $site      (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersUpload(array $customers, $site = null)
    {
        if (! count($customers)) {
            throw new \InvalidArgumentException(
                'Parameter `customers` must contains array of the customers'
            );
        }

        return $this->client->makeRequest(
            '/customers/upload',
            Client::METHOD_POST,
            $this->fillSite($site, array('customers' => json_encode($customers)))
        );
    }

    /**
     * Get customer by id or externalId
     *
     * @param string $id   customer identificator
     * @param string $by   (default: 'externalId')
     * @param string $site (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersGet($id, $by = 'externalId', $site = null)
    {
        $this->checkIdParameter($by);

        return $this->client->makeRequest(
            "/customers/$id",
            Client::METHOD_GET,
            $this->fillSite($site, array('by' => $by))
        );
    }

    /**
     * Edit a customer
     *
     * @param array  $customer customer data
     * @param string $by       (default: 'externalId')
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersEdit(array $customer, $by = 'externalId', $site = null)
    {
        if (!count($customer)) {
            throw new \InvalidArgumentException(
                'Parameter `customer` must contains a data'
            );
        }

        $this->checkIdParameter($by);

        if (!array_key_exists($by, $customer)) {
            throw new \InvalidArgumentException(
                sprintf('Customer array must contain the "%s" parameter.', $by)
            );
        }

        return $this->client->makeRequest(
            sprintf('/customers/%s/edit', $customer[$by]),
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('customer' => json_encode($customer), 'by' => $by)
            )
        );
    }

    /**
     * Get customers history
     * @param array $filter
     * @param null $page
     * @param null $limit
     *
     * @return ApiResponse
     */
    public function customersHistory(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/customers/history',
            Client::METHOD_GET,
            $parameters
        );
    }
    
    /**
     * Combine orders
     *
     * @param array  $order
     * @param array  $resultOrder
     * @param string $technique
     *
     * @return ApiResponse
     */
    public function ordersCombine($order, $resultOrder, $technique = 'ours')
    {
        $techniques = array('ours', 'summ', 'theirs');

        if (!count($order) || !count($resultOrder)) {
            throw new \InvalidArgumentException(
                'Parameters `order` & `resultOrder` must contains a data'
            );
        }

        if (!in_array($technique, $techniques)) {
            throw new \InvalidArgumentException(
                'Parameter `technique` must be on of ours|summ|theirs'
            );
        }

        return $this->client->makeRequest(
            '/orders/combine',
            Client::METHOD_POST,
            array(
                'technique' => $technique,
                'order' => json_encode($order),
                'resultOrder' => json_encode($resultOrder)
            )
        );
    }

    /**
     * Create an order payment
     *
     * @param array $payment order data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPaymentCreate(array $payment, $site = null)
    {
        if (!count($payment)) {
            throw new \InvalidArgumentException(
                'Parameter `payment` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/orders/payments/create',
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('payment' => json_encode($payment))
            )
        );
    }

    /**
     * Edit an order payment
     *
     * @param array  $payment order data
     * @param string $by      by key
     * @param null   $site    site code
     *
     * @return ApiResponse
     */
    public function ordersPaymentEdit(array $payment, $by = 'id', $site = null)
    {
        if (!count($payment)) {
            throw new \InvalidArgumentException(
                'Parameter `payment` must contains a data'
            );
        }

        $this->checkIdParameter($by);

        if (!array_key_exists($by, $payment)) {
            throw new \InvalidArgumentException(
                sprintf('Order array must contain the "%s" parameter.', $by)
            );
        }

        return $this->client->makeRequest(
            sprintf('/orders/payments/%s/edit', $payment[$by]),
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('payment' => json_encode($payment), 'by' => $by)
            )
        );
    }

    /**
     * Delete an order payment
     *
     * @param integer  $id id order payment
     *
     * @return ApiResponse
     */
    public function ordersPaymentDelete($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'Note id must be set'
            );
        }
        
        return $this->client->makeRequest(
            "/orders/payments/$id/delete",
            Client::METHOD_POST
        );
    }
    
    /**
     * Combine customers
     *
     * @param array $customers
     * @param array $resultCustomer
     *
     * @return ApiResponse
     */
    public function customersCombine(array $customers, $resultCustomer)
    {

        if (!count($customers) || !count($resultCustomer)) {
            throw new \InvalidArgumentException(
                'Parameters `customers` & `resultCustomer` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/customers/combine',
            Client::METHOD_POST,
            array(
                'customers' => json_encode($customers),
                'resultCustomer' => json_encode($resultCustomer)
            )
        );
    }

    /**
     * Returns filtered customers notes list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersNotesList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/customers/notes',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create customer note
     *
     * @param array $note (default: array())
     * @param string $site     (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersNotesCreate($note, $site = null)
    {
        if (empty($note['customer']['id']) && empty($note['customer']['externalId'])) {
            throw new \InvalidArgumentException(
                'Customer identifier must be set'
            );
        }

        return $this->client->makeRequest(
            '/customers/notes/create',
            Client::METHOD_POST,
            $this->fillSite($site, array('note' => json_encode($note)))
        );
    }

    /**
     * Delete customer note
     *
     * @param integer $id
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function customersNotesDelete($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'Note id must be set'
            );
        }

        return $this->client->makeRequest(
            "/customers/notes/$id/delete",
            Client::METHOD_POST
        );
    }

    /**
     * Get custom fields list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return ApiResponse
     */
    public function customFieldsList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/custom-fields',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create custom field
     *
     * @param $entity
     * @param $customField
     *
     * @return ApiResponse
     */
    public function customFieldsCreate($entity, $customField)
    {
        if (!count($customField) ||
            empty($customField['code']) ||
            empty($customField['name']) ||
            empty($customField['type'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `customField` must contain a data & fields `code`, `name` & `type` must be set'
            );
        }

        if (empty($entity) || !in_array($entity, array('customer', 'order'))) {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/create",
            Client::METHOD_POST,
            array('customField' => json_encode($customField))
        );
    }

    /**
     * Edit custom field
     *
     * @param $entity
     * @param $customField
     *
     * @return ApiResponse
     */
    public function customFieldsEdit($entity, $customField)
    {
        if (!count($customField) || empty($customField['code'])) {
            throw new \InvalidArgumentException(
                'Parameter `customField` must contain a data & fields `code` must be set'
            );
        }

        if (empty($entity) || !in_array($entity, array('customer', 'order'))) {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/edit/{$customField['code']}",
            Client::METHOD_POST,
            array('customField' => json_encode($customField))
        );
    }

    /**
     * Get custom field
     *
     * @param $entity
     * @param $code
     *
     * @return ApiResponse
     */
    public function customFieldsGet($entity, $code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException(
                'Parameter `code` must be not empty'
            );
        }

        if (empty($entity) || !in_array($entity, array('customer', 'order'))) {
            throw new \InvalidArgumentException(
                'Parameter `entity` must contain a data & value must be `order` or `customer`'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/$entity/$code",
            Client::METHOD_GET
        );
    }

    /**
     * Get custom dictionaries list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return ApiResponse
     */
    public function customDictionariesList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/custom-fields/dictionaries',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create custom dictionary
     *
     * @param $customDictionary
     *
     * @return ApiResponse
     */
    public function customDictionariesCreate($customDictionary)
    {
        if (!count($customDictionary) ||
            empty($customDictionary['code']) ||
            empty($customDictionary['elements'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `dictionary` must contain a data & fields `code` & `elemets` must be set'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/{$customDictionary['code']}/create",
            Client::METHOD_POST,
            array('customDictionary' => json_encode($customDictionary))
        );
    }

    /**
     * Edit custom dictionary
     *
     * @param $customDictionary
     *
     * @return ApiResponse
     */
    public function customDictionariesEdit($customDictionary)
    {
        if (!count($customDictionary) ||
            empty($customDictionary['code']) ||
            empty($customDictionary['elements'])
        ) {
            throw new \InvalidArgumentException(
                'Parameter `dictionary` must contain a data & fields `code` & `elemets` must be set'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/{$customDictionary['code']}/edit",
            Client::METHOD_POST,
            array('customDictionary' => json_encode($customDictionary))
        );
    }

    /**
     * Get custom dictionary
     *
     * @param $code
     *
     * @return ApiResponse
     */
    public function customDictionariesGet($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException(
                'Parameter `code` must be not empty'
            );
        }

        return $this->client->makeRequest(
            "/custom-fields/dictionaries/$code",
            Client::METHOD_GET
        );
    }
    
    /**
     * Get tasks list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return ApiResponse
     */
    public function tasksList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/tasks',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create task
     *
     * @param array $task
     * @param null  $site
     *
     * @return ApiResponse
     *
     */
    public function tasksCreate($task, $site = null)
    {
        if (!count($task)) {
            throw new \InvalidArgumentException(
                'Parameter `task` must contain a data'
            );
        }

        return $this->client->makeRequest(
            "/tasks/create",
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('task' => json_encode($task))
            )
        );
    }

    /**
     * Edit task
     *
     * @param array $task
     * @param null  $site
     *
     * @return ApiResponse
     *
     */
    public function tasksEdit($task, $site = null)
    {
        if (!count($task)) {
            throw new \InvalidArgumentException(
                'Parameter `task` must contain a data'
            );
        }

        return $this->client->makeRequest(
            "/tasks/{$task['id']}/edit",
            Client::METHOD_POST,
            $this->fillSite(
                $site,
                array('task' => json_encode($task))
            )
        );
    }

    /**
     * Get custom dictionary
     *
     * @param $id
     *
     * @return ApiResponse
     */
    public function tasksGet($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'Parameter `id` must be not empty'
            );
        }

        return $this->client->makeRequest(
            "/tasks/$id",
            Client::METHOD_GET
        );
    }
    
    /**
     * Get orders assembly list
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksList(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/orders/packs',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Create orders assembly
     *
     * @param array  $pack pack data
     * @param string $site (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksCreate(array $pack, $site = null)
    {
        if (!count($pack)) {
            throw new \InvalidArgumentException(
                'Parameter `pack` must contains a data'
            );
        }

        return $this->client->makeRequest(
            '/orders/packs/create',
            Client::METHOD_POST,
            $this->fillSite($site, array('pack' => json_encode($pack)))
        );
    }

    /**
     * Get orders assembly history
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksHistory(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/orders/packs/history',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Get orders assembly by id
     *
     * @param string $id pack identificator
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksGet($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Parameter `id` must be set');
        }

        return $this->client->makeRequest(
            "/orders/packs/$id",
            Client::METHOD_GET
        );
    }

    /**
     * Delete orders assembly by id
     *
     * @param string $id pack identificator
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksDelete($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Parameter `id` must be set');
        }

        return $this->client->makeRequest(
            sprintf('/orders/packs/%s/delete', $id),
            Client::METHOD_POST
        );
    }

    /**
     * Edit orders assembly
     *
     * @param array  $pack pack data
     * @param string $site (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function ordersPacksEdit(array $pack, $site = null)
    {
        if (!count($pack) || empty($pack['id'])) {
            throw new \InvalidArgumentException(
                'Parameter `pack` must contains a data & pack `id` must be set'
            );
        }

        return $this->client->makeRequest(
            sprintf('/orders/packs/%s/edit', $pack['id']),
            Client::METHOD_POST,
            $this->fillSite($site, array('pack' => json_encode($pack)))
        );
    }

    /**
     * Get purchace prices & stock balance
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storeInventories(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/store/inventories',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Upload store inventories
     *
     * @param array  $offers offers data
     * @param string $site   (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storeInventoriesUpload(array $offers, $site = null)
    {
        if (!count($offers)) {
            throw new \InvalidArgumentException(
                'Parameter `offers` must contains array of the offers'
            );
        }

        return $this->client->makeRequest(
            '/store/inventories/upload',
            Client::METHOD_POST,
            $this->fillSite($site, array('offers' => json_encode($offers)))
        );
    }
    
    /**
     * Upload store prices
     *
     * @param array  $prices prices data
     * @param string $site   default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storePricesUpload(array $prices, $site = null)
    {
        if (!count($prices)) {
            throw new \InvalidArgumentException(
                'Parameter `prices` must contains array of the prices'
            );
        }

        return $this->client->makeRequest(
            '/store/prices/upload',
            Client::METHOD_POST,
            $this->fillSite($site, array('prices' => json_encode($prices)))
        );
    }

    /**
     * Get products
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storeProducts(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/store/products',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Get module configuration
     *
     * @param string $code
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \InvalidArgumentException
     *
     * @return ApiResponse
     */
    public function integrationModulesGet($code)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException(
                'Parameter `code` must be set'
            );
        }

        return $this->client->makeRequest(
            sprintf('/integration-modules/%s', $code),
            Client::METHOD_GET
        );
    }
    /**
     * Edit module configuration
     *
     * @param array $configuration
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \InvalidArgumentException
     *
     * @return ApiResponse
     */
    public function integrationModulesEdit(array $configuration)
    {
        if (!count($configuration) || empty($configuration['code'])) {
            throw new \InvalidArgumentException(
                'Parameter `configuration` must contains a data & configuration `code` must be set'
            );
        }

        return $this->client->makeRequest(
            sprintf('/integration-modules/%s/edit', $configuration['code']),
            Client::METHOD_POST,
            array('integrationModule' => json_encode($configuration))
        );
    }

    /**
     * Delivery tracking update
     *
     * @param string $code
     * @param array  $statusUpdate
     *
     * @throws \RetailCrm\Exception\InvalidJsonException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \InvalidArgumentException
     *
     * @return ApiResponse
     */
    public function deliveryTracking($code, array $statusUpdate)
    {
        if (empty($code)) {
            throw new \InvalidArgumentException('Parameter `code` must be set');
        }

        if (!count($statusUpdate)) {
            throw new \InvalidArgumentException(
                'Parameter `statusUpdate` must contains a data'
            );
        }

        return $this->client->makeRequest(
            sprintf('/delivery/generic/%s/tracking', $code),
            Client::METHOD_POST,
            array('statusUpdate' => json_encode($statusUpdate))
        );
    }

    /**
     * Returns available county list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function countriesList()
    {
        return $this->client->makeRequest(
            '/reference/countries',
            Client::METHOD_GET
        );
    }

    /**
     * Returns deliveryServices list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function deliveryServicesList()
    {
        return $this->client->makeRequest(
            '/reference/delivery-services',
            Client::METHOD_GET
        );
    }

    /**
     * Edit deliveryService
     *
     * @param array $data delivery service data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function deliveryServicesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/delivery-services/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('deliveryService' => json_encode($data))
        );
    }

    /**
     * Returns deliveryTypes list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function deliveryTypesList()
    {
        return $this->client->makeRequest(
            '/reference/delivery-types',
            Client::METHOD_GET
        );
    }

    /**
     * Edit deliveryType
     *
     * @param array $data delivery type data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function deliveryTypesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/delivery-types/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('deliveryType' => json_encode($data))
        );
    }

    /**
     * Returns orderMethods list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function orderMethodsList()
    {
        return $this->client->makeRequest(
            '/reference/order-methods',
            Client::METHOD_GET
        );
    }

    /**
     * Edit orderMethod
     *
     * @param array $data order method data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function orderMethodsEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/order-methods/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('orderMethod' => json_encode($data))
        );
    }

    /**
     * Returns orderTypes list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function orderTypesList()
    {
        return $this->client->makeRequest(
            '/reference/order-types',
            Client::METHOD_GET
        );
    }

    /**
     * Edit orderType
     *
     * @param array $data order type data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function orderTypesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/order-types/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('orderType' => json_encode($data))
        );
    }

    /**
     * Returns paymentStatuses list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function paymentStatusesList()
    {
        return $this->client->makeRequest(
            '/reference/payment-statuses',
            Client::METHOD_GET
        );
    }

    /**
     * Edit paymentStatus
     *
     * @param array $data payment status data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function paymentStatusesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/payment-statuses/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('paymentStatus' => json_encode($data))
        );
    }

    /**
     * Returns paymentTypes list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function paymentTypesList()
    {
        return $this->client->makeRequest(
            '/reference/payment-types',
            Client::METHOD_GET
        );
    }

    /**
     * Edit paymentType
     *
     * @param array $data payment type data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function paymentTypesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/payment-types/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('paymentType' => json_encode($data))
        );
    }

    /**
     * Returns productStatuses list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function productStatusesList()
    {
        return $this->client->makeRequest(
            '/reference/product-statuses',
            Client::METHOD_GET
        );
    }

    /**
     * Edit productStatus
     *
     * @param array $data product status data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function productStatusesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/product-statuses/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('productStatus' => json_encode($data))
        );
    }
    
    /**
     * Get products groups
     *
     * @param array $filter (default: array())
     * @param int   $page   (default: null)
     * @param int   $limit  (default: null)
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storeProductsGroups(array $filter = array(), $page = null, $limit = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/store/product-groups',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Returns sites list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function sitesList()
    {
        return $this->client->makeRequest(
            '/reference/sites',
            Client::METHOD_GET
        );
    }

    /**
     * Edit site
     *
     * @param array $data site data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function sitesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/sites/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('site' => json_encode($data))
        );
    }

    /**
     * Returns statusGroups list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function statusGroupsList()
    {
        return $this->client->makeRequest(
            '/reference/status-groups',
            Client::METHOD_GET
        );
    }

    /**
     * Returns statuses list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function statusesList()
    {
        return $this->client->makeRequest(
            '/reference/statuses',
            Client::METHOD_GET
        );
    }

    /**
     * Edit order status
     *
     * @param array $data status data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function statusesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/statuses/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('status' => json_encode($data))
        );
    }

    /**
     * Returns stores list
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storesList()
    {
        return $this->client->makeRequest(
            '/reference/stores',
            Client::METHOD_GET
        );
    }

    /**
     * Edit store
     *
     * @param array $data site data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function storesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        if (!array_key_exists('name', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "name" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/stores/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('store' => json_encode($data))
        );
    }

    /**
     * Get prices types
     *
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function pricesTypes()
    {
        return $this->client->makeRequest(
            '/reference/price-types',
            Client::METHOD_GET
        );
    }

    /**
     * Edit price type
     *
     * @param array $data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function pricesEdit(array $data)
    {
        if (!array_key_exists('code', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "code" parameter.'
            );
        }

        if (!array_key_exists('name', $data)) {
            throw new \InvalidArgumentException(
                'Data must contain "name" parameter.'
            );
        }

        return $this->client->makeRequest(
            sprintf('/reference/price-types/%s/edit', $data['code']),
            Client::METHOD_POST,
            array('priceType' => json_encode($data))
        );
    }

    /**
     * Call event
     *
     * @param string $phone phone number
     * @param string $type  call type
     * @param array  $codes
     * @param string $hangupStatus
     * @param string $externalPhone
     * @param array  $webAnalyticsData
     *
     * @return ApiResponse
     * @internal param string $code additional phone code
     * @internal param string $status call status
     *
     */
    public function telephonyCallEvent(
        $phone,
        $type,
        $codes,
        $hangupStatus,
        $externalPhone = null,
        $webAnalyticsData = array()
    )
    {
        if (!isset($phone)) {
            throw new \InvalidArgumentException('Phone number must be set');
        }

        if (!isset($type)) {
            throw new \InvalidArgumentException('Type must be set (in|out|hangup)');
        }

        if (empty($codes)) {
            throw new \InvalidArgumentException('Codes array must be set');
        }

        $parameters['phone'] = $phone;
        $parameters['type'] = $type;
        $parameters['codes'] = $codes;
        $parameters['hangupStatus'] = $hangupStatus;
        $parameters['callExternalId'] = $externalPhone;
        $parameters['webAnalyticsData'] = $webAnalyticsData;


        return $this->client->makeRequest(
            '/telephony/call/event',
            Client::METHOD_POST,
            array('event' => json_encode($parameters))
        );
    }

    /**
     * Upload calls
     *
     * @param array $calls calls data
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function telephonyCallsUpload(array $calls)
    {
        if (!count($calls)) {
            throw new \InvalidArgumentException(
                'Parameter `calls` must contains array of the calls'
            );
        }

        return $this->client->makeRequest(
            '/telephony/calls/upload',
            Client::METHOD_POST,
            array('calls' => json_encode($calls))
        );
    }

    /**
     * Get call manager
     *
     * @param string $phone   phone number
     * @param bool   $details detailed information
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function telephonyCallManager($phone, $details)
    {
        if (!isset($phone)) {
            throw new \InvalidArgumentException('Phone number must be set');
        }

        $parameters['phone'] = $phone;
        $parameters['details'] = isset($details) ? $details : 0;

        return $this->client->makeRequest(
            '/telephony/manager',
            Client::METHOD_GET,
            $parameters
        );
    }
    
    /**
     * Get segments list
     *
     * @param array $filter
     * @param null  $limit
     * @param null  $page
     *
     * @return ApiResponse
     */
    public function segmentsList(array $filter = array(), $limit = null, $page = null)
    {
        $parameters = array();

        if (count($filter)) {
            $parameters['filter'] = $filter;
        }
        if (null !== $page) {
            $parameters['page'] = (int) $page;
        }
        if (null !== $limit) {
            $parameters['limit'] = (int) $limit;
        }

        return $this->client->makeRequest(
            '/segments',
            Client::METHOD_GET,
            $parameters
        );
    }

    /**
     * Update CRM basic statistic
     *
     * @throws \InvalidArgumentException
     * @throws \RetailCrm\Exception\CurlException
     * @throws \RetailCrm\Exception\InvalidJsonException
     *
     * @return ApiResponse
     */
    public function statisticUpdate()
    {
        return $this->client->makeRequest(
            '/statistic/update',
            Client::METHOD_GET
        );
    }

    /**
     * Return current site
     *
     * @return string
     */
    public function getSite()
    {
        return $this->siteCode;
    }

    /**
     * Set site
     *
     * @param string $site site code
     *
     * @return void
     */
    public function setSite($site)
    {
        $this->siteCode = $site;
    }

    /**
     * Check ID parameter
     *
     * @param string $by identify by
     *
     * @throws \InvalidArgumentException
     *
     * @return bool
     */
    protected function checkIdParameter($by)
    {
        $allowedForBy = array(
            'externalId',
            'id'
        );

        if (!in_array($by, $allowedForBy, false)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Value "%s" for "by" param is not valid. Allowed values are %s.',
                    $by,
                    implode(', ', $allowedForBy)
                )
            );
        }

        return true;
    }

    /**
     * Fill params by site value
     *
     * @param string $site   site code
     * @param array  $params input parameters
     *
     * @return array
     */
    protected function fillSite($site, array $params)
    {
        if ($site) {
            $params['site'] = $site;
        } elseif ($this->siteCode) {
            $params['site'] = $this->siteCode;
        }

        return $params;
    }
}
