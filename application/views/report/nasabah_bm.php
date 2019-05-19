<?php $this->load->view('default/header') ?>	
<td  valign="top" align="left">

<script type="text/javascript">
	$(function() {
		$(".popup").click(function(){
				dialog.dialog("open");
			});
			
		$('#simpan').click(function(){
			//if(validation() != ''){ alert(validation()); }
				//else
				 $("#frmCustomer").submit();
		});
		
		$("#ket").hide();
		//set tabbed windows
		$( "#dialog" ).dialog({
			autoOpen :false,
			modal : true,
				height: 200,
				width: 370,
			buttons: {
			Simpan:function(){
				$('#frmCustomer').submit();
			},
			Cancel:function(){
				$(this).dialog('close');
			}
		},
		});
		
		$('#frmCustomer').submit(function(){
			var year = '<?php echo date('Y');?>';
			var bulan = '<?php echo date('n');?>';
			var month = $('#MONTH').val(); 
			var tipe = $('#TIPE').val();
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			//var id = 34359;
			//var id = '24660';
				var urls = '<?php echo site_url('/report/get_nasabah_bm_tab/')?>/'+id + '/' +month + '/' +tipe; 
			$.ajax({
				type:'post',
				url:$('#frmCustomer').attr('action'),
				beforeSend: function(){
					$('#dialog #form_input').hide();
					$('#dialog #loading_box2').show();
					$('#dialog').dialog({title:'Saving'});
				},
				cache: false,
				complete: function(){
					alert('Data sukses disimpan');
					$('#dialog #form_input').show();
					$('#dialog #loading_box2').hide();
					$('#dialog').dialog('close');
					$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
					$("#report").load(urls);
				},
				dataType:'json',
				data: $('#frmCustomer').serialize(),
				success: function(data){
					if(!data.result){
						alert(data.msg);
					}
				}, 
				error : function (XMLHttpRequest, textStatus, errorThrown) {
					alert(XMLHttpRequest.responseText);
				}
			});
		return false;
	});
	
		$(function() {
	var today=new Date();
		$("#DATE_CREATED").datepicker({
			showOn: 'button',
			buttonImage: '<?php echo ICONS ?>calendar.gif',
			buttonImageOnly: true,
			changeMonth: true,
			changeYear: true,
			minDate : today,
			 onSelect: function(selectedDate) {
        var option = this.id == "from" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
		});
		$('#DATE_CREATED').datepicker('option', {dateFormat: 'd-m-yy'});
		$('#DATE_CREATED').datepicker('option', $.datepicker.regional['id']);
		$('#DATE_CREATED').datepicker('option', {minDate:0, maxDate:2});
	});
	
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
		
		$('#list').click(function(){
			getReport(2);			
		})
		
		$('#base').click(function(){
			getReport(4);			
		})
		
		function getReport(ex){
			var year = '<?php echo date('Y');?>';
			var bulan = '<?php echo date('n');?>';
			var month = $('#MONTH').val(); 
			var tipe = $('#TIPE').val();
			var id = '<?php echo $this->session->userdata('ID'); ?>';
			//var id = 34359;
			//var id = '24660';
			if(ex == 0){
				var urls = '<?php echo site_url('/report/get_nasabah_bm_tab/')?>/'+id + '/' +month + '/' +tipe; 
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} else if ( ex == 1) {
				//var urls = '<?php echo site_url('/report/xls_nasabah/')?>/'+id + '/' +month; 
				//alert(urls);
				//$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>exporting data to xls, please be patient ... </span>");
				//window.location = urls;
				//$("#report").html("Silahkan isi periode report");
			} else if ( ex == 4) {
				var urls = '<?php echo site_url('/report/get_baseline/')?>/'+id + '/' +year + '/' +bulan; 
				//alert(urls);
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
			} 
			else {
				var urls = '<?php echo site_url('/report/get_list_nasabah/')?>/'+id; 
				//alert(urls);
				$("#report").html("<img src='<?php echo LOAD ?>'> <span style='color:#080'>loading</span>");
				$("#report").load(urls)
				//window.location = urls;
			}
			
		}
		
	});
		function catat_agenda(cif)
		{
			//alert('cifkey['+cif+']');
			var cif_key = $('#CF'+cif+'').val();
			var cust_name = $('#CN'+cif+'').val();
			var status = $('#S'+cif+'').val();
			//alert(cif_key);
			$('#CIF_KEY').val(cif_key);
			$('#CUST_NAME').val(cust_name);
			$('#STATUS').val(status);
			$('#dialog').dialog('open');
		}
		function getActivity(id)
		{
			//alert(id);
			var cif_key = $('#CF'+id+'').val();
			$.ajax({
				type: "POST",
				url: "<?php echo $getDataActivity;?>", 
				data:'id='+cif_key,
				success: function(data){
					$('#detailkegiatan').html(data);
				}
			});
			dialog = $( "#relaas" ).dialog({
			  autoOpen: false,
			  height: 600,
			  width: 650,
			  modal: true
			});

			dialog.dialog("open");
		}
		function getProduk(id)
		{
			//alert(id);
			var cif_key = $('#CF'+id+'').val();
			$.ajax({
				type: "POST",
				url: "<?php echo $getDataProduk;?>", 
				data:'id='+cif_key,
				success: function(data){
					$('#detailproduk').html(data);
				}
			});
			dialog = $( "#relaas" ).dialog({
			  autoOpen: false,
			  height: 600,
			  width: 650,
			  modal: true
			});

			dialog.dialog("open");
		}
		function getNasabah(id)
		{
			//alert(id);
			var cif_key = $('#CF'+id+'').val();
			$.ajax({
				type: "POST",
				url: "<?php echo $getDataNasabah;?>", 
				data:'id='+cif_key,
				success: function(data){
					$('#detailnasabah').html(data);
				}
			});
			dialog = $( "#relaas" ).dialog({
			  autoOpen: false,
			  height: 600,
			  width: 650,
			  modal: true
			});

			dialog.dialog("open");
		}
</script>


<div id='content_x'>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">NASABAH KELOLAAN</a></li>
        </ul>
        <div id="tabs-1">
            <form action="" method="post" enctype="application/x-www-form-urlencoded" name="frmReport" id="frmReport">
            <table width="" border="0" cellspacing="5" cellpadding="0" >
              <tr>
			  <td align="left">
                    <select name='TIPE' id='TIPE' DISABLED>
                    	<option value="0">CR</option>
                        <option value="1">BB</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                    </td>
                <td>
                	<select name='MONTH' id='MONTH'>
                    	<option value="0">Yesterday All</option>
                        <option value="1">Last Month All</option>
						<!--<option value="2">Yesterday Flagging</option>
						<option value="3">Last Month Flagging</option>-->
                    </select>
                </td> 
                <td><input name="submit" id="submit" type="button" value="Generate"></td>
                <!--td><input name="export" id="export" type="button" value="Export to XLS"</td>
				<td><input name="list" id="list" type="button" value="CIF Nasabah Kelolaan"></td>
				<td><input name="base" id="base" type="button" value="Baseline Kelolaan"></td-->
              </tr>
            </table>
            </form>
            <br />
            <div id='report'>Silahkan isi periode report</div>
         </div>
	</div>

	<div id="dialog" title="Agenda">
	<div id="form_input">
	 <form action="<?php echo site_url('/activity_bm/save/') ?>" method="post" enctype="application/x-www-form-urlencoded" name="frmCustomer" id="frmCustomer">
		<table width="" border="0" cellspacing="0" class="frmtable">
								<input name="STATUS" type="hidden" id="STATUS" value="" width="30">
                                <tr>
                                    <td width="119" align="left">No CIF</td>
                                    <td width="3">:</td>
                                    <td width="295" align="left"><input name="CIF_KEY" type="text" id="CIF_KEY" value="" width="30" readonly></td>
                    				</tr>           
                                <tr>
                                    <td width="119" align="left">Nama Customer </td>
                                  <td width="3">:</td>
                                    <td align="left"><input name="CUST_NAME" type="text" id="CUST_NAME" size="30"  readonly width="30"></td>
                                </tr>
								<tr>
                                    <td width="119" align="left">Kegiatan</td>
                                  <td width="3">:</td>
                                    <td align="left">
									<select name="KEGIATAN" id="KEGIATAN">
										<option value = 0>CALL</option>
										<option value = 1>VISIT</option>
									</select>
									</td>
                                </tr>
                               <!-- <tr>
                                    <td align="left">Tanggal <span style="color:#F00">*</span></td>
                                    <td>:</td>
                                    <td align="left"><input name="DATE_CREATED" type="text" id="DATE_CREATED" value="<?php echo date('d-m-yy');?>" width="30" style="width:100px;"  readonly="readonly" /></td>
                                </tr>
								<tr>
                                    <td width="119" align="left">Realisasi</td>
                                  <td width="3">:</td>
                                    <td align="left">
									<select name="REALISASI" id="REALISASI" onchange="changeRealisasi(this.value)">
										<option value = 2>--PILIH--</option>
										<option value = 0>TIDAK</option>
										<option value = 1>YA</option>
									</select>
									</td>
                                </tr>
								<tr id='ket'>
									<td width="119" align="left">Keterangan</td>
                                  <td width="3">:</td>
                                    <td align="left">
										<textarea name="KETERANGAN" id="KETERANGAN" width="30" size="30" style="width: 170px; height: 86px;"></textarea>
									</td>
								</tr>-->
								<tr>
                                    <td align="center" colspan="3"><input name="simpan" style="display:none;" id="simpan" type="button" value="Simpan" style="background:#FFC488"> 
                                    </td>
                                </tr>
		</table>
		</form>
	</div>
	<div id="loading_box2" style="display:none">
			<img src="<?php echo ICONS;?>loading_bar.gif" alt="Loading...." width="350" height="19" />
		</div>
	<div id="relaas" style="display:none" title="Relaas Nasabah">
		<div id='detailnasabah'></div>
		<div id='detailproduk'></div>
		<div id='detailkegiatan'></div>
		</div>
	</div>
</div><!-- close div content -->

</td>
</tr>
</table>
<script type="text/javascript">
	function changeRealisasi(v)
	{
		//alert(v);
		switch(v)
		{
			case '0':
			$("#ket").show();
			break;
			case '1':
			$("#ket").hide();
			break;
			case '2':
			$("#ket").hide();
			break;
		}
	}

	<?php 
	$level 	= $_SESSION['USER_LEVEL'];
	$i		= 1;
	$html 	= "\$(function(){\$( '#accordion' ).accordion({ active:$i});});";
	echo $html;
?>
</script>
<?php $this->load->view('default/footer') ?>