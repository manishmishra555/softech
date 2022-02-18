<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>


        <header class="content__title">
          <h1><?php echo $page_title; ?></h1>
          <div class="actions">
            <!-- <a href="#" class="btn btn-primary waves-effect"><i class="zmdi zmdi-view-stream"></i> Product Attributes</a> -->
          </div>
        </header>
        <div class="toolbar">
          <div class="toolbar__label"><span class="hidden-xs-down">Total</span> <?php echo count($total_record); ?> Records</div>
          <div class="actions"> <i class="actions__item zmdi zmdi-search" data-ma-action="toolbar-search-open"></i>
          </div>
          <div class="toolbar__search" style="display: none;">
            <input placeholder="Search..." type="text" name="list_searchkey" id="list_searchkey" data-platform="meesho" data-control="product" data-forms_id="add_new_product">
            <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i> </div>
        </div>
        <div class="card">
          <div class="card-header">
            <h2 class="card-title">List</h2>
          </div>
          <div class="card-block">
            <div class="table-responsive">
              <table class="table mb-0">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Catalogue ID</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Platform</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody id="list_search_result">
                  <?php
                  $j = 1;
                  if (!empty($product)) {
                    foreach ($product as $pc) {
                      $PImages = json_decode($pc->image_fids);
                      ?>
                      <tr>
                        <th scope="row"><?php echo $j; ?></th>
                        <td>
                          <?php
                          if($PImages != ''){
                              if (count($PImages) > 0) {
                                for ($i = 0; $i < sizeof($PImages); $i++) {
                                  ?>
                              <img src="<?php echo $this->media->getThumbPathById($PImages[$i], '65x49/'); ?>" title="<?php echo $pc->product_name; ?>">
                          <?php }
                              } } ?>
                        </td>
                        <td><?php echo $pc->product_name; ?></td>
                        <td><?php echo $pc->catalogue_id; ?></td>
                        <td><?php echo $pc->sku; ?></td>
                        <td><?php echo $pc->price; ?></td>
                        <td><?php echo $pc->platform; ?></td>
                        <td>
                          <?php if (checkPermission('edit')) { ?>
                            <div class="form-group">
                              <div class="toggle-switch">
                                <?php if ($pc->status == 'active') {
                                        $status = "checked";
                                        $title = "Active";
                                      } else {
                                        $status = '';
                                        $title = "Inactive";
                                      } ?>
                                <input class="toggle-switch__checkbox" type="checkbox" <?php echo $status; ?> value="<?php echo $pc->status; ?>" data-id="<?php echo $pc->pid; ?>" data-control="product" id="status<?php echo $pc->pid; ?>" title="<?php echo $title; ?>">
                                <i class="toggle-switch__helper"></i> </div>
                            </div>
                          <?php } ?>
                        </td>
                        <td>
                          <div class="btn-groups">
                            <?php if (checkPermission('edit')) { ?>
                              <?php echo anchor('sysadmin/product/edit/' . $pc->pid, 'Edit', 'class="btn btn-primary waves-effect"'); ?>
                            <?php }
                                if (checkPermission('delete')) { ?>
                              <a href="#" class="btn btn-danger waves-effect" id="remove" data-id="<?php echo $pc->pid; ?>" data-control="product">Remove</a>
                            <?php } ?>
                          </div>
                        </td>
                      </tr>
                    <?php $j++;
                      }
                    } else { ?>
                    <tr>
                      <td colspan="8" align="center">No record found...</td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
              <table>
                <tr>
                  <td colspan="8" align="right" style="font-size:12px;">
                    <div class="center"><?php echo $pageing_link; ?></div>
                  </td>
                </tr>
              </table>
            </div>
          </div>
        </div>
        <?php if (checkPermission('create')) { ?>
          <a class="btn btn-danger btn--action btn--fixed zmdi zmdi-plus waves-effect" href="<?= site_url('sysadmin/product/create'); ?>"></a>
        <?php } ?>
