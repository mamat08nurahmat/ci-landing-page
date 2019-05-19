<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
	
		//set tabbed windows
		
		$(function() { $("#tabs").tabs(); });
		//set numeric only in input box	
	
		//------------------------------------
		//	Button Action
		//------------------------------------		
		$('#submit').click(function(){
			getReport(0);	
		})
		
		$('#export').click(function(){
			getReport(1);			
		})
		
		$('#list').click(function(){
			getReport(2);			
		})
		
		$('#base').click(function(){
			getReport(4);			
		})
		
		function getReport(ex){
			var year = '<?php echo date('Y');?>';
			var bulan = '<?php echo date('n');?>';
			var month = $('#MONTH').val(); 
			var product =$('#PRODUCT').val();
			var tipe = $('#TIPE').val();
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			//var id = '24660';
			if(ex == 0){
				var urls = '<?php echo site_url('/report/get_nasabah_tab/')?>/'+id + '/' +month + '/' +product+ '/' +tipe;
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if ( ex == 1) {
				//var urls = '<?php echo site_url('/report/xls_nasabah/')?>/'+id + '/' +month; 
				//alert(urls);
				//$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>exporting data to xls, please be patient ... </span>");
				//window.location = urls;
				//$("#report").html("Silahkan isi periode report");
			} else if ( ex == 4) {
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
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">NASABAH KELOLAAN</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
			  <td align="left">
                    <select name='TIPE' id='TIPE'>
                    	<option value="0">CR</option>
                        <option value="1">BB</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                    </td>
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
                <td>
                	<select name='MONTH' id='MONTH'>
                    	<option value="0">Yesterday All</option>
                        <option value="1">Last Month All</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                </td> 
                <td><input name="submit" id="submit" type="button" value="Generate"></td>
                <!--td><input name="export" id="export" type="button" value="Export to XLS"--></td>
				<td><input name="list" id="list" type="button" value="CIF Nasabah Kelolaan"></td>
				<td><input name="base" id="base" type="button" value="Baseline Kelolaan"></td>
              </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan isi periode report</div>
         </div>
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