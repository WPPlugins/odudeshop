<?php
//Admin list orders
    global $wpdb;
?>
<div class="wrap">
    <div class="icon32"><img src="<?php echo plugins_url('odudeshop/images/order.png'); ?>" /></div>
	<h2><?php echo __("Orders","odudeshop");?> 
    
    
    </h2>

    
<?php if(isset($msg)):
        if(is_array($msg)):
            foreach($msg as $a => $b):
            echo "<h3>$b</h3>";
            endforeach;
        else:
            echo "<h3>$msg</h3>";
        endif;
endif;     
?>


           
<form method="get" action="" id="posts-filter">
 <input type="hidden" name="post_type" value="odudeshop">
 <input type="hidden" name="page" value="order">
<div class="tablenav">

<div class="alignleft actions">
   

 <select class="select-action" name="ost">
<option value="">Order status:</option>
<option value="Pending" <?php if(isset($_REQUEST['ost'])) echo $_REQUEST['ost']=='Pending'?'selected=selected':''; ?>>Pending</option>
<option value="Processing" <?php if(isset($_REQUEST['ost'])) echo $_REQUEST['ost']=='Processing'?'selected=selected':''; ?>>Processing</option>
<option value="Completed" <?php if(isset($_REQUEST['ost'])) echo $_REQUEST['ost']=='Completed'?'selected=selected':''; ?>>Completed</option>
<option value="Canceled" <?php if(isset($_REQUEST['ost'])) echo $_REQUEST['ost']=='Canceled'?'selected=selected':''; ?>>Canceled</option>
</select>
      
<select class="select-action" name="pst">
<option value="">Payment status:</option>
<option value="Pending" <?php if(isset($_REQUEST['pst'])) echo $_REQUEST['pst']=='Pending'?'selected=selected':''; ?>>Pending</option>
<option value="Processing" <?php if(isset($_REQUEST['pst'])) echo $_REQUEST['pst']=='Processing'?'selected=selected':''; ?>>Processing</option>
<option value="Completed" <?php if(isset($_REQUEST['pst'])) echo $_REQUEST['pst']=='Completed'?'selected=selected':''; ?>>Completed</option>
<option value="Canceled" <?php if(isset($_REQUEST['pst'])) echo $_REQUEST['pst']=='Canceled'?'selected=selected':''; ?>>Canceled</option>
</select>
<?php echo __("Date","odudeshop");?><span class="info infoicon" title="(yyyy-mm-dd)">(?)</span> : 
<?php echo __("from","odudeshop");?> <input type="text" id="sdate" name="sdate" value="<?php if(isset($_REQUEST['sdate'])) echo $_REQUEST['sdate']; ?>"> 
<?php echo __("to","odudeshop");?> <input type="text" id="edate" name="edate" value="<?php if(isset($_REQUEST['edate'])) echo $_REQUEST['edate']; ?>">
    <script type="text/javascript">
            jQuery(document).ready(function(){
                //alert('hi');
                jQuery("#sdate").datepicker({ dateFormat:"yy-mm-dd"});
				jQuery("#edate").datepicker({ dateFormat:"yy-mm-dd"});
            });
        </script>
<?php echo __("Order ID:","odudeshop");?> <input type="text" name="oid" value="<?php if(isset($_REQUEST['oid'])) echo $_REQUEST['oid']; ?>">

<input type="submit" class="button-secondary action" id="doaction" name="doaction" value="Apply">

| <b><?php echo $t; ?> <?php echo __("order(s) found","odudeshop");?></b>
</div>

<br class="clear">
</div>

<div class="clear"></div>

