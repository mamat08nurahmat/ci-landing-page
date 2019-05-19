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
			var month 	= $('#MONTH').val(); 
			var year 	= $('#YEAR').val(); 
			var id = $('#ID').val();
			var salestype= $('#salestypeid').val();
			var msg = '';
			if($('#ID').val() == '') {msg += 'NPP tidak boleh kosong \n';}
					
			if(msg){alert(msg); return false;}
			else { 
				if(ex == 0){
					if(year>=2017&&(salestype=='ANALIS PENJUALAN CR'||salestype=='ASISTEN PENJUALAN'||salestype=='SRM'||salestype=='CRO MGR'||salestype=='CRO AMGR'))
					{
						var urls = '<?php echo site_url('/report/get_performance_new/')?>/'+id + '/' + month + '/' +year; 
					}
					else
					{
						var urls = '<?php echo site_url('/report/get_performance/')?>/'+id + '/' + month + '/' +year; 
					}
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls)
				} else {
					var urls = '<?php echo site_url('/report/xls_performance/')?>/'+id + '/' + month + '/' +year; 
					//alert(urls);
					window.location = urls;
				}
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
	//------------------------------
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

function get_sales()
{
	var id = <?php echo $_SESSION['BRANCH_ID']?>;
	var urls = '<?php echo site_url('/report/get_sales_ajax/')?>/'+$('#PENYELIA').val()+'/'+id; 
	$('#sales').load(urls);
}

function get_salestype()
{
	var id = $('#ID').val();
	var urls = '<?php echo site_url('/report/get_salestype_ajax/')?>/'+id; 
	$('#salestype').load(urls);
}
	
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">REPORT PERFORMANCE</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0">
              <tr>
              	<td align="left">PENYELIA</td>
                <td>:</td>
              	<td colspan="4">
                	<?php echo form_dropdown('PENYELIA', array('Pilih Penyelia',$penyelia), 'Pilih', "id='PENYELIA' onChange='get_sales()'"); ?>				
                </td>
              </tr> 
			  <tr>
              	<td align="left">SALES</td>
                <td>:</td>
              	<td colspan="4">
                	<div id='sales'>
						<?php echo form_dropdown('SALES', array('Pilih Penyelia Dahulu',null),'', "id='ID'"); ?>
					</div>
                </td>
              </tr> 
			  <div id='salestype'></div>
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
                	<td><input name="submit" id="submit" type="button" value="Generate"> &nbsp; <!--input name="export" id="export" type="button" value="Export to XLS"--></td>
                </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan pilih sales untuk mengenerate report</div>
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