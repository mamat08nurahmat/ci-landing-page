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
			var month 	= $('#MONTH').val(); 
			var year 	= $('#YEAR').val(); 
			var id 		= $('#BRANCH').val();
			//var id = '24660';
			if(ex == 0){
				var urls = '<?php echo site_url('/report/get_incentive/')?>/'+id + '/' + month + '/' +year; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else {
				var urls = '<?php echo site_url('/report/xls_incentive/')?>/'+id + '/' + month + '/' +year; 
				//alert(urls);
				window.location = urls;
			}
		}
		
	});
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">INSENTIF SALES</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
                    <td align="left">Cabang</td>
                    <td>:</td>
                    <td align="left">
                    	<select name="BRANCH" id="BRANCH">
                    	<?php 
							if(isset($cabang))
							{
								$branch = $this->session->userdata('BRANCH_ID');
								foreach($cabang as $row)
								{
									$selected = ($branch == $row->ID)?'selected':'';
									echo "<option value='".$row->BRANCH_CODE."' $selected>".$row->BRANCH_NAME."</option>\n";
								}
							}
						?>
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
                	<td colspan='2'>&nbsp;</td>
                	<td><input name="submit" id="submit" type="button" value="Generate"> &nbsp; <input name="export" id="export" type="button" value="Export to XLS"></td>
                </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan isi cabang & periode report</div>
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