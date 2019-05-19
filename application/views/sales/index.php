<?php $this->load->view('default/header') ?>		

<td  valign="top" align="left">
<div id='content_x'>

<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
</script>


<script type="text/javascript">

function test(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }
    
    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
    
    if (com=='Delete')
        {
           if($('.trSelected',grid).length>0){
			   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++){
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax({
					   type: "POST",
					   url: "<?php echo site_url("/sales_ajax/del_cust_pros");?>",
					   data: "items="+itemlist,
					   success: function(data){
					   	$('#sales_ind_pros_list').flexReload();
					  	alert(data);
					   }
					});
				}
			} else {
				return false;
			} 
        }          
} 

function del_corp(com,grid)
{
    if (com=='Select All')
    {
		$('.bDiv tbody tr',grid).addClass('trSelected');
    }
    
    if (com=='DeSelect All')
    {
		$('.bDiv tbody tr',grid).removeClass('trSelected');
    }
    
    if (com=='Delete')
        {
           if($('.trSelected',grid).length>0){
			   if(confirm('Delete ' + $('.trSelected',grid).length + ' items?')){
		            var items = $('.trSelected',grid);
		            var itemlist ='';
		        	for(i=0;i<items.length;i++)
					{
						itemlist+= items[i].id.substr(3)+",";
					}
					$.ajax(
					{
						type: "POST",
						url: "<?php echo site_url("/sales_ajax/del_corp_pros");?>",
						data: "items="+itemlist,
						success: 
								function(data)
								{
									$('#sales_corp_pros_list').flexReload();
									alert(data);
								}
					});
				}
			} else {
				return false;
			} 
        }          
} 

function view_ind(com,grid)
{
    if (com=='View')
        {
           if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
			  
			var arrData = getSelectedRow();
			
			var xx 	= arrData[0][1];
			if(xx=='&nbsp;')
			{
				var id 	= arrData[0][0];
				var urls = '<?php echo site_url("/sales/view_cust_ind/0")?>'+'/'+id;
			}
			else
			{
				var id 	= arrData[0][1];
				var urls = '<?php echo site_url("/sales/view_cust_ind/1")?>'+'/'+id;
			}
			window.location = urls ; 
			}	
        }       
}


function edit_ind(com,grid)
{
    if (com=='Edit')
	{
		if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2)
		{
			var arrData = getSelectedRow();
			var id 	= arrData[0][1];
			var urls = '<?php echo site_url("/sales/edit_cust_ind/1")?>'+'/'+id;
			window.location = urls ; 
		}	
	}          
}

function edit_ind_pros(com,grid)
{
    if (com=='Edit')
	{
		if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) 
		{
			var arrData = getSelectedRow();
			var id 	= arrData[0][0];
			var urls = '<?php echo site_url("/sales/edit_cust_ind/0")?>'+'/'+id;
			window.location = urls ; 
		}	
	}          
}

function view_corp(com,grid)
{
    if (com=='View')
        {
			if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) 
			{
				var arrData = getSelectedRow();
				var id 	= arrData[0][1];
				var urls = '<?php echo site_url("/sales/view_cust_corp/1")?>'+'/'+id;
				window.location = urls ; 
			}	
        }       
}


function edit_corp(com,grid)
{
    if (com=='Edit')
        {
           if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
			  
			var arrData = getSelectedRow();
			var id 	= arrData[0][1];
			var urls = '<?php echo site_url("/sales/edit_cust_corp/1")?>'+'/'+id;
			window.location = urls ; 
			}	
        }          
}

function edit_tele(com,grid)
{
    if (com=='Edit')
        {
           if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
			  
			var arrData = getSelectedRow();
			var id 	= arrData[0][0];
			var urls = '<?php echo site_url("/sales/edit_cust_tele")?>'+'/'+id;
			window.location = urls ; 
			}	
        }          
}

function view_tele(com,grid)
{
    if (com=='View')
        {
           if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
			  
			var arrData = getSelectedRow();
			var id 	= arrData[0][0];
			var urls = '<?php echo site_url("/sales/view_cust_tele")?>'+'/'+id;
			window.location = urls ; 
			}	
        }          
}

