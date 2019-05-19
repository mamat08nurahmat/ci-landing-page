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
	
				var wil 	= $('#WILAYAH').val(); 
				var branch 		= $('#CABANG').val(); 
				if(ex == 0){
					var urls = '<?php echo site_url('/report/getnonaktif/')?>/'+wil+'/'+branch;
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

            <li><a href="#tabs-1">REPORT USER NON ACTIVE</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
			<?php if($this->session->userdata('USER_LEVEL')=='WILAYAH' ||$this->session->userdata('USER_LEVEL')=='PIMPINAN_WILAYAH')
					{
					?>
					<input type="hidden" name="WILAYAH" id="WILAYAH" value="<?php echo $this->session->userdata('REGION');?>">
					 <tr>
                    <td align="left">CABANG :</td>
                    <td style="margin-left:80px;";>
					<select name="CABANG" id="CABANG" onfocus="changeWilayah(WILAYAH.value)">
						<option value="0">ALL CABANG</option>
						</select></td>
					</tr>
					<?php
					}else if($this->session->userdata('USER_LEVEL')=='CABANG' ||$this->session->userdata('USER_LEVEL')=='PIMPINAN_CABANG')
					{
					?>
					<input type="hidden" name="WILAYAH" id="WILAYAH" value="<?php echo $this->session->userdata('REGION');?>">
					<input type="hidden" name="CABANG" id="CABANG" value="<?php echo $this->session->userdata('BRANCH_ID');?>">
			<?php }else if($this->session->userdata('USER_LEVEL')=='ADMIN' || $this->session->userdata('USER_LEVEL')=='SLN')
			{?>
			<tr>
                    <td align="left">WILAYAH :</td>
                    <td style="margin-left:80px;";>
                    	<select name="WILAYAH" id="WILAYAH" onchange="changeWilayah(this.value)">
										<option value="0">ALL WILAYAH</option>
										<?php foreach($list_wilayah as $row) { ?>
										<option value="<?php echo $row->REGION_CODE;?>"><?php echo $row->REGION_NAME;?></option>
										<?php } ?>
									</select>
                    </td>
              </tr>
			  <tr>
                    <td align="left">CABANG :</td>
                    <td style="margin-left:80px;";>
					<select name="CABANG" id="CABANG">
						<option value="0">ALL CABANG</option>
						</select></td>
				</tr>
              <tr>
				<?php } ?>
			   <td><input name="list" id="list" type="button" value="Generate Report"></td>
                 <!--<td><input name="export" id="export" type="button" value="Export to XLS User Non Active"></td>-->
				 <?php if($this->session->userdata('USER_LEVEL')=='ADMIN' || $this->session->userdata('USER_LEVEL')=='SLN' || $this->session->userdata('USER_LEVEL')=='USERMGT'){ ?>
				  <td><input name="newlist" id="newlist" type="button" value="List User Currently Online"></td>
				<?php }?>
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

var list_cabang=<?php echo json_encode($list_cabang);?>;

function changeWilayah(v){
	var html='<option value="0">ALL CABANG</option>';
	if(v){
		var obj='CAT_'+v;
		if(typeof(list_cabang[obj])!='undefined'){
			$.each(list_cabang[obj], function (i, itm){
				html+='<option value="'+itm.value+'">'+itm.innerHTML+'</option>';
			});
		}
	}
	
	$('#CABANG').html(html);
}

<?php 
	$level 	= $_SESSION['USER_LEVEL'];
	$i		= 1;
	$html 	= "\$(function(){\$( '#accordion' ).accordion({ active:$i});});";
	echo $html;
?>	
</script>

<?php $this->load->view('default/footer') ?>