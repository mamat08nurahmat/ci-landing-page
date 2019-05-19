<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
		//-----------------------------
		//	Set Active menu and tabs
		//-----------------------------
		$(function() { $("#tabs").tabs(); });
		
		//-------------------------------------
		//	Set datepicker
		//-------------------------------------	
		$("#START").datepicker({
			//showOn: 'button',
			//buttonImage: '<?php echo ICONS ?>calendar.gif',
			//buttonImageOnly: true,
			changeMonth: true,
			changeYear: true
		});
		$('#START').datepicker('option', {dateFormat: 'd-M-yy'});
		
		$("#END").datepicker({
			//showOn: 'button',
			//buttonImage: '<?php echo ICONS ?>calendar.gif',
			//buttonImageOnly: true,
			changeMonth: true,
			changeYear: true
		});
		$('#END').datepicker('option', {dateFormat: 'd-M-yy'});
		
		//---------------------------
		//	Action on click
		//---------------------------
		$('#submit').click(function(){
			getReport(0);	
		})
		
		$('#export').click(function(){
			getReport(1);			
		})
		
		$('#pdf').click(function(){
			getReport(2);
		})
		
		function getReport(ex){
			var year 	= $('#YEAR').val(); 
			var month 	= $('#MONTH').val(); 
			var msg 	= '';
			var id 		= '<?php echo $this->session->userdata('ID'); ?>';
			var wil 	= $('#WILAYAH').val(); 
			var branch 		= $('#CABANG').val(); 
			var start = $('#START').val(); 
			var end = $('#END').val();

			if(start == '') {msg += 'Tanggal mulai tidak boleh kosong \n';}
			if(end == ''){msg +='Tanggal akhir tidak boleh kosong';}
			
			if(ex == 0){
				var urls = '<?php echo site_url('/report/gettotallogin/')?>/'+wil+ '/'+branch+'/' +start+'/'+end; 
				//alert(urls);
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if(ex==1){
				var urls = '<?php echo site_url('/report/xlsPipelineCoachRegion/')?>/'+branch + '/' +month+'/'+year; 
				alert(urls);
				//window.location = urls;
			} else {
				var urls = '<?php echo 'http://brftst.bni.co.id/sapm_prod/pdf_report/realisasi_report.php?npp='?>'+id+'&m='+month;
				window.location = urls;
			}
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">REPORT USER AKTIF</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">              	
                <!--<tr>
                   <td align="left">Tahun</td>
                    <td>:</td>
                    <td align="left">
                    	<select name="YEAR" id="YEAR">
                    	<?php 
							$date = getdate(strtotime(NOW));
							$year = $date['year'];
							for($i=($year-1);$i<=$year;$i++)
							{
								$selected = ($i == $year)?'selected':'';
								echo "<option value='$i' $selected>$i</option>\n";
							}
						?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="left">Bulan</td>
                    <td>:</td>
                    <td align="left">
                    <?php 
                        $bulan = array(	'1'=>'Januari', '2'=>'Februari', '3'=>'Maret', '4'=>'April',
                                        '5'=>'Mei', '6'=>'Juni', '7'=>'Juli', '8'=>'Agustus',
                                        '9'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember');
                        $html  = '';
                        $html .= "<select name='MONTH' id='MONTH' style='width:110px'>";
                        for($i=1;$i<=12;$i++)
                        {
                            $html .= "<option value='$i'>".$bulan[$i]."</option>"; 	
                        }
                        $html .= "</select>";
                        echo $html;
                    ?>
                    </td>-->
					<?php if($this->session->userdata('USER_LEVEL')=='WILAYAH' ||$this->session->userdata('USER_LEVEL')=='PIMPINAN_WILAYAH')
					{
					?>
					<input type="hidden" name="WILAYAH" id="WILAYAH" value="<?php echo $this->session->userdata('REGION');?>" >
					<tr>
                    <td align="left">CABANG :</td>
                    <td colspan="2" style="margin-left:80px;";>
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
					<?php
					}else if($this->session->userdata('USER_LEVEL')=='ADMIN' || $this->session->userdata('USER_LEVEL')=='SLN') {?>
					<tr>
                    <td align="left">WILAYAH :</td>
                    <td colspan="2" style="margin-left:80px;";>
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
                    <td colspan="2" style="margin-left:80px;";>
					<select name="CABANG" id="CABANG">
						<option value="0">ALL CABANG</option>
						</select></td>
				</tr>
				<?php } ?>
				<tr>
					<td align="left">PERIODE : </td>
					<td>&nbsp; <input name="START" id="START" type="text" size="20" readonly="readonly" class="input"></td>
					<td>to <input name="END" id="END" type="text" size="20" readonly="readonly" class="input"></td>
                </tr>
                <tr>
                	<td colspan='3' ><input style="margin-left:75px"; name="submit" id="submit" type="button" value="Generate Report"></td>
                	<td>
					</td>
					<!--<input name="export" id="export" type="button" value="Export">-->
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