function viewPropensity(com, grid)
{
    if (com=='View')
        {
			if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
				var arrData = getSelectedRow();
				var cif_key	= arrData[0][1];
				var id = arrData[0][0];
				var urls = '<?php echo site_url("/sales/view_propensity")?>'+'/'+cif_key+'/'+id;
				window.location = urls ; 
			}	
        }          
}

function viewOffensive(com, grid)
{
    if (com=='View')
        {
			if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
				var arrData = getSelectedRow();
				var cif_key	= arrData[0][1];
				var id = arrData[0][0];
				var urls = '<?php echo site_url("/sales/view_offensive")?>'+'/'+id;
				window.location = urls ; 
			}	
        }          
}

function add_corp_pros(com,grid)
{
    if (com=='Add')
        {
			var urls = '<?php echo site_url("/sales/add_cust_corp")?>';
			window.location = urls ; 
        }          
}

function add_ind_pros(com,grid)
{
    if (com=='Add')
        {
			var urls = '<?php echo site_url("/sales/edit_cust_ind_pros")?>';
			alert('PASTIKAN CIF TERISI SESUAI ICONS UNTUK NASABAH EXISTING DAN NAMA NASABAH TERISI SESUAI DENGAN KTP/NAMA PERUSAHAAN UNTUK NASABAH BARU');
			window.location = urls ; 
        }          
}

function getSelectedRow() {
	var arrReturn   = [];
	$('.trSelected').each(function() {
			var arrRow              = [];
			$(this).find('div').each(function() {
					arrRow.push( $(this).html() );
			});
			arrReturn.push(arrRow);
	});
	return arrReturn;
}

//leads propensity
var totalPropensity=0;
function appendToSales(com,grid)
{
    if (com=='Append to sales')
	{
		totalPropensity=$('.trSelected',grid).length
		if(totalPropensity>0) {
			var html='';
			$('.trSelected',grid).each(function(){
				html+='<input type="hidden" name="id[]" value="'+$(this).find('td:first div').html()+'" />';
			});
			$('#tampung_buat_cif').html(html);
			$('#dlg_list_sales #form_input').show();
			$('#dlg_list_sales #loading_box').hide();
			$('#dlg_list_sales').dialog({title:'Pilih Sales'});
			$('#dlg_list_sales').dialog('open');
		}
	}
}

//leads 500046
var total500046=0;
function appendToSales2(com,grid)
{
    if (com=='Append to sales')
	{
		total500046=$('.trSelected',grid).length
		if(total500046>0) {
			var html='';
			$('.trSelected',grid).each(function(){
				html+='<input type="hidden" name="id[]" value="'+$(this).find('td:first div').html()+'" />';
			});
			$('#tampung_buat_cif2').html(html);
			$('#dlg_list_sales2 #form_input2').show();
			$('#dlg_list_sales2 #loading_box2').hide();
			$('#dlg_list_sales2').dialog({title:'Pilih Sales'});
			$('#dlg_list_sales2').dialog('open');
		}
	}
}

//leads offensive
var totaloffensive=0;
function appendToSales3(com,grid)
{
    if (com=='Append to sales')
	{
		totaloffensive=$('.trSelected',grid).length
		if(totaloffensive>0) {
			var html='';
			$('.trSelected',grid).each(function(){
				html+='<input type="hidden" name="id[]" value="'+$(this).find('td:first div').html()+'" />';
			});
			$('#tampung_buat_cif3').html(html);
			$('#dlg_list_sales3 #form_input3').show();
			$('#dlg_list_sales3 #loading_box3').hide();
			$('#dlg_list_sales3').dialog({title:'Pilih Sales'});
			$('#dlg_list_sales3').dialog('open');
		}
	}
}