<table cellspacing="0" class="wp-list-table widefat fixed striped posts">
    <thead>
    <tr>
    <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
 
    <th style="" class="manage-column column-title column-primary sortable desc" id="media" scope="col"><?php echo __("Order ID","odudeshop");?></th>
    <th style="" class="manage-column column-author" id="author" scope="col"><?php echo __("Total Amount","odudeshop");?></th>
    <th style="" class="manage-column column-author" id="author" scope="col"><?php echo __("Customer Name","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Order Status","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Payment Status","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Order Date","odudeshop");?></th>
    </tr>
    </thead>

    <tfoot>
    <tr>
    <th style="" class="manage-column column-cb check-column" id="cb" scope="col"><input type="checkbox"></th>
 
    <th style="" class="manage-column column-title column-primary sortable desc" id="media" scope="col"><?php echo __("Order ID","odudeshop");?></th>
    <th style="" class="manage-column column-author" id="author" scope="col"><?php echo __("Total Amount","odudeshop");?></th>
    <th style="" class="manage-column column-author" id="author" scope="col"><?php echo __("Customer Name","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Order Status","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Payment Status","odudeshop");?></th>
    <th style="" class="manage-column column-parent" id="parent" scope="col"><?php echo __("Order Date","odudeshop");?></th>
    </tr>
    </tfoot>

    <tbody class="list:post" id="the-list">
    <?php     
    foreach($orders as $order) { 
          $user_info = get_userdata($order->uid);         
        ?>
    <tr valign="top" class="alternate author-self status-inherit" id="post-8">

                <th class="check-column" scope="row"><input type="checkbox" value="<?php echo $order->order_id; ?>" name="id[]"></th>
                
                <td class="">
                    <strong>
                    <a title="Edit" href="edit.php?post_type=odudeshop&page=order&task=vieworder&id=<?php echo $order->order_id; ?>">
                    <?php echo $order->title; ?><?php echo $order->order_id; ?>
                    </a>
                    </strong>
                    <div class="row-actions">
                        <span class="trash">
                            <a title="Delete This Item" href="edit.php?post_type=odudeshop&page=order&task=delete_order&id=<?php echo $order->order_id; ?>">Delete</a>
                        </span>
                    </div>
                </td>
                <td class="author column-author"><?php echo $order->total; ?></td>
                <td class="author column-author"><?php echo $user_info->user_login; ?></td>
                <td class="parent column-parent"><?php echo $order->order_status; ?></td>
                <td class="parent column-parent"><?php echo $order->payment_status; ?></td>
                <td class="parent column-parent"><?php echo date("D, F d, Y",$order->date); ?></td>
     
     </tr>
     <?php } ?>
    </tbody>
</table>
                    
<?php
 

$page_links = paginate_links( array(
    'base' => add_query_arg( 'paged', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($t/$l),
    'current' => $p
));


?>

<div id="ajax-response"></div>

<div class="tablenav">

<?php if ( $page_links ) { ?>
<div class="tablenav-pages"><?php $page_links_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
    number_format_i18n( ( $_GET['paged'] - 1 ) * $l + 1 ),
    number_format_i18n( min( $_GET['paged'] * $l, $t ) ),
    number_format_i18n( $t ),
    $page_links
); echo $page_links_text; ?></div>
<?php } ?>

<div class="alignleft actions">

<input type="submit" class="button-primary action" id="delete_selected" name="delete_selected" value="Delete Selected">
<input type="hidden" id="delete_confirm" name="delete_confirm" value="0" />
</div>
    
<select class="select-action" name="delete_all_by_payment_sts">
<option value="">Payment Status:</option>
<option value="Pending">Pending</option>
<option value="Processing">Processing</option>
<option value="Canceled">Canceled</option>
</select>    
<input type="submit" class="button-primary action" name="delete_by_payment_sts" value="Delete All By Payment Status" />    
<br class="clear">
</div>
    <div style="display: none;" class="find-box" id="find-posts">
        <div class="find-box-head" id="find-posts-head"><?php echo __("Find Posts or Pages","odudeshop");?></div>
        <div class="find-box-inside">
            <div class="find-box-search">
                
                <input type="hidden" value="" id="affected" name="affected">
                <input type="hidden" value="3a4edcbda3" name="_ajax_nonce" id="_ajax_nonce">                <label  for="find-posts-input" class="screen-reader-text"><?php echo __("Search","odudeshop"); ?></label>
                <input type="text" value="" name="ps" id="find-posts-input">
                <input type="button" class="button" value="Search" onclick="findPosts.send();"><br>

                <input type="radio" value="posts" checked="checked" id="find-posts-posts" name="find-posts-what">
                <label  for="find-posts-posts"><?php echo __("Posts","odudeshop"); ?></label>
                <input type="radio" value="pages" id="find-posts-pages" name="find-posts-what">
                <label  for="find-posts-pages"><?php echo __("Pages","odudeshop"); ?></label>
            </div>
            <div id="find-posts-response"></div>
        </div>
        <div class="find-box-buttons">
            <input type="button" value="Close" onclick="findPosts.close();" class="button alignleft">
            <input type="submit" value="Select" class="button-primary alignright" id="find-posts-submit">
        </div>
    </div>
</form>
<br class="clear">

</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        $("#delete_selected").on('click',function(){
            $("#delete_confirm").val("1");
        });
    });
</script>