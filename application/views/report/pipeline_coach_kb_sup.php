<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
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
			getReport(1);			
		})
		//--------------------------------------------
		//	Function to get ajax content of report
		//--------------------------------------------
		function getReport(ex){
			var year 	= $('#YEAR').val(); 
			var month 	= $('#MONTH').val(); 
			var wil 	= $('#WILAYAH').val(); 
				if(ex == 0){
					var urls = '<?php echo $url_data ?>/'+ month +'/'+year+'/'+wil;
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls)
				} else {
					var urls = '<?php echo site_url('/report/xlsPipelineCoachKbSum/')?>/' +month+'/'+year;
					window.location = urls;
				}
		}
});
</script>

<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">REPORT WORKSHEET PIPELINE<?php echo strtoupper($rpt_name); ?></a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">              	
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
                    <td align="left">BULAN</td>
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
				<!--
				<tr>
                    <td align="left">WILAYAH</td>
                    <td>:</td>
                    <td align="left">
                    	<?php
							$lvl = array('SLN', 'DIVISI', 'TIM');
							if( in_array($this->session->userdata('USER_LEVEL'),$lvl) )
								echo form_dropdown('WILAYAH',$this->_report->get_wilayah(), '', 'id="WILAYAH"'); 
							else { 
								echo "<input name='WILAYAH' id='WILAYAH' type='hidden' value='0' />"; 
								echo $this->session->userdata('REGION');
								}
						?>
                    </td>
              </tr>-->
				<?php
					
				?>
                <tr>
                	<td colspan='2'>&nbsp;</td>
                	<td><!-- <input name="submit" id="submit" type="button" value="Generate"> --> <input name="export" id="export" type="button" value="Export"></td>
                </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan pilih tahun dan bulan untuk mengenerate report</div>
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