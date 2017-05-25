<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-credit" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-credit" class="form-horizontal">


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="first_order_discount_status" id="input-status" class="form-control">
            <?php if ($first_order_discount_status) {  ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
            </select>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_min_subtotal_amount; ?></label>
            <div class="col-sm-10">
              <input type="text" name="first_order_discount_min_subtotal_amount" value="<?php echo $first_order_discount_min_subtotal_amount; ?>"  id="input-sort-order" class="form-control" />
            </div>
          </div>






          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_customer_groups; ?></label>
            <div class="col-sm-10">


              <div class="scrollbox">
              <?php $class = 'odd'; ?>
              <?php foreach($customer_groups as $customer_group) { ?>
              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class;?>">
                <?php   if (in_array($customer_group['customer_group_id'], $first_order_discount_allowed_groups)) { ?>
                      <input type="checkbox" name="first_order_discount_allowed_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" /><?php echo $customer_group['name']; ?>
                <?php   } else { ?>
                      <input type="checkbox" name="first_order_discount_allowed_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" /><?php echo $customer_group['name']; ?>
                <?php   } ?>
                </div>
              <?php } ?>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_order_statuses; ?></label>
            <div class="col-sm-10">
              <div class="scrollbox">
              <?php $class = 'odd'; ?>
              <?php foreach($order_statuses as $order_status) { ?>
              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class;?>">
                <?php   if (in_array($order_status['order_status_id'], $first_order_discount_allowed_statuses)) { ?>
                      <input type="checkbox" name="first_order_discount_allowed_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" checked="checked" /><?php echo $order_status['name']; ?>
                <?php   } else { ?>
                      <input type="checkbox" name="first_order_discount_allowed_statuses[]" value="<?php echo $order_status['order_status_id']; ?>" /><?php echo $order_status['name']; ?>
                <?php   } ?>
                </div>
              <?php } ?>
              </div>

              <?php if ($error_allowed_statuses) { ?>
              <span class="error"><?php echo $error_allowed_statuses; ?></span>
              <?php } ?>
            </div>
          </div>



          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_check_ip; ?></label>
            <div class="col-sm-10">
              <select name="first_order_discount_check_ip" class="form-control">
                <?php if ($first_order_discount_check_ip) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_discount_type; ?></label>
            <div class="col-sm-10">
                <select name="first_order_discount_discount_type" class="form-control">
                <?php if ($first_order_discount_discount_type == 'F') { ?>
                <option value="F" selected="selected"><?php echo $text_discount_fixed; ?></option>
                <option value="P"><?php echo $text_discount_percent; ?></option>
                <?php } else { ?>
                <option value="F"><?php echo $text_discount_fixed; ?></option>
                <option value="P" selected="selected"><?php echo $text_discount_percent; ?></option>
                <?php } ?>
                </select>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_discount_amount; ?></label>
            <div class="col-sm-10">

              <input type="text" name="first_order_discount_discount_amount" value="<?php echo $first_order_discount_discount_amount; ?>" class="form-control"/>
              <?php if ($error_discount_amount) { ?>
      				<span class="error"><?php echo $error_discount_amount; ?></span>
      				<?php } ?>
            </div>
          </div>


          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-sort-order"><?php echo $entry_sort_order; ?></label>
            <div class="col-sm-10">

              <input type="text" name="first_order_discount_sort_order" value="<?php echo $first_order_discount_sort_order; ?>" class="form-control"/>
            </div>
          </div>


        </form>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
