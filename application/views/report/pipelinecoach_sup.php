<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
	
		//-------------------------------------
		//	Set active tabbed window
		//-------------------------------------		
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
			var id = '<?php echo $id = ($this->session->userdata('USER_LEVEL')=='SALES')?$this->session->userdata('ID'):0; ?>';
			var sourcedata=$('#SOURCEDATA').val();
			
			if( id!=0 ) { id = id; }
			else id = $('#ID').val();
			
			var msg = '';
			if(id == 0) {msg += 'NPP tidak boleh kosong \n';}
			if(ex == 0){
				var urls = '<?php echo site_url('/report/getRealisasi/')?>/'+id + '/' +month+'/'+year; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else {
				var urls = '<?php echo site_url('/report/xlsPipelineCoach/')?>/'+id + '/' +sourcedata + '/' +month+'/'+year; 
				//alert(urls);
				window.location = urls;
			}
		}
		
	
	//------------------------------------------------
	//	Choose SALES ID from dialog box if clicked
	//------------------------------------------------
	<?php if(! isset($data)){ ?>
		$('#ID').click(function(){			
			$('#search').dialog('open');
			//$('select').hide();
		});	
		$('#USER_NAME').click(function(){			
			$('#search').dialog('open');
			//$('select').hide();
		});			
	<?php } ?>
	
	//------------------------------
	//	Search jQuery Dialog Box
	//------------------------------ a
	$("#search").dialog({
		width		: 500,
		height		: 550,
		modal		: true,
		autoOpen	: false,
		buttons		: {'Close'	: function(){$(this).dialog('close'); $('select').show();} }
	});
	
	//------------------------------------
	//	Show all select if dialog close
	//------------------------------------
	$( "#search" ).dialog({
  	 	close: function(event, ui) { $('select').show(); }
	});
	
});


//-------------------------------------
//	Choose SALES ID from dialog box
//-------------------------------------
function pilih_data(com,grid)
	{
		if (com=='Pilih')
			{
			   if($('.trSelected',grid).length>0 && $('.trSelected',grid).length<2) {
					// to provide value in ie 6 suck
					var arrData = getSelectedRow();
					var nama = arrData[0][1].toUpperCase();
					$('#ID').val(arrData[0][0]);
					$('#USER_NAME').val(nama);
					$('#SALES_TYPE').val(arrData[0][2]);
					$('#search').dialog('close');
				}  else { alert('Pilih satu data saja !'); }	
			}          
	}
				
function getSelectedRow() {
	var arrReturn   = [];
	$('.trSelected').each(function() {
			var arrRow              = [];
			$(this).find('div').each(function() {
					arrRow.push( $(this).html() );
			});
			arrReturn.push(arrRow);
	});
	return arrReturn;
}

	
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">REPORT WORKSHEET PIPELINE </a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">
              <tr>
              	<td align="left">NPP</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="ID" id="ID" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
              	
              <tr>
                <td align="left">NAMA</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="USER_NAME" id="USER_NAME" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
              <tr>
              	<td align="left">SALES TYPE</td>
                <td>:</td>
              	<td colspan="4">
                	<input name="SALES_TYPE" id="SALES_TYPE" type="text" size="20" readonly="readonly" class="input">
                </td>
              </tr>
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
                        </select>
                    </td>
                </tr>
              <tr>
                    <td align="left">TAHUN</td>
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
                <tr>
                	<td colspan='2'>&nbsp;</td>
                	<td><!--<input name="submit" id="submit" type="button" value="Generate"> &nbsp; --><input name="export" id="export" type="button" value="Export"></td>
                </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan pilih tahun dan bulan report</div>
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