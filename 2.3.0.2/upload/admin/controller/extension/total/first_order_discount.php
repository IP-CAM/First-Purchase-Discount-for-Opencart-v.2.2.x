<?php
class ControllerExtensionTotalFirstOrderDiscount extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/total/first_order_discount');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('first_order_discount', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=total', true));
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['tab_general']  = $this->language->get('tab_general');
		$data['tab_help']    = $this->language->get('tab_help');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_discount_fixed'] = $this->language->get('text_discount_fixed');
		$data['text_discount_percent'] = $this->language->get('text_discount_percent');

		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_min_subtotal_amount'] = $this->language->get('entry_min_subtotal_amount');
		$data['entry_min_subtotal_amount_help'] = $this->language->get('entry_min_subtotal_amount_help');
		$data['entry_customer_groups'] = $this->language->get('entry_customer_groups');
		$data['entry_customer_groups_help'] = $this->language->get('entry_customer_groups_help');
		$data['entry_order_statuses'] = $this->language->get('entry_order_statuses');
		$data['entry_order_statuses_help'] = $this->language->get('entry_order_statuses_help');
		$data['entry_check_ip'] = $this->language->get('entry_check_ip');
		$data['entry_check_ip_help'] = $this->language->get('entry_check_ip_help');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$data['entry_discount_type'] = $this->language->get('entry_discount_type');
		$data['entry_discount_amount'] = $this->language->get('entry_discount_amount');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_remove'] = $this->language->get('button_remove');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}


		if (isset($this->error['allowed_statuses'])) {
			$data['error_allowed_statuses'] = $this->error['allowed_statuses'];
		} else {
			$data['error_allowed_statuses'] = '';
		}

		if (isset($this->error['discount_amount'])) {
			$data['error_discount_amount'] = $this->error['discount_amount'];
		} else {
			$data['error_discount_amount'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], true),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=total', true),
      		'separator' => ' :: '
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/total/first_order_discount', 'token=' . $this->session->data['token'], true),
      		'separator' => ' :: '
   		);

		$data['action'] = $this->url->link('extension/total/first_order_discount', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'].'&type=total', true);

		if (isset($this->request->post['first_order_discount_status'])){
			$data['first_order_discount_status'] = $this->request->post['first_order_discount_status'];
		} elseif ( $this->config->get('first_order_discount_status')){
			$data['first_order_discount_status'] = $this->config->get('first_order_discount_status');
		} else {
			$data['first_order_discount_status'] = '';
		}

		if (isset($this->request->post['first_order_discount_min_subtotal_amount'])){
			$data['first_order_discount_min_subtotal_amount'] = $this->request->post['first_order_discount_min_subtotal_amount'];
		} elseif ( $this->config->get('first_order_discount_min_subtotal_amount')){
			$data['first_order_discount_min_subtotal_amount'] = $this->config->get('first_order_discount_min_subtotal_amount');
		} else {
			$data['first_order_discount_min_subtotal_amount'] = '';
		}

		if (isset($this->request->post['first_order_discount_allowed_groups'])){
			$data['first_order_discount_allowed_groups'] = $this->request->post['first_order_discount_allowed_groups'];
		} elseif ( $this->config->get('first_order_discount_allowed_groups')){
			$data['first_order_discount_allowed_groups'] = $this->config->get('first_order_discount_allowed_groups');
		} else {
			$data['first_order_discount_allowed_groups'] = array();
		}

		if (isset($this->request->post['first_order_discount_allowed_statuses'])){
			$data['first_order_discount_allowed_statuses'] = $this->request->post['first_order_discount_allowed_statuses'];
		} elseif ( $this->config->get('first_order_discount_allowed_statuses')){
			$data['first_order_discount_allowed_statuses'] = $this->config->get('first_order_discount_allowed_statuses');
		} else {
			$data['first_order_discount_allowed_statuses'] = array();
		}

		if (isset($this->request->post['first_order_discount_check_ip'])){
			$data['first_order_discount_check_ip'] = $this->request->post['first_order_discount_check_ip'];
		} elseif ( $this->config->get('first_order_discount_check_ip')){
			$data['first_order_discount_check_ip'] = $this->config->get('first_order_discount_check_ip');
		} else {
			$data['first_order_discount_check_ip'] = '';
		}

		if (isset($this->request->post['first_order_discount_discount_type'])){
			$data['first_order_discount_discount_type'] = $this->request->post['first_order_discount_discount_type'];
		} elseif ( $this->config->get('first_order_discount_discount_type')){
			$data['first_order_discount_discount_type'] = $this->config->get('first_order_discount_discount_type');
		} else {
			$data['first_order_discount_discount_type'] = '';
		}

		if (isset($this->request->post['first_order_discount_discount_amount'])){
			$data['first_order_discount_discount_amount'] = $this->request->post['first_order_discount_discount_amount'];
		} elseif ( $this->config->get('first_order_discount_discount_amount')){
			$data['first_order_discount_discount_amount'] = $this->config->get('first_order_discount_discount_amount');
		} else {
			$data['first_order_discount_discount_amount'] = '';
		}

		if (isset($this->request->post['first_order_discount_sort_order'])){
			$data['first_order_discount_sort_order'] = $this->request->post['first_order_discount_sort_order'];
		} elseif ( $this->config->get('first_order_discount_sort_order')){
			$data['first_order_discount_sort_order'] = $this->config->get('first_order_discount_sort_order');
		} else {
			$data['first_order_discount_sort_order'] = '';
		}

		$this->load->model('customer/customer_group');
		$data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

		$this->load->model('localisation/order_status');
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$data['token'] = $this->session->data['token'];

				$data['header'] = $this->load->controller('common/header');
				$data['column_left'] = $this->load->controller('common/column_left');
				$data['footer'] = $this->load->controller('common/footer');

				$this->response->setOutput($this->load->view('extension/total/first_order_discount', $data));
	}

	private function validate() {

		if (!$this->user->hasPermission('modify', 'extension/total/first_order_discount')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!isset($this->request->post['first_order_discount_allowed_statuses']) || count($this->request->post['first_order_discount_allowed_statuses']) == 0){
			$this->error['allowed_statuses'] = $this->language->get('error_allowed_statuses');
			$this->error['warning'] =$this->language->get('error_allowed_statuses');
		}

		if (!is_numeric($this->request->post['first_order_discount_discount_amount']) || $this->request->post['first_order_discount_discount_amount'] == 0 || utf8_strlen(trim($this->request->post['first_order_discount_discount_amount'])) == 0) {
			$this->error['discount_amount'] = $this->language->get('error_discount_amount');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>