<?php if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG' || $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR' ) { ?>
$(document).ready(function(){
	$('#dlg_list_sales').dialog({
		autoOpen: false,
		height: 120,
		width: 400,
		modal: true,
		overlay: {
			backgroundColor: '#000',
			opacity: 1
		},
		buttons: {
			Submite:function(){
				$('#frm_append_sales').submit();
			},
			Cancel:function(){
				$(this).dialog('close');
			}
		},
		resizable: false
	});
	
	$('#dlg_list_sales2').dialog({
		autoOpen: false,
		height: 120,
		width: 400,
		modal: true,
		overlay: {
			backgroundColor: '#000',
			opacity: 1
		},
		buttons: {
			Submite:function(){
				$('#frm_append_sales2').submit();
			},
			Cancel:function(){
				$(this).dialog('close');
			}
		},
		resizable: false
	});
	
	$('#dlg_list_sales3').dialog({
		autoOpen: false,
		height: 120,
		width: 400,
		modal: true,
		overlay: {
			backgroundColor: '#000',
			opacity: 1
		},
		buttons: {
			Submite:function(){
				$('#frm_append_sales3').submit();
			},
			Cancel:function(){
				$(this).dialog('close');
			}
		},
		resizable: false
	});
	
	$('#frm_append_sales').submit(function(){
		
		if($('#frm_append_sales select').val()==''){
			alert('Harap pilih sales');
			$('#frm_append_sales select').focus();
		} else if(confirm('Assign '+totalPropensity+' data ke sales '+$('#frm_append_sales select').val()+'?')){
			$.ajax({
				type:'post',
				url:$('#frm_append_sales').attr('action'),
				beforeSend: function(){
					$('#dlg_list_sales #form_input').hide();
					$('#dlg_list_sales #loading_box').show();
					$('#dlg_list_sales').dialog({title:'Saving'});
				},
				cache: false,
				complete: function(){
					$('#dlg_list_sales').dialog('close');
					$("#leads_propensity").flexReload();
				},
				dataType:'json',
				data: $('#frm_append_sales').serialize(),
				success: function(data){
					if(!data.result){
						alert(data.msg);
					}
				}, 
				error : function (XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.responseText);
				}
			});
		}
		return false;
	});
	
	$('#frm_append_sales2').submit(function(){
		
		if($('#frm_append_sales2 select').val()==''){
			alert('Harap pilih sales');
			$('#frm_append_sales2 select').focus();
		} else if(confirm('Assign '+total500046+' data ke sales '+$('#frm_append_sales2 select').val()+'?')){
			$.ajax({
				type:'post',
				url:$('#frm_append_sales2').attr('action'),
				beforeSend: function(){
					$('#dlg_list_sales2 #form_input2').hide();
					$('#dlg_list_sales2 #loading_box2').show();
					$('#dlg_list_sales2').dialog({title:'Saving'});
				},
				cache: false,
				complete: function(){
					$('#dlg_list_sales2').dialog('close');
					$("#sales_tele").flexReload();
				},
				dataType:'json',
				data: $('#frm_append_sales2').serialize(),
				success: function(data){
					if(!data.result){
						alert(data.msg);
					}
				}, 
				error : function (XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.responseText);
				}
			});
		}
		return false;
	});
	
	$('#frm_append_sales3').submit(function(){
		
		if($('#frm_append_sales3 select').val()==''){
			alert('Harap pilih sales');
			$('#frm_append_sales3 select').focus();
		} else if(confirm('Assign '+totaloffensive+' data ke sales '+$('#frm_append_sales3 select').val()+'?')){
			$.ajax({
				type:'post',
				url:$('#frm_append_sales3').attr('action'),
				beforeSend: function(){
					$('#dlg_list_sales3 #form_input3').hide();
					$('#dlg_list_sales3 #loading_box3').show();
					$('#dlg_list_sales3').dialog({title:'Saving'});
				},
				cache: false,
				complete: function(){
					$('#dlg_list_sales3').dialog('close');
					$("#leads_offensive").flexReload();
				},
				dataType:'json',
				data: $('#frm_append_sales3').serialize(),
				success: function(data){
					if(!data.result){
						alert(data.msg);
					}
				}, 
				error : function (XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.responseText);
				}
			});
		}
		return false;
	});
});
<?php } ?>

