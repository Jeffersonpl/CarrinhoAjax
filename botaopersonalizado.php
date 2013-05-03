  <?php $_helper = $this->helper('catalog/output'); ?>
               <?php $add = $this->getUrl('checkout/cart/add', array(
 $_product,
   Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED => $this->helper('core/url')->getEncodedUrl()
   )); ?>
               <form action="<?php echo $add ?>" method="post" id="product_addtocart_form<?php echo  $_product->getId() ?>"<?php if($_product->getOptions()): ?> enctype="multipart/form-data"<?php endif; ?>>
                
              <div class="no-display">
              
        <input type="hidden" name="product" value="<?php echo $_product->getId() ?>" />
        <input type="hidden" name="related_product" id="related-products-field" value="" />
      </div>
    <div style="width:180px; height:34px; margin-left:20px; margin-top:10px;" >            
     <?php if(!$_product->isGrouped()): ?>
                  
                  <div style="float:left; width:33px;background:url(<?php echo $this->getSkinUrl('images/btn_new_input.png') ?>) no-repeat; height:34px; margin-top:-4px;">  
                    <input type="text" name="qty" id="qty<?php echo  $_product->getId() ?>" maxlength="2" value="1" title="<?php echo $this->__('Qty') ?>" class="input-text qty" style=" border:none; background:none;  margin-top:5px; text-align:center; margin-left:-1px;" /></div>
                    <div style=" float:left;width:12px;height:34px; margin-top:-4px;">
                   <div style="height:15px; margin-top:0px;">  <input type="button" value="" onclick="$j('#qty<?php echo  $_product->getId() ?>').val(parseInt($j('#qty<?php echo  $_product->getId() ?>').val())+1)" style="width:12px; background:url(<?php echo $this->getSkinUrl('images/btn_new_adicionar_cima.png') ?>)no-repeat; border:none; margin-top:0; "></div><div style="height:19px; margin-top:0px;">
                     <input type="button" value="" onclick="$j('#qty<?php echo  $_product->getId() ?>').val(parseInt($j('#qty<?php echo  $_product->getId() ?>').val())-1)" style="width:12px; background:url(<?php echo $this->getSkinUrl('images/btn_new_adicionar_baixo.png') ?>)no-repeat; border:none; margin-top:0; height:19px; "></div> </div>              
                  <?php endif; ?>
   <div style="width:135px; float:right;height:34px; margin-top:-4px;">
             <a href="#dialog" rel="shadowbox"  title="<?php echo $buttonTitle ?>" onclick="productAddToCartForm<?php echo  $_product->getId() ?>.submit(this)" style="cursor:pointer;"><img  src="<?php echo $this->getSkinUrl('images/btn_new_adicionar.png') ?>" align="right" /></a>
                    <span id='ajax_loader' style='display:none'><img src='<?php echo $this->getSkinUrl('images/ajax-loader.gif')?>'/></span>
                    </div>
                    </div>
                   
                 </form>
                  <script type="text/javascript">
    //<![CDATA[
	
        var productAddToCartForm<?php echo  $_product->getId() ?> = new VarienForm('product_addtocart_form<?php echo  $_product->getId() ?>');
       productAddToCartForm<?php echo  $_product->getId() ?>.submit = function(button, url) {
            if (this.validator.validate()) {
                var form = this.form;
                var oldUrl = form.action;
 
                if (url) {
                   form.action = url;
                }
                var e = null;
//Start of our new ajax code
                if(!url){
                    url =  $j('#product_addtocart_form<?php echo  $_product->getId() ?>').attr('action');
                }
                var data =  $j('#product_addtocart_form<?php echo  $_product->getId() ?>').serialize();
                data += '&isAjax=1';    
                $j('#ajax_loader').show();
                try {
                    $j.ajax({
                           url:url,
                          dataType: 'json',
                          type : 'post',
                          data: data,
											
                          success: function(data){
							  $j('#ajax_loader').hide();
                            
                               alert(data.status + ": " + data.message);
							    location.reload();
                             								
                          },
						   error: function(data) {
		 	// em caso de erro você pode dar um alert('erro');
			$j('#ajax_loader').hide();
			
                location.reload();
		
		  }
						 
                    });
                } catch (e) {
                }
//End of our new ajax code
                this.form.action = oldUrl;
                if (e) {
                    throw e;
                }
            }
        }.bind(productAddToCartForm<?php echo  $_product->getId() ?>);
		
		
       productAddToCartForm<?php echo  $_product->getId() ?>.submitLight = function(button, url){
            if(this.validator) {
                var nv = Validation.methods;
                delete Validation.methods['required-entry'];
                delete Validation.methods['validate-one-required'];
                delete Validation.methods['validate-one-required-by-name'];
                if (this.validator.validate()) {
                    if (url) {
                        this.form.action = url;
                    }
                    this.form.submit();
                }
                Object.extend(Validation.methods, nv);
            }
        }.bind(productAddToCartForm<?php echo  $_product->getId() ?>);
    //]]>
    </script>