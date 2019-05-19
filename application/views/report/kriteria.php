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
		
		function getReport(ex){
			var segment = $('#SEGMENT').val(); 
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			//var id = '24660';
			
			if(ex == 0){
				var urls = '<?php echo site_url('/report/get_kriteria_bisnis/')?>/' +segment; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else {
				var urls = '<?php echo site_url('/report/xls_kriteria_bisnis/')?>/' +segment; 
				//alert(urls);
				window.location = urls;
			}
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">REPORT KRITERIA BISNIS</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
                <td>
                	<select name='SEGMENT' id='SEGMENT'>
                    	<?php 
							if($segment)
							{
								$n = 1;
								foreach($segment as $row)
								{
									echo " <option value='".$n++."'>".$row->SEGMENT."</option>\n";	
								}
							};
						?>
                    </select>
                </td> 
                <td><input name="submit" id="submit" type="button" value="Generate"></td>
                <td><input name="export" id="export" type="button" value="Export to XLS"></td>
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