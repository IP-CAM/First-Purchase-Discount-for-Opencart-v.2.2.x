<?php
class ModelExtensionTotalFirstOrderDiscount extends Model {
	public function getTotal($total) {

		if ( $this->config->get('first_order_discount_status') && $this->customer->isLogged()  && $this->cart->getSubTotal() >= (float)$this->config->get('first_order_discount_min_subtotal_amount') ) {
			$this->load->language('extension/total/first_order_discount');

			$customer_group_id = $this->customer->getGroupId();
			$customer_id       = $this->customer->getId();

			if ( (!$this->config->get('first_order_discount_allowed_groups') || in_array($customer_group_id, $this->config->get('first_order_discount_allowed_groups'))) && ($this->countOrdersByCustomerId($customer_id) == 0) ) {

				$discount_type = $this->config->get('first_order_discount_discount_type');
				$discount_amount = $this->config->get('first_order_discount_discount_amount');

				$discount_total = 0;

				$sub_total = $this->cart->getSubTotal();


				if ($discount_type == 'F') {
					$discount_amount = min($discount_amount, $sub_total);
				}

				foreach ($this->cart->getProducts() as $product) {
					$discount = 0;

					if ($discount_type == 'F') {
						$discount = $discount_amount * ($product['total'] / $sub_total);
					} elseif ($discount_type == 'P') {
						$discount = $product['total'] / 100 * $discount_amount;
					}

					if ($product['tax_class_id']) {
						$tax_rates = $this->tax->getRates($product['total'] - ($product['total'] - $discount), $product['tax_class_id']);

						foreach ($tax_rates as $tax_rate) {
							if ($tax_rate['type'] == 'P') {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}


					$discount_total += $discount;
				}



				$total['totals'][] =array(
					'code'       => 'first_order_discount',
					'title'      => ($discount_type == 'P')? sprintf($this->language->get('text_first_order_discount_percent'), round($discount_amount,2) . '%') : $this->language->get('text_first_order_discount_fix'),
					'value'      => -$discount_total,
					'sort_order' => $this->config->get('first_order_discount_sort_order')
				);

				$total['total'] -= $discount_total;


			}
		}
	}

	public function countOrdersByCustomerId($customer_id){
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` WHERE (customer_id = '" . (int)$customer_id . "' ";

		if ($this->config->get('first_order_discount_check_ip')) {
			$sql .= " OR ip ='" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "'";
		}

		$sql .= ') AND order_status_id IN (' . implode(',', $this->config->get('first_order_discount_allowed_statuses')) . ')';

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}
?>