<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
		//-----------------------------
		//	Set Active menu and tabs
		//-----------------------------
		$(function() { $("#tabs").tabs(); });
		
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
			var sourcedata=$('#SOURCEDATA').val();
			
			if(ex == 0){
				var urls = '<?php echo site_url('/report/getRealisasi/')?>/'+id + '/' +month+'/'+year; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if(ex==1){
				var urls = '<?php echo site_url('/report/xlsPipelineCoach/')?>/'+id + '/' +sourcedata + '/' +month+'/'+year; 
				//alert(urls);
				window.location = urls;
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
            <li><a href="#tabs-1">REPORT WORKSHEET SALES PIPELINE</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">              	
			    <tr>
                    <td align="left">Sumber Lead</td>
                    <td>:</td>
                    <td align="left">
                    	<select name="SOURCEDATA" id="SOURCEDATA">
								<option value=0>All Leads</option>
								<option value=1>Leads Kelolaan</option>
								<option value=2>Leads Prospek</option>
								<option value=3>Leads 500046</option>
								<option value=4>Leads Propensity</option>
								<option value=5>Account Plan</option>
                        </select>
                    </td>
                </tr>
			   <tr>
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
                    </td>
                </tr>
                <tr>
                	<td colspan='2' style="width:100px;">&nbsp;</td>
                	<td style="width:400px"><input name="export" id="export" type="button" value="Export"> 
                </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan pilih tahun dan bulan sales pipeline</div>
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
