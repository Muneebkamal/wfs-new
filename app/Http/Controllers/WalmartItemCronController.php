<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\WalmartItem;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\LineItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class WalmartItemCronController extends Controller
{
    private $clientId;
    private $clientSecret;

    public function __construct()
    {
        $this->clientId = '8369470f-234b-4489-ae51-5abe1dd9d6d9';
        $this->clientSecret = 'AOJCwTpaaGkBuQ_rwWzeb319PlnfDRySgYgPzPZHEeJ7wcYpvemFBo4EUnQuuDsIbbazoag7iW781-1Y0FVgi2k';
    }
    public function getWalmartToken() {
        $clientId = $this->clientId;
        $clientSecret = $this->clientSecret;
        $url = "https://marketplace.walmartapis.com/v3/token";
        $auth = base64_encode("$clientId:$clientSecret");

        // CORRELATION ID (must be non-empty)
        $correlationId = uniqid('walmart_', true); // e.g., walmart_643123abc123.123456

        // Set headers
        $headers = [
            "Authorization: Basic $auth",
            "Content-Type: application/x-www-form-urlencoded",
            "Accept: application/json",
            "WM_QOS.CORRELATION_ID: {$correlationId}",
            "WM_SVC.NAME: Walmart Marketplace"
        ];

        // Set POST body
        $postData = http_build_query([
            'grant_type' => 'client_credentials'
        ]);

        // Curl setup
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        curl_close($ch);
        $json = json_decode($response, true);

        if (isset($json['access_token'])) {
            return $json['access_token'];
        } else {
            print_r($json); // to debug further
            return null;
        }
    }
    public function fetchWalmartItems()
    {

        
        $token = $this->getWalmartToken();
        if (!$token) {
            return response()->json(['error' => 'Failed to get Walmart token'], 401);
        }
        $this->updateItemImages($token);
    }
    //get walmart items 
    public function getItems($accessToken)
    {
        $token = $accessToken;
        $nextCursor = '*'; // Initial cursor
        $hasMorePages = true;

        while ($hasMorePages) {
            // Generate unique correlation ID
            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

            // API URL with pagination
            $url = 'https://marketplace.walmartapis.com/v3/items?nextCursor=' . urlencode($nextCursor) . '&limit=50';

            // cURL setup
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $token,
                    'Accept: application/json',
                    'WM_SEC.ACCESS_TOKEN: ' . $token,
                    'WM_QOS.CORRELATION_ID: ' . $uuid,
                    'WM_SVC.NAME: Walmart Marketplace'
                ]
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
            $curlError = curl_error($ch);
            curl_close($ch);

            // Handle cURL error
            if ($curlError) {
                echo "❌ cURL Error: $curlError<br>";
                break;
            }

            // Handle API failure
            if ($httpCode !== 200 || !$response) {
                echo "❌ HTTP Error: $httpCode<br>";
                echo "<pre>" . htmlspecialchars($response) . "</pre>";
                break;
            }

            // Parse JSON
            if (stripos($contentType, 'application/json') !== false) {
                $data = json_decode($response, true);

                // Print product names
                if (!empty($data['ItemResponse'])) {
                    foreach ($data['ItemResponse'] as $item) {
                        // Check if SKU exists
                        $existingItem = WalmartItem::where('sku', $item['sku'])->first();
                        if (!$existingItem) {
                            // Create new item
                            WalmartItem::create([
                                'mart' => $item['mart'] ?? null,
                                'sku' => $item['sku'] ?? null,
                                'availability' => $item['availability'] ?? null,
                                'wpid' => $item['wpid'] ?? null,
                                'upc' => $item['upc'] ?? null,
                                'gtin' => $item['gtin'] ?? null,
                                'product_name' => $item['productName'] ?? null,
                                'shelf' => isset($item['shelf']) ? json_encode($item['shelf']) : null,
                                'product_type' => $item['productType'] ?? null,
                                'currency' => $item['price']['currency'] ?? null,
                                'price' => $item['price']['amount'] ?? null,
                                'published_status' => $item['publishedStatus'] ?? null,
                                'lifecycle_status' => $item['lifecycleStatus'] ?? null,
                                'is_duplicate' => $item['isDuplicate'] ?? false,
                                'variant_group_id' => $item['variantGroupId'] ?? null,
                                'variant_group_info' => isset($item['variantGroupInfo']) ? json_encode($item['variantGroupInfo']) : null,

                            ]);

                            echo "✅ Inserted SKU: {$item['sku']}<br>";
                        } else {
                            echo "⚠️ SKU Already Exists: {$item['sku']}<br>";
                        }
                    }
                }

                // Check for next page
                if (!empty($data['nextCursor'])) {
                    $nextCursor = $data['nextCursor'];
                } else {
                    $hasMorePages = false;
                }
            } else {
                echo "❌ Unexpected content type: $contentType<br>";
                break;
            }
        }
    }
    //get orders from walmart
    /**
     * Fetch all Walmart orders using the provided access token.
     *
     * @param string $accessToken
     * @return array
     */
    public function getAllWalmartOrders($accessToken)
    {
        $baseUrl = 'https://marketplace.walmartapis.com/v3/orders';
        $limit = 100;
        $cursor = null;
        $allOrders = [];

        // Optional: fetch last 90 days of orders
        $createdStartDate = urlencode(now()->subDays(90)->toIso8601String());

        do {
            $url = $baseUrl . '?limit=' . $limit .
                '&productInfo=false' .
                '&replacementInfo=false' .
                '&createdStartDate=' . $createdStartDate;

            if ($cursor) {
                $url .= '&nextCursor=' . urlencode($cursor);
            }

            // Generate a unique correlation ID
            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $accessToken,
                    'Accept: application/json',
                    'WM_SEC.ACCESS_TOKEN: ' . $accessToken,
                    'WM_QOS.CORRELATION_ID: ' . $uuid,
                    'WM_SVC.NAME: Walmart Marketplace',
                ],
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError || $httpCode !== 200) {
                echo "❌ Error: " . ($curlError ?: "HTTP $httpCode");
                break;
            }

            $data = json_decode($response, true);

            if (!empty($data['list']['elements']['order'])) {
                $allOrders = array_merge($allOrders, $data['list']['elements']['order']);
            }

            // Log meta data for debugging
            if (isset($data['list']['meta'])) {
                Log::info('Walmart Orders Meta', $data['list']['meta']);
            }

            // Update cursor
            $cursor = $data['list']['meta']['nextCursor'] ?? null;

        } while ($cursor);

        return $allOrders;
    }
    public function syncWalmartOrders($accessToken)
    {
        $baseUrl = 'https://marketplace.walmartapis.com/v3/orders';
        $limit = 100;
        $cursor = null;
        $seenCursors = [];

        // 90 days back
        $createdStartDate = now()->subDays(180)->toIso8601String();

        do {
            $url = $baseUrl . '?limit=' . $limit .
                '&productInfo=false' .
                '&replacementInfo=false' .
                '&shipNodeType=WFSFulfilled' .
                '&createdStartDate=' . urlencode($createdStartDate);

            if ($cursor) {
                $url .= '&nextCursor=' . $cursor; // ⚠️ DO NOT urlencode
            }

            $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $accessToken,
                    'Accept: application/json',
                    'WM_SEC.ACCESS_TOKEN: ' . $accessToken,
                    'WM_QOS.CORRELATION_ID: ' . $uuid,
                    'WM_SVC.NAME: Walmart Marketplace',
                ],
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError || $httpCode !== 200) {
                Log::error("Walmart API Error: " . ($curlError ?: "HTTP $httpCode"));
                break;
            }

            $data = json_decode($response, true);

            $orders = $data['list']['elements']['order'] ?? [];
            $nextCursor = $data['list']['meta']['nextCursor'] ?? null;

            Log::info("Fetched " . count($orders) . " orders. Next Cursor: " . ($nextCursor ?: 'null'));

            foreach ($orders as $order) {
                $this->saveWalmartOrderAndLines($order);
                // Your logic to save order here
                // Log::info("Processing order: " . $order['purchaseOrderId']);
            }

            // Prevent infinite loop
            if (!$nextCursor || in_array($nextCursor, $seenCursors)) {
                Log::info("No new nextCursor or already seen. Ending sync.");
                break;
            }

            $seenCursors[] = $nextCursor;
            $cursor = $nextCursor;

        } while ($cursor);
    }








    public function saveWalmartOrderAndLines($orderData)
    {

        DB::beginTransaction();
        try {
            // Convert milliseconds to proper timestamp
            $orderDate = Carbon::createFromTimestampMs($orderData['orderDate']);
            $order = Order::updateOrCreate(
                ['purchase_order_id' => $orderData['purchaseOrderId']],
                [
                    'customer_order_id'       => $orderData['customerOrderId'] ?? null,
                    'customer_email_id'       => $orderData['customerEmailId'] ?? null,
                    'order_date'              => $orderDate,
                    'phone'                   => $orderData['shippingInfo']['phone'] ?? null,
                    'delivery_method_code'    => $orderData['shippingInfo']['methodCode'] ?? null,
                    'delivery_name'           => $orderData['shippingInfo']['postalAddress']['name'] ?? null,
                    'delivery_address1'       => $orderData['shippingInfo']['postalAddress']['address1'] ?? null,
                    'delivery_address2'       => $orderData['shippingInfo']['postalAddress']['address2'] ?? null,
                    'delivery_city'           => $orderData['shippingInfo']['postalAddress']['city'] ?? null,
                    'delivery_state'          => $orderData['shippingInfo']['postalAddress']['state'] ?? null,
                    'delivery_postal_code'    => $orderData['shippingInfo']['postalAddress']['postalCode'] ?? null,
                    'delivery_country'        => $orderData['shippingInfo']['postalAddress']['country'] ?? null,
                    'address_type'            => $orderData['shippingInfo']['postalAddress']['addressType'] ?? null,
                    'ship_node_type'          => $orderData['shipNode']['type'] ?? null,
                    'ship_node_name'          => $orderData['shipNode']['name'] ?? null,
                    'ship_node_id'            => $orderData['shipNode']['id'] ?? null,
                    'estimated_ship_date'     => isset($orderData['shippingInfo']['estimatedShipDate']) ? Carbon::createFromTimestampMs($orderData['shippingInfo']['estimatedShipDate']) : null,
                    'estimated_delivery_date' => isset($orderData['shippingInfo']['estimatedDeliveryDate']) ? Carbon::createFromTimestampMs($orderData['shippingInfo']['estimatedDeliveryDate']) : null,
                ]
            );

            // Save line items
            $lineItems = $orderData['orderLines']['orderLine'] ?? [];

            foreach ($lineItems as $line) {
                $charge = $line['charges']['charge'][0] ?? [];

                LineItem::create([
                    'order_id'              => $order->id,
                    'line_number'           => $line['lineNumber'],
                    'product_name'          => $line['item']['productName'] ?? null,
                    'sku'                   => $line['item']['sku'] ?? null,
                    'condition'             => $line['item']['condition'] ?? null,
                    'unit_of_measurement'   => $line['orderLineQuantity']['unitOfMeasurement'] ?? null,
                    'quantity'              => $line['orderLineQuantity']['amount'] ?? 1,
                    'charge_type'           => $charge['chargeType'] ?? null,
                    'charge_name'           => $charge['chargeName'] ?? null,
                    'charge_amount'         => $charge['chargeAmount']['amount'] ?? null,
                    'charge_currency'       => $charge['chargeAmount']['currency'] ?? null,
                    'tax_amount'            => $charge['tax']['amount'] ?? null,
                    'fulfillment_option'    => $line['fulfillment']['fulfillmentOption'] ?? null,
                    'ship_method'           => $line['fulfillment']['shipMethod'] ?? null,
                    'store_id'              => $line['fulfillment']['storeId'] ?? null,
                    'pickup_datetime'       => isset($line['fulfillment']['pickUpDateTime']) ? Carbon::createFromTimestampMs($line['fulfillment']['pickUpDateTime']) : null,
                    'shipping_program_type' => $line['fulfillment']['shippingProgramType'] ?? null,
                    'status_date'           => isset($line['statusDate']) ? Carbon::createFromTimestampMs($line['statusDate']) : null,
                    'order_line_statuses'   => isset($line['orderLineStatuses']) ? json_encode($line['orderLineStatuses']) : null,
                    'refund'                => isset($line['refund']) ? json_encode($line['refund']) : null,
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Failed to save Walmart order: " . $e->getMessage(), [
                'order' => $orderData,
            ]);
        }

    }
    public function searchWalmartProductByUPC($accessToken, $upc)
    {
        $url = 'https://marketplace.walmartapis.com/v3/items/walmart/search?upc=' . urlencode($upc);

        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex(random_bytes(16)), 4));

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $accessToken,
                'Accept: application/json',
                'WM_SEC.ACCESS_TOKEN: ' . $accessToken,
                'WM_QOS.CORRELATION_ID: ' . $uuid,
                'WM_SVC.NAME: Walmart Marketplace',
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError || $httpCode !== 200) {
            Log::error("Walmart UPC Search Error: " . ($curlError ?: "HTTP $httpCode"));
            return null;
        }

        $data = json_decode($response, true);

        // Handle results
        if (!empty($data['items'])) {
            return $data;
        } else {
            Log::info("No product found for UPC: " . $upc);
        }

        return $data;
    }
    public function updateItemImages($token){
        $items = WalmartItem::whereNull('image')->get();
        foreach ($items as $itemDb) {
            $upc = $itemDb->upc;
            if ($upc) {
                $response = $this->searchWalmartProductByUPC($token, $upc);
                if ($response && isset($response['items']) && count($response['items']) > 0) {
                    $itemData = $response['items'][0];
                    if (isset($itemData['images']) && count($itemData['images']) > 0) {
                        $imageUrl = $itemData['images'][0]['url'] ?? null;
                        $itemDb->images = json_encode($itemData['images']);
                        $itemDb->image = $imageUrl;
                        $itemDb->save();
                    } else {
                    }
                } else {
                    Log::info("No item found for UPC: {$upc}");
                }
            } else {
            }
        }
    }
}
