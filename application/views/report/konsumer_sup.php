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
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			//var id = '24660';
			if(ex == 0){
				var urls = '<?php echo site_url('/report/get_nasabah_konsumer/')?>/'+id + '/' +month; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if ( ex == 1) {
				//var urls = '<?php echo site_url('/report/xls_konsumer/')?>/'+id + '/' +month; 
				//alert(urls);
				//$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>exporting data to xls, please be patient ... </span>");
				//window.location = urls;
				//$("#report").html("Silahkan isi periode report");
			}else if ( ex == 4) {
				var urls = '<?php echo site_url('/report/get_baseline/')?>/'+id + '/' +year + '/' +bulan; 
				//alert(urls);
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} 
			else {
				var urls = '<?php echo site_url('/report/get_list_nasabah/')?>/'+id; 
				//alert(urls);
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
				//window.location = urls;
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
            <li><a href="#tabs-1">NASABAH KREDIT KONSUMTIF</a></li>
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
                    <td align="left">PERIODE</td>
                    <td>:</td>
                    <td align="left">
                    <select name='MONTH' id='MONTH'>
                    	<option value="0">Yesterday All</option>
                        <option value="1">Last Month All</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td colspan='2'>&nbsp;</td>
                	<td><input name="submit" id="submit" type="button" value="Generate"> &nbsp; 
					<!--input name="export" id="export" type="button" value="Export to XLS"-->&nbsp;
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