<?php

class ControllerExtensionModuleWuunder extends Controller
{
    private $error = array();

    public function index()
    {

        $this->load->language('module/wuunder');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('wuunder', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['staging_api'] = $this->language->get('staging_api');
        $data['live_api'] = $this->language->get('live_api');
        $data['text_staging_api'] = $this->language->get('text_staging_api');
        $data['text_live_api'] = $this->language->get('text_live_api');

        $data['text_business'] = $this->language->get('text_business');
        $data['text_email_address'] = $this->language->get('text_email_address');
        $data['text_family_name'] = $this->language->get('text_family_name');
        $data['text_given_name'] = $this->language->get('text_given_name');
        $data['text_locality'] = $this->language->get('text_locality');
        $data['text_phone_number'] = $this->language->get('text_phone_number');
        $data['text_street_name'] = $this->language->get('text_street_name');
        $data['text_house_number'] = $this->language->get('text_house_number');
        $data['text_zip_code'] = $this->language->get('text_zip_code');
        $data['text_country'] = $this->language->get('text_country');
        $data['text_advanced_section'] = $this->language->get('text_advanced_section');
        $data['text_custom_field_housenumber'] = $this->language->get('text_custom_field_housenumber');
        $data['text_base_url'] = $this->language->get('text_base_url');
        $data['text_base_admin_url'] = $this->language->get('text_base_admin_url');
        $data['text_shipping_section'] = $this->language->get('text_shipping_section');
        $data['text_shipping_dimensions'] = $this->language->get('text_shipping_dimensions');
        $data['text_shipping_weight'] = $this->language->get('text_shipping_weight');

        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/wuunder', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/wuunder', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'] . '&type=module', true);

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            $data['wuunder_api'] = $this->request->post['wuunder_api'];
            $data['staging_key'] = $this->request->post['wuunder_staging_key'];
            $data['live_key'] = $this->request->post['wuunder_live_key'];
            $data['business'] = $this->request->post['wuunder_business'];
            $data['email_address'] = $this->request->post['wuunder_email_address'];
            $data['family_name'] = $this->request->post['wuunder_family_name'];
            $data['given_name'] = $this->request->post['wuunder_given_name'];
            $data['locality'] = $this->request->post['wuunder_locality'];
            $data['phone_number'] = $this->request->post['wuunder_phone_number'];
            $data['street_name'] = $this->request->post['wuunder_street_name'];
            $data['house_number'] = $this->request->post['wuunder_house_number'];
            $data['zip_code'] = $this->request->post['wuunder_zip_code'];
            $data['country'] = $this->request->post['wuunder_country'];
            $data['custom_housenumber'] = $this->request->post['wuunder_custom_housenumber'];
            $data['base_url'] = $this->request->post['wuunder_base_url'];
            $data['base_admin_url'] = $this->request->post['wuunder_base_admin_url'];
            $data['shipping_length'] = $this->request->post['wuunder_shipping_length'];
            $data['shipping_width'] = $this->request->post['wuunder_shipping_width'];
            $data['shipping_height'] = $this->request->post['wuunder_shipping_height'];
            $data['shipping_weight'] = $this->request->post['wuunder_shipping_weight'];
        } else {
            $data['wuunder_api'] = $this->config->get('wuunder_api');
            $data['staging_key'] = $this->config->get('wuunder_staging_key');
            $data['live_key'] = $this->config->get('wuunder_live_key');
            $data['business'] = $this->config->get('wuunder_business');
            $data['email_address'] = $this->config->get('wuunder_email_address');
            $data['family_name'] = $this->config->get('wuunder_family_name');
            $data['given_name'] = $this->config->get('wuunder_given_name');
            $data['locality'] = $this->config->get('wuunder_locality');
            $data['phone_number'] = $this->config->get('wuunder_phone_number');
            $data['street_name'] = $this->config->get('wuunder_street_name');
            $data['house_number'] = $this->config->get('wuunder_house_number');
            $data['zip_code'] = $this->config->get('wuunder_zip_code');
            $data['country'] = $this->config->get('wuunder_country');
            $data['custom_housenumber'] = $this->config->get('wuunder_custom_housenumber');
            $data['base_url'] = $this->config->get('wuunder_base_url');
            $data['base_admin_url'] = $this->config->get('wuunder_base_admin_url');
            $data['shipping_length'] = $this->config->get('wuunder_shipping_length');
            $data['shipping_width'] = $this->config->get('wuunder_shipping_width');
            $data['shipping_height'] = $this->config->get('wuunder_shipping_height');
            $data['shipping_weight'] = $this->config->get('wuunder_shipping_weight');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/wuunder.tpl', $data));
    }

    public function install()
    {
        $this->load->model('extension/module/wuunder');
        $this->model_extension_module_wuunder->installTable();
    }

    public function uninstall()
    {
        $this->load->model('extension/module/wuunder');
        $this->model_extension_module_wuunder->uninstallTable();
    }

    protected function validate()
    {
        if (!$this->user->hasPermission('modify', 'extension/module/wuunder')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function getLabelInfo($order_id)
    {
        $this->load->model('extension/module/wuunder');
        return $this->model_extension_module_wuunder->getLabel($order_id);
    }

    public function getLabelCreatedMessage()
    {
        $this->load->language('extension/module/wuunder');
        return $this->language->get('label_created');
    }

    public function getCreateLabelMessage()
    {
        $this->load->language('extension/module/wuunder');
        return $this->language->get('create_label');
    }

    public function getDownloadLabelMessage()
    {
        $this->load->language('extension/module/wuunder');
        return $this->language->get('download_label');
    }

    public function getFollowShipmentMessage()
    {
        $this->load->language('extension/module/wuunder');
        return $this->language->get('follow_shipment');
    }

    public function test()
    {
        $this->load->model('sale/order');
        $orderData = $this->model_sale_order->getOrder(4);
        echo "<pre>";
        var_dump($orderData);
        echo "</pre>";
    }

    private function separateAddressLine($addressLine)
    {
        if (preg_match('/^([^\d]*[^\d\s]) *(\d.*)$/', $addressLine, $result)) {
            if (count($result) >= 2) {
                $streetName = $result[1];
                $streetNumber = $result[2];
            } else {
                return array($addressLine, "");
            }

            return array($streetName, $streetNumber);
        }
        return array($addressLine, "");
    }

    private function buildWuunderData($order_id)
    {
        $this->load->model('sale/order');
        $this->load->model('catalog/product');
        $orderData = $this->model_sale_order->getOrder($order_id);
        $orderProducts = $this->model_sale_order->getOrderProducts($order_id);
        if (empty($orderData['shipping_address_1']) && !empty($orderData['payment_address_1'])) {
            $field_prefix = "payment";
        } else {
            $field_prefix = "shipping";
        }
        if (!empty($this->config->get('wuunder_custom_housenumber')) && isset($orderData['shipping_custom_field'][$this->config->get('wuunder_custom_housenumber')])) {
            $house_number = $orderData['shipping_custom_field'][$this->config->get('wuunder_custom_housenumber')];
        } else {
            $house_number = $this->separateAddressLine($orderData[$field_prefix . '_address_1'])[1];
        }
        $customerAdr = array(
            'business' => $orderData[$field_prefix . '_company'],
            'email_address' => $orderData['email'],
            'family_name' => $orderData[$field_prefix . '_lastname'],
            'given_name' => $orderData[$field_prefix . '_firstname'],
            'locality' => $orderData[$field_prefix . '_city'],
            'phone_number' => $orderData['telephone'],
            'street_name' => $this->separateAddressLine($orderData[$field_prefix . '_address_1'])[0],
            'house_number' => $house_number,
            'zip_code' => $orderData[$field_prefix . '_postcode'],
            'country' => $orderData[$field_prefix . '_iso_code_2']
        );

        $pickupAdr = array(
            'business' => $this->config->get('wuunder_business'),
            'email_address' => $this->config->get('wuunder_email_address'),
            'family_name' => $this->config->get('wuunder_family_name'),
            'given_name' => $this->config->get('wuunder_given_name'),
            'locality' => $this->config->get('wuunder_locality'),
            'phone_number' => $this->config->get('wuunder_phone_number'),
            'street_name' => $this->config->get('wuunder_street_name'),
            'house_number' => $this->config->get('wuunder_house_number'),
            'zip_code' => $this->config->get('wuunder_zip_code'),
            'country' => $this->config->get('wuunder_country')
        );

        $orderDescriptions = [];
        $orderPicture = null;
        $totalValue = 0;
        foreach ($orderProducts as $orderProduct) {
            array_push($orderDescriptions, $orderProduct['name']);
            if (is_null($orderPicture)) {
                $orderPicture = base64_encode(file_get_contents("../image/" . $this->model_catalog_product->getProduct($orderProduct['product_id'])['image']));
            }
            $totalValue += intval(floatval($orderProduct['price']) * 100 * intval($orderProduct['quantity']));
        }

        $defLength = 80;
        $defWidth = 50;
        $defHeight = 35;
        $defWeight = 20000;
        $defValue = 25 * 100;

        if (!empty($this->config->get('wuunder_shipping_length'))) {
            $defLength = $this->config->get('wuunder_shipping_length');
        }
        if (!empty($this->config->get('wuunder_shipping_width'))) {
            $defWidth = $this->config->get('wuunder_shipping_width');
        }
        if (!empty($this->config->get('wuunder_shipping_height'))) {
            $defHeight = $this->config->get('wuunder_shipping_height');
        }
        if (!empty($this->config->get('wuunder_shipping_weight'))) {
            $defWeight = $this->config->get('wuunder_shipping_weight');
        }

        $filter = null;
        if (!empty($orderData['shipping_code'])) {
            $code = explode('.', $orderData['shipping_code'])[0];
            $code = str_replace('flat', '', $code);
            if (!empty($code)) {
                    $filter = $this->config->get('flat' . $code . '_wuunder_filter');
            }
        }

        return array(
            'description' => implode(", ", $orderDescriptions),
            'personal_message' => $orderData['comment'],
            'picture' => $orderPicture,
            'customer_reference' => $order_id,
            'value' => $totalValue ? $totalValue : $defValue,
            'kind' => null,
            'length' => $defLength,
            'width' => $defWidth,
            'height' => $defHeight,
            'weight' => $defWeight,
            'delivery_address' => $customerAdr,
            'pickup_address' => $pickupAdr,
            'preferred_service_level' => $filter,
            'source' => array("product" => "Opencart 2.3.0.2 extension", "version" => array("build" => "1.2.3.2", "plugin" => "1.0"))
        );
    }

    public function generateBookingUrl()
    {
        // first determine base and catbase urls
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $base = HTTP_SERVER;
            $catBase = HTTP_CATALOG;
        } else {
            $base = HTTPS_SERVER;
            $catBase = HTTP_CATALOG;
        }

        if ( !empty($this->config->get('wuunder_base_url'))) {
            $catBase = $this->config->get('wuunder_base_url');
        }
        if ( !empty($this->config->get('wuunder_base_admin_url'))) {
            $base = $this->config->get('wuunder_base_admin_url');
        }


        if (isset($_REQUEST['order'])) {
            $order_id = $_REQUEST['order'];
            $this->load->model('extension/module/wuunder');
            if (!$this->model_extension_module_wuunder->checkLabelExists($order_id)) {
                $booking_token = uniqid();

                if (intval($this->config->get('wuunder_api'))) {
                    $apiUrl = 'https://api.wearewuunder.com/api/bookings';
                    $apiKey = $this->config->get('wuunder_live_key');
                } else {
                    $apiUrl = 'https://api-staging.wearewuunder.com/api/bookings';
                    $apiKey = $this->config->get('wuunder_staging_key');
                }

                $wuunderData = $this->buildWuunderData($order_id);
                $wuunderData['redirect_url'] = $base . "index.php?route=sale/order&label=created&token=" . $this->session->data['token'];
                $wuunderData['webhook_url'] = $catBase . "index.php?route=extension/module/wuunder/webhook&order=" . $order_id . "&token=" . $booking_token;

                // Encode variables
                $json = json_encode($wuunderData);

                // Setup API connection
                $cc = curl_init($apiUrl);

                curl_setopt($cc, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $apiKey, 'Content-type: application/json'));
                curl_setopt($cc, CURLOPT_POST, 1);
                curl_setopt($cc, CURLOPT_POSTFIELDS, $json);
                curl_setopt($cc, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($cc, CURLOPT_VERBOSE, 1);
                curl_setopt($cc, CURLOPT_HEADER, 1);

                // Don't log base64 image string
                $wuunderData['picture'] = 'base64 string removed';

                // Execute the cURL, fetch the XML
                $result = curl_exec($cc);
                $header_size = curl_getinfo($cc, CURLINFO_HEADER_SIZE);
                $header = substr($result, 0, $header_size);
                preg_match("!\r\n(?:Location|URI): *(.*?) *\r\n!i", $header, $matches);
                $url = $matches[1];

                // Close connection
                curl_close($cc);

                $this->model_extension_module_wuunder->insertBookingUrlAndToken($order_id, $url, $booking_token);

                if (!(substr($url, 0, 5) === "http:" || substr($url, 0, 6) === "https:")) {
                    if (intval($this->config->get('wuunder_api'))) {
                        $url = 'https://api.wearewuunder.com' . $url;
                    } else {
                        $url = 'https://api-staging.wearewuunder.com' . $url;
                    }
                }
                header("Location: " . $url);
            } else {
                header("Location: " . $catBase . "index.php?route=sale/order&token=" . $this->session->data['token']);
            }
        } else {
            header("Location: " . $catBase . "index.php?route=sale/order&token=" . $this->session->data['token']);
        }
    }
}