</script>

	<?php if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG'|| $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR' ) { ?>
	<div id="dlg_list_sales" title="Pilih Sales" style="diplay:none">
		<div id="form_input">
		<form method="post" action="<?php echo site_url('sales_ajax/append_sales_propensity');?>" id="frm_append_sales">
			<select name="sales_id" style="width:100%;padding:2px 0px 2px 2px">
				<option value=""></option>
				<?php foreach($list_sales as $value=>$text) { ?>
				<option value="<?php echo $value;?>"><?php echo $text;?></option>
				<?php } ?>
			</select>
			<div id="tampung_buat_cif" style="display:none">
				<input type="hidden" name="id[]" value="" />
			</div>
			<input type="submit" style="display:none" value="Submit" />
		</form>
		</div>
		
		<div id="loading_box" style="display:none">
			<img src="<?php echo ICONS;?>loading_bar.gif" alt="Loading...." width="350" height="19" />
		</div>
	</div>
	<?php } ?>

	<?php if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG'|| $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR') { ?>
	<div id="dlg_list_sales2" title="Pilih Sales" style="diplay:none">
		<div id="form_input2">
		<form method="post" action="<?php echo site_url('sales_ajax/append_sales_500046');?>" id="frm_append_sales2">
			<select name="sales_id" style="width:100%;padding:2px 0px 2px 2px">
				<option value=""></option>
				<?php foreach($list_sales as $value=>$text) { ?>
				<option value="<?php echo $value;?>"><?php echo $text;?></option>
				<?php } ?>
			</select>
			<div id="tampung_buat_cif2" style="display:none">
				<input type="hidden" name="id[]" value="" />
			</div>
			<input type="submit" style="display:none" value="Submit" />
		</form>
		</div>
		
		<div id="loading_box2" style="display:none">
			<img src="<?php echo ICONS;?>loading_bar.gif" alt="Loading...." width="350" height="19" />
		</div>
	</div>
	<?php } ?>

	
	<?php if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG'|| $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR') { ?>
	<div id="dlg_list_sales3" title="Pilih Sales" style="diplay:none">
		<div id="form_input3">
		<form method="post" action="<?php echo site_url('sales_ajax/append_sales_offensive');?>" id="frm_append_sales3">
			<select name="sales_id" style="width:100%;padding:2px 0px 2px 2px">
				<option value=""></option>
				<?php foreach($list_sales as $value=>$text) { ?>
				<option value="<?php echo $value;?>"><?php echo $text;?></option>
				<?php } ?>
			</select>
			<div id="tampung_buat_cif3" style="display:none">
				<input type="hidden" name="id[]" value="" />
			</div>
			<input type="submit" style="display:none" value="Submit" />
		</form>
		</div>
		
		<div id="loading_box3" style="display:none">
			<img src="<?php echo ICONS;?>loading_bar.gif" alt="Loading...." width="350" height="19" />
		</div>
	</div>
	<?php } ?>
	
	<div class="ui-state-default ui-corner-all" style="padding:5px; margin-bottom:10px;">
    	<img src="<?php echo APP ?>" align="middle" /> LEADS MANAGEMENT
    </div>
    
    <div id="tabs">
        <ul>
            
            <!--<li><a href="#tabs-2">Customer Corporate</a></li>-->
            <?php 
			if($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID'] < 9||$_SESSION['SALES_ID'] >19)){
			?> 
			<li><a href="#tabs-7">Leads offensive</a></li>
            <li><a href="#tabs-6">Leads Propensity</a></li>
			<li><a href="#tabs-5">Leads 500046</a></li>
			<li><a href="#tabs-1">Leads Kelolaan</a></li>
			<li><a href="#tabs-3">Leads Prospek</a></li>
           <!-- <li><a href="#tabs-4">Prospek Corporate</a></li> -->
            <?php } 
			#BCS
			if($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID']==10||$_SESSION['SALES_ID']==11||$_SESSION['SALES_ID']==12||$_SESSION['SALES_ID']==15)){
			?> 
            <!--<li><a href="#tabs-6">Leads Propensity</a></li>
			<li><a href="#tabs-5">Leads 500046</a></li>
			<li><a href="#tabs-1">Leads Kelolaan</a></li>-->
			<li><a href="#tabs-3">Leads Prospek</a></li>
           <!-- <li><a href="#tabs-4">Prospek Corporate</a></li> -->
            <?php } ?>
			<!-- Tele Sales Inbound -->
			<?php 
			if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG' || $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR' ){
			?> 
			 <li><a href="#tabs-7">Leads offensive</a></li>
			 <li><a href="#tabs-6">Leads Propensity</a></li>
            <li><a href="#tabs-5">Leads 500046</a></li>
           <li><a href="#tabs-1">Leads Kelolaan</a></li>
           <!-- <li><a href="#tabs-4">Prospek Corporate</a></li> -->
            <?php } ?>
			
			
			
        </ul>
		<?php 
			if($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID'] < 9||$_SESSION['SALES_ID'] >19)){
		?> 
		<div id="tabs-7"><?php echo $js_grid_offensive; ?><table id="leads_offensive" style="display:none"></table></div>
		<div id="tabs-6"><?php echo $js_grid_propensity; ?><table id="leads_propensity" style="display:none"></table></div>
		<?php } ?>
       
