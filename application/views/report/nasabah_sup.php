<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
	
		//-------------------------------------
		//	Set active tabbed window
		//-------------------------------------		
		$(function() { $("#tabs").tabs(); });
				
		//-------------------------------------
		//	Set action if submit 
		//-------------------------------------
		$('#submit').click(function(){
			getReport(0);	
		})
		
		//-------------------------------------
		//	Set action if export 
		//-------------------------------------
		$('#export').click(function(){
			$('#report_msg').html("<img src='<?php echo LOAD ?>' alt='loading'> <span style='color:#080'>exporting report ...</span>");
			getReport(1);	
			$('#report_msg').html("<span style='color:#080'>Silahkan pilih sales untuk mengenerate report</span>");		
		})
		
		//-------------------------------------
		//	Set action if List Nasabah Kelolaan 
		//-------------------------------------
		$('#list').click(function(){
			getReport(2);	
		})
		
		$('#base').click(function(){
			getReport(4);			
		})
		
		//--------------------------------------------
		//	Function to get ajax content of report
		//--------------------------------------------
		function getReport(ex){
			var year = '<?php echo date('Y');?>';
			var bulan = '<?php echo date('n');?>';
			var month = $('#MONTH').val(); 
			var product =$('#PRODUCT').val();
			var tipe = $('#TIPE').val();
			var id = $('#ID').val();
			var msg = '';
			if($('#ID').val() == '') {msg += 'NPP tidak boleh kosong \n';}
					
			if(msg){alert(msg); return false;}
			else { 
				if(ex == 0){
					var urls = '<?php echo site_url('/report/get_nasabah_tab/')?>/'+id + '/' +month + '/' +product+ '/' +tipe; 
					$("#report_msg").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report_msg").load(urls)
				} else if (ex == 1) {
					//var urls = '<?php echo site_url('/report/xls_nasabah/')?>/'+id + '/' +month; 
					//alert(urls);
					//window.location = urls;
				} else if ( ex == 4) {
				var urls = '<?php echo site_url('/report/get_baseline/')?>/'+id + '/' +year + '/' +bulan; 
				//alert(urls);
				$("#report_msg").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report_msg").load(urls)
				} 
				else {
					var urls = '<?php echo site_url('/report/get_list_nasabah/')?>/'+id; 
					$("#report_msg").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report_msg").load(urls)
				}
			}
		}
		
	
	//------------------------------------------------
	//	Choose SALES ID from dialog box if clicked
	//------------------------------------------------
	<?php if(! isset($data)){ ?>
		$('#ID').click(function(){			
			$('#search').dialog('open');
			//$('select').hide();
		});	
		$('#USER_NAME').click(function(){			
			$('#search').dialog('open');
			//$('select').hide();
		});			
	<?php } ?>
	
	//------------------------------
	//	Search jQuery Dialog Box
	//------------------------------
	$("#search").dialog({
		width		: 500,
		height		: 550,
		modal		: true,
		autoOpen	: false,
		buttons		: {'Close'	: function(){$(this).dialog('close'); $('select').show();} }
	});

	//------------------------------------
	//	Show all select if dialog close
	//------------------------------------
	$( "#search" ).dialog({
  	 	close: function(event, ui) { $('select').show(); }
	});
	
});


//-------------------------------------
//	Choose SALES ID from dialog box
//-------------------------------------
function pilih_data(com,grid)
	{
		if (com=='Pilih')
			{
			   if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
					// to provide value in ie 6 suck
					var arrData = getSelectedRow();
					var nama = arrData[0][1].toUpperCase();
					$('#ID').val(arrData[0][0]);
					$('#USER_NAME').val(nama);
					$('#SALES_TYPE').val(arrData[0][2]);
					$('#search').dialog('close');
				}  else { alert('Pilih satu data saja !'); }	
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

	
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">NASABAH KELOLAAN</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">
              <tr>
              	<td align="left">NPP</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="ID" id="ID" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
              	
              <tr>
                <td align="left">NAMA</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="USER_NAME" id="USER_NAME" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
              <tr>
              	<td align="left">SALES TYPE</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="SALES_TYPE" id="SALES_TYPE" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
			   <tr>
                    <td align="left">CUST TIPE</td>
                    <td>:</td>
                    <td align="left">
                    <select name='TIPE' id='TIPE'>
                    	<option value="0">CR</option>
                        <option value="1">BB</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                    </td>
                </tr>
				<tr>
                    <td align="left">PRODUCT</td>
                    <td>:</td>
                    <td align="left">
                    <select name='PRODUCT' id='PRODUCT'>
                    	<option value="1">Giro</option>
                        <option value="2">Tabungan</option>
						<option value="3">Deposito</option>
						<option value="4">Investasi</option>
						<option value="5">Bancas</option>
						<option value="6">AUM</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                    </td>
                </tr>
              <tr>
                    <td align="left">PERIODE</td>
                    <td>:</td>
                    <td align="left">
                    <select name='MONTH' id='MONTH'>
                    	<option value="0">Yesterday All</option>
                        <option value="1">Last Month All</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                    </td>
                </tr>
                <tr>
                	<td colspan='2'>&nbsp;</td>
                	<td><input name="submit" id="submit" type="button" value="Generate"> &nbsp; 
					<!--input name="export" id="export" type="button" value="Export to XLS"-->&nbsp;
					<input name="list" id="list" type="button" value="List CIF Nasabah Kelolaan">
					<input name="base" id="base" type="button" value="Baseline Kelolaan"></td>
                </tr>
            </table>
            </form>
            <br />
            <div id='report_msg'>Silahkan pilih sales untuk mengenerate report</div>
         </div>
	</div>
    
    <div id="search" title="SALES DATA">
		<?php echo $js_grid; ?><table id="search_list" style="display:none"></table>
    </div>

</div><!-- close div content -->

</td>
</tr>
</table>
<script type="text/javascript">
<?php 
	$level 	= $_SESSION['USER_LEVEL'];
	$i		= 1;
	$html 	= "\$(function(){\$( '#accordion' ).accordion({ active:$i});});";
	echo $html;
?>
</script>
<?php $this->load->view('default/footer') ?>