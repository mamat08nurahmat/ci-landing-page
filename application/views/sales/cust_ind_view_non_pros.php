<?php $this->load->view('default/header') ?>	

<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
</script>

<td  valign="top" align="left">

<div id='content_x'>
	<div class="ui-state-default ui-corner-all" style="padding:5px; margin-bottom:10px;">
    	<img src="<?php echo APP ?>" align="middle" /> LEADS MANAGEMENT
    </div>
	<div id="tabs">
        <ul>
            <li><a href="#tabs-1">Leads Kelolaan</a></li>
        </ul>
        <div id="tabs-1">
					<div style="float: left;display: block;width: 50%">
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Pribadi Nasabah</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_pribadi) && $data_pribadi)
                    {	
                        $n = 1;
						
                        foreach($data_pribadi[0] as $row => $val){
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
												if($row == 'Penghasilan Pribadi')
														$val = number_format($val, 2, ',', '.');
                ?>
                      <tr bgcolor="<?php echo $color ?>">
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Produk Bank BNI</strong></th>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk DPK yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										unset($data_prod_bni[0]['CIF']);
										$prod_bni = str_replace('_',' ', str_replace('PROD_','',implode(', ',array_keys($data_prod_bni[0],'1'))));
										$prod_bni = ucwords(strtolower($prod_bni));
									?>
									<div style="padding:2px"><?php echo $prod_bni ?></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk Kredit Konsumer yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['NAMA_PRODUK']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk Investasi yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<div style="padding:2px"></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk Asuransi yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['NAMA_PRODUK']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk Kartu Kredit yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									
									<div style="padding:2px"></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk E-Banking yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['NAMA_PRODUK']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Lain-Lain</div>
								</td>
								<td>:</td>
								<td>
									
									<div style="padding:2px"></div>
								</td>
							</tr>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Produk Bank Lain</strong></th>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk DPK yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['DPK_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk Kredit Konsumer yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['KREDIT_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk Investasi yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['INVESTASI_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk Asuransi yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['ASURANSI_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Produk Kartu Kredit yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['CC_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#ffffff">
								<td>
									<div style="padding:2px">Produk E-Banking yang dimiliki</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['EBANKING_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
							<tr bgcolor="#eeeeee">
								<td>
									<div style="padding:2px">Lain-Lain</div>
								</td>
								<td>:</td>
								<td>
									<?php
										$prod_banklain = $data_prod_bank_lain[0]['LAIN2_BANK_LAIN']
									?>
									<div style="padding:2px"><?php echo $prod_banklain ?></div>
								</td>
							</tr>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Sales</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_sales) && $data_sales)
                    {	
                        $n = 1;
												
                        foreach($data_sales[0] as $row => $val){
													if($row == 'CIF')	continue;
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
                ?>
                      <tr bgcolor="<?php echo $color ?>">
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
					</div>
					<div style="float: right;display: block;width: 50%">
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Pekerjaan</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_pekerjaan) && $data_pekerjaan)
                    {	
                        $n = 1;
												
                        foreach($data_pekerjaan[0] as $row => $val){
													if($row == 'CIF')	continue;
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
                ?>
                      <tr bgcolor="<?php echo $color ?>">
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Family Tree</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_pasangan) && $data_pasangan)
                    {	
                        $n = 1;
												
                        foreach($data_pasangan[0] as $row => $val){
													if($row == 'CIF')	continue;
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
                ?>
                      <tr bgcolor="<?php echo $color ?>"class="<?php echo str_replace(" ","_",$row) ?>" >
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px" class="value"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Bisnis</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_bisnis) && $data_bisnis)
                    {	
                        $n = 1;
												
                        foreach($data_bisnis[0] as $row => $val){
													if($row == 'CIF')	continue;
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
													if($row == 'Total AUM dengan BNI' || $row == 'Total Loan' || $row == 'Posisi Tabungan')
														$val = number_format($val, 2, ',', '.');
                ?>
                      <tr bgcolor="<?php echo $color ?>">
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
						<br />
						<table width="100%" border="0" cellspacing="0">
              <tr>
								<th colspan="3"><strong>Data Lain-lain</strong></th>
							</tr>
                <?php 
                    #print_r($data);
                    if(isset($data_lain) && $data_lain)
                    {	
                        $n = 1;
												
                        foreach($data_lain[0] as $row => $val){
													if($row == 'CIF')	continue;
                            $color = (($n%2) == 0)?'#ffffff':'#eeeeee';
                ?>
                      <tr bgcolor="<?php echo $color ?>">
                        <td>
													<div style="padding:2px"><?php echo str_replace("_"," ",$row) ?></div>
												</td>
												<td>:</td>
												<td>
													<div style="padding:2px"><?php echo $val ?></div>
												</td>
                      </tr>
                 <?php $n++; }} ?>
            </table>
					</div>
					
					
					<div style="clear: both;display: block"></div>
		</div>
    </div>
</div>
	<div align="center"><input name="Back" type="button" value="Back" onclick="history.back()" /></div>
</td>
</tr>
</table>	
<script type="text/javascript">
$(function(){
	$( "#accordion" ).accordion({ active:3 });
	var jmlAnak = $('.Jumlah_Anak .value').html();
	for(var i = 3; i > jmlAnak ; i--)
	{
		$(".Usia_Anak_"+i).hide();
		$(".Pekerjaan_Anak_"+i).hide();
	}
	$('#tabs table').css('border','1px solid #ccc');
	$('#tabs table').css('background-color','azure');
	$('#tabs table th').css('height','21px');
	$('#tabs table td').css('vertical-align','top');
});
</script>

<?php $this->load->view('default/footer') ?>