<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<?php $type =  (isset($type))?$type:0; ?>

<script type="text/javascript">

function killsession(npp)
		{
			alert(npp);
			var urls = '<?php echo site_url('/report/delete_aktif/')?>/'+npp;
			var urls2 = '<?php echo site_url('/report/getaktif/')?>/';
			$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
			$("#report").load(urls)
			$("#report").load(urls2)
		}

	$(function() {
	
		//set tabbed windows
		
		$(function() { $("#tabs").tabs(); });
		//set numeric only in input box	
	
		
		$('#list').click(function(){
			getReport(0);	
		})
		
		$('#export').click(function(){
			getReport(1);			
		})
		
		$('#newlist').click(function(){
			getReport(2);			
		})
		
		
		function getReport(ex){
		
			var msg = '';
			//var id = '<?php echo $this->session->userdata('ID'); ?>';
			var branch 		= '<?php echo $this->session->userdata('BRANCH_ID'); ?>';
	
				if(ex == 0){
					var urls = '<?php echo site_url('/report/getnonaktifwil/')?>/'+branch;
					//alert(urls);
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls)
				}else if(ex == 2){
					var urls = '<?php echo site_url('/report/getaktif/')?>/';
					//alert(urls);
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls)
				} else {
					var urls = '<?php echo site_url('/report/xlsnonaktif/')?>'; 
					//alert(urls);
					window.location = urls;
				}
			
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>

            <li><a href="#tabs-1">REPORT USER</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
                <td><input name="list" id="list" type="button" value="Generate Report User Non Active"></td>
               <!--  <td><input name="export" id="export" type="button" value="Export to XLS User Non Active"></td>
				  <td><input name="newlist" id="newlist" type="button" value="List User Currently Online"></td>
              -->
			  </tr>
            </table>
            </form>
            <br />
			 <div id='report'></div>
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