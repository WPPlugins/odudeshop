<?php
    global $current_user, $wpdb;
    $user = $wpdb->get_row("select * from {$wpdb->prefix}users where ID=".$current_user->ID);
    $billing_shipping=unserialize(get_user_meta($current_user->ID, 'user_billing_shipping',true));
    if(is_array($billing_shipping))
        extract($billing_shipping);
     
?>
<div class="odude-shop">
    <div class="container-fluid">
<div id="form" class="form">

<form method="post" id="validate_form" class="" name="contact_form" action="">
    <input type="hidden" name="dact" value="update-profile" />
    <ul style="display: block; list-style: none;">
        <li class="col-md-12 span12"><h3>My Profile - Login Details</h3></li>
        <?php if(isset($_SESSION['member_error']))if($_SESSION['member_error']){ ?>
        <li class="col-md-11"><div class="alert alert-error"><b>Save Failed!</b><br/><?php echo implode('<br/>',$_SESSION['member_error']); unset($_SESSION['member_error']); ?></div></li>
        <?php } ?>
        <?php if(isset($_SESSION['member_success']))if($_SESSION['member_success']){ ?>
        <li class="col-md-11"><div class="alert alert-success"><b>Done!</b><br/><?php echo $_SESSION['member_success']; unset($_SESSION['member_success']); ?></div></li>
        <?php } ?>
    </ul>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label for="name">Your name: </label>
            <input type="text" class="required form-control" value="<?php echo $user->display_name;?>" name="profile[display_name]" id="name">
        </div>
        <div class="form-group col-md-5 span5">
            <label for="email">Your Email:</label>
            <input type="text" class="required form-control" value="<?php echo $user->user_email;?>" name="profile[user_email]" id="email">
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label for="phone">Phone Number: </label>
            <input type="text" class="required form-control" value="<?php echo get_user_meta($current_user->ID,'phone',true);?>" name="phone" id="phone">
        </div>
        <div class="form-group col-md-5 span5">
            <label for="company_name">PayPal Account: </label>
            <input type="text" class="form-control" value="<?php echo get_user_meta($current_user->ID,'payment_account',true);?>" name="payment_account" id="payment_account" placeholder="Add paypal or moneybookers email here">
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label for="new_pass">New Password: </label>
            <input placeholder="Use nothing if you don't want to change old password" type="password" value="" name="password" id="new_pass" class=" form-control">
        </div>
        <div class="form-group col-md-5 span5">
            <label for="re_new_pass">Re-type New Password: </label>
            <input type="password" value="" name="cpassword" id="re_new_pass" class=" form-control">
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-11 span10">
            <label for="message">Description:</label>
            <textarea class="required form-control" cols="20" rows="8" name="profile[description]" id="message"><?php echo htmlspecialchars(stripslashes($current_user->description));?></textarea>
        </div>
    </div>
   
    
    
    <h3 class="col-md-12 span12">My Billing Address</h3>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_first_name"><?php echo __("First Name", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['first_name']) echo $billing['first_name']; ?>" placeholder="First Name" id="billing_first_name" name="checkout[billing][first_name]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_last_name"><?php echo __("Last Name", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['last_name']) echo $billing['last_name']; ?>" placeholder="Last Name" id="billing_last_name" name="checkout[billing][last_name]" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label  class="" for="billing_company"><?php echo __("Company Name", "odudeshop"); ?></label>
            <input type="text" value="<?php if ($billing['company']) echo $billing['company']; ?>" placeholder="Company (optional)" id="billing_company" name="checkout[billing][company]" class="input-text  form-control">
        </div> 
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_address_1"><?php echo __("Address Line 1", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['address_1']) echo $billing['address_1']; ?>" placeholder="Address" id="billing_address_1" name="checkout[billing][address_1]" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label  class="" for="billing_address_2"><?php echo __("Address Line 2", "odudeshop"); ?></label>
            <input type="text" value="<?php if ($billing['address_2']) echo $billing['address_2']; ?>" placeholder="Address 2 (optional)" id="billing_address_2" name="checkout[billing][address_2]" class="input-text  form-control">
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_city"><?php echo __("Town/City", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['city']) echo $billing['city']; ?>" placeholder="Town/City" id="billing_city" name="checkout[billing][city]" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_postcode"><?php echo __("Postcode/Zip", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['postcode']) echo $billing['postcode']; ?>" placeholder="Postcode/Zip" id="billing_postcode" name="checkout[billing][postcode]" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_country"><?php echo __("Country", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <?php
            global $wpdb;
            $countries = $wpdb->get_results("select * from {$wpdb->prefix}os_country order by country_name");

            ?>
            <select class="required form-control" id="billing_country" name="checkout[billing][country]">
                <option value="">--Select a country--</option>
                <?php

                foreach ($countries as $country) {
                    if($billing['country']==$country->country_code) {$selected=' selected="selected"';}
                                else {$selected="";}
                    if ($settings['allow_country']) {
                        foreach ($settings['allow_country'] as $ac) {
                            if ($ac == $country->country_code) {

                                echo '<option value="' . $country->country_code . '"'.$selected.'>' . $country->country_name . '</option>';
                                break;
                            }
                        }
                    } else {
                        echo '<option value="' . $country->country_code . '" '.$selected.'>' . $country->country_name . '</option>';
                    }
                }
                ?>
            </select>
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_state"><?php echo __("State/County", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" id="billing_state" name="checkout[billing][state]" placeholder="State/County" value="<?php if ($billing['state']) echo $billing['state']; ?>" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_email"><?php echo __("Email Address", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['email']) echo $billing['email']; ?>" placeholder="Email Address" id="billing_email" name="checkout[billing][email]" class="input-text required email  form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label class="" for="billing_phone"><?php echo __("Phone", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($billing['phone']) echo $billing['phone']; ?>" placeholder="Phone" id="billing_phone" name="checkout[billing][phone]" class="input-text required  form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <div class="checkbox">
                <label  class="checkbox" for="shiptobilling-checkbox">
                    <input type="checkbox" value="1" name="shiptobilling"  class="input-checkbox" id="shiptobilling-checkbox">
                        <?php echo __("Ship to same address?", "odudeshop"); ?>
                </label>
            </div>        
        </div>
    </div>
    
    
    <div id="" class="shipping_address">
    <h3 class="span12 col-md-12 span12">My Shipping Address</h3>
        
    <div class="row row-fluid">
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_first_name"><?php echo __("First Name", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($shippingin['first_name']) echo $shippingin['first_name']; ?>" placeholder="First Name" id="shipping_first_name" name="checkout[shippingin][first_name]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_last_name"><?php echo __("Last Name", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($shippingin['last_name']) echo $shippingin['last_name']; ?>" placeholder="Last Name" id="shipping_last_name" name="checkout[shippingin][last_name]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
    </div>
    
    <div class="row row-fluid">    
        <div class="form-group col-md-5 span5">
            <label  class="" for="shipping_company"><?php echo __("Company Name", "odudeshop"); ?></label>
            <input type="text" value="<?php if ($shippingin['company']) echo $shippingin['company']; ?>" placeholder="Company (optional)" id="shipping_company" name="checkout[shippingin][company]" class="input-text form-control">
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_address_1"><?php echo __("Address Line 1", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($shippingin['address_1']) echo $shippingin['address_1']; ?>" placeholder="Address" id="shipping_address_1" name="checkout[shippingin][address_1]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
    </div>
        
    <div class="row row-fluid">    
        <div class="form-group col-md-5 span5">
            <label  class="" for="shipping_address_2"><?php echo __("Address Line 2", "odudeshop"); ?></label>
            <input type="text" value="<?php if ($shippingin['address_2']) echo $shippingin['address_2']; ?>" placeholder="Address 2 (optional)" id="shipping_address_2" name="checkout[shippingin][address_2]" class="input-text form-control">
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_city"><?php echo __("Town/City", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($shippingin['city']) echo $shippingin['city']; ?>" placeholder="Town/City" id="shipping_city" name="checkout[shippingin][city]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
    </div>
        
    <div class="row row-fluid">    
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_postcode"><?php echo __("Postcode/Zip", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" value="<?php if ($shippingin['postcode']) echo $shippingin['postcode']; ?>" placeholder="Postcode/Zip" id="shipping_postcode" name="checkout[shippingin][postcode]" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_country"><?php echo __("Country", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <select class="required col-md-6 span6 form-control" id="shipping_country" name="checkout[shippingin][country]">
                <option value="">--Select a country--</option>
                <?php
                foreach ($countries as $country) {
                    if ($shippingin['country'] == $country->country_code) {
                        $selected = ' selected="selected"';
                    } else {
                        $selected = "";
                    }
                    if ($settings['allow_country']) {
                        foreach ($settings['allow_country'] as $ac) {

                            if ($ac == $country->country_code) {
                                echo '<option value="' . $country->country_code . '"' . $selected . '>' . $country->country_name . '</option>';
                                break;
                            }
                        }
                    } else {
                        echo '<option value="' . $country->country_code . '" ' . $selected . '>' . $country->country_name . '</option>';
                    }
                }
                ?>

            </select>
            <span class="error help-block"></span>
        </div>
    </div>
        
    <div class="row row-fluid">    
        <div class="form-group col-md-5 span5">
            <label class="" for="shipping_state"><?php echo __("State/County", "odudeshop"); ?> <abbr title="required" class="required">*</abbr></label>
            <input type="text" id="shipping_state" name="checkout[shippingin][state]" placeholder="State/County" value="<?php if ($shippingin['state']) echo $shippingin['state']; ?>" class="input-text required form-control">
            <span class="error help-block"></span>
        </div>
    </div>
        
    </div>
    
    <div class="row row-fluid">
        <div class="col-md-12 span12">
            <button type="submit" class="btn btn-large btn-primary" id="billing_btn"><i class="icon-ok icon-white"></i> Save Changes</button>
        </div>
    </div>

</form>
</div>

    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#shiptobilling-checkbox').click(function(){
            if(this.checked) $('.shipping_address').fadeOut();
            else $('.shipping_address').fadeIn();
        });
        
        $('span.error').css('color','red');
        
        $('#billing_btn').click(function(){
            //alert('1');
            var go = false;
            if($.trim($("#billing_first_name").val())==""){
                go = true;
                $("#billing_first_name").parent().find('.error').html("Please Enter Your First Name");
            }
            else{
                $("#billing_first_name").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_last_name").val())==""){
                go = true;
                $("#billing_last_name").parent().find('.error').html("Please Enter Your Last Name");
            }
            else{
                $("#billing_last_name").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_address_1").val())==""){
                go = true;
                $("#billing_address_1").parent().find('.error').html("Please Enter Your Address");
            }
            else{
                $("#billing_address_1").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_city").val())==""){
                go = true;
                $("#billing_city").parent().find('.error').html("Please Enter Your City");
            }
            else{
                $("#billing_city").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_postcode").val())==""){
                go = true;
                $("#billing_postcode").parent().find('.error').html("Please Enter Your Postcode");
            }
            else{
                $("#billing_postcode").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_country").val())==""){
                go = true;
                $("#billing_country").parent().find('.error').html("Please Enter Your Country");
            }
            else{
                $("#billing_country").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_state").val())==""){
                go = true;
                $("#billing_state").parent().find('.error').html("Please Enter Your State");
            }
            else{
                $("#billing_state").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_email").val())==""){
                go = true;
                $("#billing_email").parent().find('.error').html("Please Enter Your Email Address");
            }
            else{
                $("#billing_email").parent().find('.error').html("");
            }
            
            if($.trim($("#billing_phone").val())==""){
                go = true;
                $("#billing_phone").parent().find('.error').html("Please Enter Your Phone Number");
            }
            else{
                $("#billing_phone").parent().find('.error').html("");
            }
            
            
            if(!$('#shiptobilling-checkbox').is(':checked')){
                //alert('hiii');
                if($.trim($("#shipping_first_name").val())==""){
                go = true;
                $("#shipping_first_name").parent().find('.error').html("Please Enter Your First Name");
                }
                else{
                    $("#shipping_first_name").parent().find('.error').html("");
                }

                if($.trim($("#shipping_last_name").val())==""){
                    go = true;
                    $("#shipping_last_name").parent().find('.error').html("Please Enter Your Last Name");
                }
                else{
                    $("#shipping_last_name").parent().find('.error').html("");
                }

                if($.trim($("#shipping_address_1").val())==""){
                    go = true;
                    $("#shipping_address_1").parent().find('.error').html("Please Enter Your Address");
                }
                else{
                    $("#shipping_address_1").parent().find('.error').html("");
                }

                if($.trim($("#shipping_city").val())==""){
                    go = true;
                    $("#shipping_city").parent().find('.error').html("Please Enter Your City");
                }
                else{
                    $("#shipping_city").parent().find('.error').html("");
                }

                if($.trim($("#shipping_postcode").val())==""){
                    go = true;
                    $("#shipping_postcode").parent().find('.error').html("Please Enter Your Postcode");
                }
                else{
                    $("#shipping_postcode").parent().find('.error').html("");
                }

                if($.trim($("#shipping_country").val())==""){
                    go = true;
                    $("#shipping_country").parent().find('.error').html("Please Enter Your Country");
                }
                else{
                    $("#shipping_country").parent().find('.error').html("");
                }

                if($.trim($("#shipping_state").val())==""){
                    go = true;
                    $("#shipping_state").parent().find('.error').html("Please Enter Your State");
                }
                else{
                    $("#shipping_state").parent().find('.error').html("");
                }
                
            }
            
            if(go==false) return true;
            
            else return false;
        });
        
    });
    
</script>