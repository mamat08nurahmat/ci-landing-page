<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<?php $type =  (isset($type))?$type:0; ?>

<script type="text/javascript">
	$(function() {
	
		//set tabbed windows
		
		$(function() { $("#tabs").tabs(); });
		//set numeric only in input box	
	
		$("#START").datepicker({
			showOn: 'button',
			buttonImage: '<?php echo ICONS ?>calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true
		});
		$('#START').datepicker('option', {dateFormat: 'd-M-yy'});
		
		$("#END").datepicker({
			showOn: 'button',
			buttonImage: '<?php echo ICONS ?>calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true
		});
		$('#END').datepicker('option', {dateFormat: 'd-M-yy'});
		
		$('#submit').click(function(){
			getReport(0);	
		})
		
		$('#export').click(function(){
			getReport(1);			
		})
		
		function getReport(ex){
			var start = $('#START').val(); 
			var end = $('#END').val(); 
			var msg = '';
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			if(start == '') {msg += 'Tanggal mulai tidak boleh kosong \n';}
			if(end == ''){msg +='Tanggal akhir tidak boleh kosong';}
					
			if(msg){alert(msg); return false;}
			else {
				if(ex == 0){
					var urls = '<?php echo site_url('/report/getActivity/')?>/'+id + '/<?php echo $type ?>/' +start+'/'+end; 
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls)
				} else {
					var urls = '<?php echo site_url('/report/xlsActivity/')?>/'+id + '/<?php echo $type ?>/' +start+'/'+end; 
					//alert(urls);
					window.location = urls;
				}
			}
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
        	<?php 
				$ket = '';
				if($type == 0) $ket = '';
				if($type == 1) $ket = ' SUDAH REALISASI';
				if($type == 2) $ket = ' BELUM REALISASI';
			?>
            <li><a href="#tabs-1">AKTIVITAS HARIAN<?php echo $ket; ?></a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
                <td>from <input name="START" id="START" type="text" size="20"></td>
                <td>to <input name="END" id="END" type="text" size="20"></td>
                <td><input name="submit" id="submit" type="button" value="Generate"></td>
                 <td><input name="export" id="export" type="button" value="Export to XLS"></td>
              </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan isi range periode report</div>
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