<!--            <div id="tabs-2"><?php 	#echo $js_grid_corp; ?><table id="sales_corp_list" style="display:none"></table></div>-->    
	<?php 
			if($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID'] < 9||$_SESSION['SALES_ID'] >19)){
		?> 
        <div id="tabs-3"><?php echo $js_grid_ind_pros; ?><table id="sales_ind_pros_list" style="display:none"></table></div>
		 <div id="tabs-5"><?php echo $js_grid_tele1; ?><table id="sales_tele1" style="display:none"></table></div>
		 
		 <?php } 
		 #BCS 
		 if($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID']==10||$_SESSION['SALES_ID']==11||$_SESSION['SALES_ID']==12||$_SESSION['SALES_ID']==15)){
		?>    
        <div id="tabs-3"><?php echo $js_grid_ind_pros; ?><table id="sales_ind_pros_list" style="display:none"></table></div>
		<!-- <div id="tabs-5"><?php echo $js_grid_tele1; ?><table id="sales_tele1" style="display:none"></table></div>-->
		 
		 <?php } ?>
		<!--        <div id="tabs-4"><?php 	#echo $js_grid_corp_pros; ?><table id="sales_corp_pros_list" style="display:none"></table></div>-->    
		
			<!-- Leads 500046 -->
			<?php  
			if($_SESSION['USER_LEVEL']=='CABANG' || $_SESSION['USER_LEVEL']=='PEMIMPIN_CABANG' || $_SESSION['USER_LEVEL']=='PIMPINAN_CABANG' || $_SESSION['USER_LEVEL']=='SUPERVISOR' ){
		?> 
		<div id="tabs-7"><?php echo $js_grid_offensive; ?><table id="leads_offensive" style="display:none"></table></div>
		<div id="tabs-6"><?php echo $js_grid_propensity; ?><table id="leads_propensity" style="display:none"></table></div>
		<div id="tabs-5"><?php echo $js_grid_tele; ?><table id="sales_tele" style="display:none"></table></div>
		<div id="tabs-1"><?php echo $js_grid; ?><table id="sales_ind_list" style="display:none"></table></div>
<!--        <div id="tabs-4"><?php 	#echo $js_grid_corp_pros; ?><table id="sales_corp_pros_list" style="display:none"></table></div>
 -->    	<?php } 
			if(($_SESSION['USER_LEVEL']=='SALES' && ($_SESSION['SALES_ID'] < 9||$_SESSION['SALES_ID'] >19))||$_SESSION['USER_LEVEL']!='SALES'){
			?> 
		 <div id="tabs-1"><?php echo $js_grid; ?><table id="sales_ind_list" style="display:none"></table></div>
			<?php } ?>
		
    </div>
</div>

</td>
          </tr>
        </table>	
<script type="text/javascript">
$(function(){
	$( "#accordion" ).accordion({ active:<?php echo ($_SESSION['USER_LEVEL']=='SALES')? 3:2;?> });
});
</script>

<?php $this->load->view('default/footer') ?>
