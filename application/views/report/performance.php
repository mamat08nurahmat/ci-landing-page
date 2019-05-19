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
		
		$('#oldperformance').click(function(){
			getReport(2);			
		})
		
		function getReport(ex){
			var month 	= $('#MONTH').val(); 
			var year 	= $('#YEAR').val(); 
			var id 		= '<?php echo $this->session->userdata('ID'); ?>';
			var salestype= '<?php echo $_SESSION['SALES_TYPE'];?>';
			//var id = '24660';
			if(ex == 0){
				if(year>=2017&&(salestype=='ANALIS PENJUALAN CR'||salestype=='ASISTEN PENJUALAN'))
					{
						var urls = '<?php echo site_url('/report/get_performance_new/')?>/'+id + '/' + month + '/' +year; 
					}
					else if(year>=2017&&month>=2&&(salestype=='SRM'||salestype=='CRO MGR'||salestype=='CRO AMGR'))
					{
						var urls = '<?php echo site_url('/report/get_performance_new/')?>/'+id + '/' + month + '/' +year; 
					}
					else if(year==2017&&month==1&&(salestype=='SRM'||salestype=='CRO MGR'||salestype=='CRO AMGR'))
					{
						var urls = '<?php echo site_url('/report/get_performance/')?>/'+id + '/' + month + '/' +year; 
					}
					else
					{
						var urls = '<?php echo site_url('/report/get_performance/')?>/'+id + '/' + month + '/' +year; 
					} 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if (ex == 1){
				var urls = '<?php echo site_url('/report/xls_performance/')?>/'+id + '/' + month + '/' +year; 
				//alert(urls);
				window.location = urls;
			} else {
				var urls = '<?php echo 'http://brftst.bni.co.id/sapm_prod/index.php/report/performance'?>'; 
				//alert(urls);
				window.location = urls;
			}
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">PERFORMANCE REPORT</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
                    <td align="left">Tahun</td>
                    <td>:</td>
                    <td align="left">
                    	<select name="YEAR" id="YEAR" onchange="get_month(this.value)">
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
                	<td colspan='2'>&nbsp;</td>
                	<td><input name="submit" id="submit" type="button" value="Generate"> &nbsp; 
					<!--input name="export" id="export" type="button" value="Export to XLS"> &nbsp;
					<input name="oldperformance" id="oldperformance" type="button" value="Performance Jan-Jul 2015"--></td>
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
function get_month(v){
	 var bulan = {	'1':'Januari', '2':'Februari', '3':'Maret', '4':'April',
                                        '5':'Mei', '6':'Juni', '7':'Juli', '8':'Agustus',
                                        '9':'September', '10':'Oktober', '11':'November', '12':'Desember'};
	var html='';
	if(v==2015){
			for(x=8;x<=12;x++)
			{
				html+='<option value="'+x+'">'+bulan[x]+'</option>';
			}
		}
	else if(v>=2016){
			for(x=1;x<=12;x++)
			{
				html+='<option value="'+x+'">'+bulan[x]+'</option>';
			}
		}
	
	$('#MONTH').html(html);
}	
<?php 
	$level 	= $_SESSION['USER_LEVEL'];
	$i		= 1;
	$html 	= "\$(function(){\$( '#accordion' ).accordion({ active:$i});});";
	echo $html;
?>
</script>
<?php $this->load->view('default/footer') ?>