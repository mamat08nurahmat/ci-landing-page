<?php 
/*
/	Author 	: Setyo Ari S
/	Date	: 15 Desember 2010
/	Email	: xdesain@gmail.com
*/


class Home extends Controller 
{
#start class

	function Home()
	{
		parent::Controller();
		$this->load->helper(array('url', 'form'));
		$this->load->library(array('table','validation', 'session', 'ldap'));
		$this->load->model('_login', 'login', TRUE);
		$this->load->model('_news');
		$this->load->model('_activity');
		$this->load->model('_home');
		$this->load->model('_agenda_bm');
		if($_SESSION['ID'] == ''){ redirect('login/logout/');}
		$this->load->model('_handler');
		
		$session_id = $_SESSION['ID'];
		$now = date("Y-m-d H:i:s");	
		$this->_handler->update_session($now,$session_id);
	}
	
	function index()
	{	
		$data = $this->_news->get_news();
		$data2 = $this->_home->sudah_kuesioner($_SESSION['ID']);
		//echo $data[0];die();
		//$data = $this->_home->get_sum_point($_SESSION['ID']);
		if($data2[0]->status==1)
		{
		$this->load->view('default/home2');
		}
		$this->load->view('default/home2');
	}
	
	function new_home()
	{	
		$data = $this->_news->get_news();
		//echo $data[0];die();
		//$data = $this->_home->get_sum_point($_SESSION['ID']);
		$this->load->view('default/new_home');
	}
	
	function get_sales()
	{
		$this->load->library('flexigrid');
		
		$valid_fields = array('ID', 'USER_NAME', 'SALES_TYPE', 'SPV', 'BRANCH_NAME', 'KODE', 'REGION');
		
		$this->flexigrid->validate_post('ID','asc',$valid_fields);
		$id 		= ($this->session->userdata('BRANCH_ID') <> '')?$this->session->userdata('BRANCH_ID'):0;
		$records 	= $this->_home->get_neo_search($id);
		$this->output->set_header($this->config->item('json_header'));		
		
		foreach ($records['records']->result() as $row)
		{
			$record_items[] = array($row->ID,
				$row->ID,
				strtoupper($row->USER_NAME),
				$row->SALES_TYPE,
				$row->SPV,
				$row->BRANCH_NAME,								
				$row->KODE,
				$row->REGION
			);
		}
		//Print please
		if (isset($record_items))
		 $this->output->set_output($this->flexigrid->json_build($records['record_count'],$record_items));
         else
         $this->output->set_output('{"page":"1","total":"0","rows":[]}');
	}
	
	function list_user()
	{
		$this->load->helper('flexigrid');
		
		$colModel['ID'] 			= array('NPP',40,TRUE,'center',2);
		$colModel['USER_NAME'] 		= array('NAMA',200,TRUE,'left',1);
		$colModel['SALES_TYPE'] 	= array('SALES TYPE',150,TRUE,'left',1);
		$colModel['SPV'] 			= array('SPV',50,TRUE,'left',1);
		$colModel['BRANCH_NAME'] 	= array('BRANCH',100,TRUE,'left',1);		
		$colModel['KODE'] 			= array('REGION',70,TRUE,'center',1);
		$colModel['REGION'] 		= array('REGION ID',50,TRUE,'left',1);

		$gridParams = array(
			'width' 			=> 460,
			'height' 			=> 300,
			'rp' 				=> 10,
			'rpOptions' 		=> '[10,25,50,100]',
			'pagestat' 			=> '{from} to {to} of {total} items.',
			'blockOpacity' 		=> 0.5,
			'title' 			=> 'LIST DATA SALES',
			'showTableToggleBtn'=> false
		);

		$buttons[] 			= array('Pilih','add','pilih_data');
		$buttons[] 			= array('separator');
		$grid_js 			= build_grid_js('search_list',site_url("/home/get_sales"),$colModel,'a.ID','ASC',$gridParams,$buttons);
		$data['js_grid'] 	= $grid_js;
		return $data;
	}
	
	
	function save()
	{
		$data['npp'] 	= $this->session->userdata('ID');	
		$data['negara']  = $this->input->post('negara');
		$this->_home->save($data);
		redirect('home');
	}
	
	function is_download()
	{
		$npp	= $this->session->userdata('ID');
		$data = array(
			   'id'=> $npp,
               'juklak' => 1
            );
		$this->_home->update($data);
		redirect('http://brftst.bni.co.id/sapm_prod/JA2015.pdf');	
	}
	
	function save_kpatw()
	{
		$data['NPP'] = $this->session->userdata('ID');
		$data['USER_LEVEL'] 	= $this->session->userdata('USER_LEVEL');
		$data['Q1'] = $this->input->post('kuesioner');
		$data['ALASAN1'] = $this->input->post('alasan');
		$data['Q2'] = $this->input->post('kuesioner1');
		$data['ALASAN2'] = $this->input->post('alasan1');
		$data['Q3'] = $this->input->post('kuesioner2');
		$data['ALASAN3'] = $this->input->post('alasan2');
		$data['ALASAN4'] = $this->input->post('alasan3');
		$data['STATUS']  = 1;
		$this->_home->save_kpatw($data);
		redirect('home');
	}
	function point($msg='', $err='')
	{
		$data['err'] = $err;
		$data['msg'] = $msg;
		$data = $this->list_user();	
		$this->load->view('default/point',$data);
	}
	function getPoint($id,$start,$end)
	{
		$data = $this->_home->get_detail_point($id,$start,$end);
		$html 	=  "";
		$html   .= "<div STYLE='height: auto; width: auto; font-size: 12px; overflow: auto;'>";
		$html 	.= "<table width='100%' cellpadding='10' cellspacing='1' bgcolor='#cccccc' class='tbl_report'>\n";
		$html 	.= "<tr  bgcolor='#A5D3FA'>\n
						<th align='center' class='kecil'>NO.</th>\n
						<th align='center' class='kecil'>TANGGAL</th>\n
						<th align='center' class='kecil'>CC BIRU</th>\n						
						<th align='center' class='kecil'>CC GOLD</th>\n
						<th align='center' class='kecil'>CC PREMIUM</th>\n
						<th align='center' class='kecil'>POINT</th>\n
					";
		$i = 1; //counter untuk nomer
		$color = "#ffffff";
			#echo "<pre>"; print_r($data); die();
		if($data)
		{
			$sumbiru=0;
			$sumgold=0;
			$sumpremium=0;
			$sumpoint=0;
			foreach($data as $row)
			{
				$color = ($i%2)?"#ffffff":"#eeeeee";
				$html .= "<tr bgcolor='$color'>\n";
				$html .= "<td width='' align='center' class='kecil'>".$i++."</td> \n";
				$html .= "<td width='' align='center' class='kecil'>".$row->AS_OF_DATE."</td> \n";
				$html .= "<td width='' align='center' class='kecil'>".$row->CC_BIRU."</td> \n";
				$html .= "<td width='' align='center' class='kecil'>".$row->CC_GOLD."</td> \n";
				$html .= "<td width='' align='center' class='kecil'>".$row->CC_PREMIUM."</td> \n";
				$html .= "<td width='' align='center' class='kecil'><b>".$row->POINT."</b></td> \n";
				$sumbiru = $sumbiru + $row->CC_BIRU;
				$sumgold = $sumgold + $row->CC_GOLD;
				$sumpremium = $sumpremium + $row->CC_PREMIUM;
				$sumpoint= $sumpoint + $row->POINT;
			}
		}else {
				$html .= "<tr>\n";
				$html .= "	<td bgcolor='#ffffff' colspan='6' align='center'><span style='color:#c00'>Tidak ada data</span></td>\n";	
				$html .= "</tr>\n";
		}
		$html 	.= "<tr  bgcolor='#66FF66'>\n";
		$html .= "	<td bgcolor='#ffffff' colspan='2' align='center'><span style='color:#c00'>Total</span></td>\n";	
		$html .="<td width='' align='center' class='kecil'>".$sumbiru."</td> \n";
		$html .="<td width='' align='center' class='kecil'>".$sumgold."</td> \n";
		$html .="<td width='' align='center' class='kecil'>".$sumpremium."</td> \n";
		$html .="<td width='' align='center' class='kecil'><b>".$sumpoint."</b></td> \n";
		$html .= "</table> \n";
		$html .= "</div>";
		echo $html;
	}
	function save_redeem()
	{
		$config['upload_path'] 		= INVOICEBILL;
		$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
		$config['max_size']			= '2000';
		$config['max_width']  		= '0';
		$config['max_height']  		= '0';
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		$err = '';
		$msg = '';
		
		if (!$this->upload->do_upload())
		{
			$err = $this->upload->display_errors('','');
		}	
		else
		{
			$result = $this->upload->data();
			
			$data = array('upload_data' => $result);
			#echo "<pre>"; print_r($data); die();
			$save = array(							
							'ID'			=>date('dmYHis'),
							'FILE_NAME'		=>$result['file_name'],
						 	'FILE_TYPE'		=>strtoupper(str_replace('.','',$result['file_ext'])),
							'FILE_SIZE'		=>$result['file_size'],
							'FILE_PATH'		=>$result['full_path'],
							'DATE_CREATED'	=>date('d-m-Y H:i:s'),
							'USER_CREATED'	=>$this->session->userdata('ID'),
							'STATUS'		=>'NEW',
							'TYPE'			=>'INVOICEBILL'
						 );
			$this->_home->save_files($save, 'FILES_INVOICEBILL');
			$msg 		= 'Your file was successfully uploaded!';
			$fm = $result['full_path'];
		}
		$tgl = date();
		$datatrx=array();
		$datatrx['SALES_ID']=$_SESSION['ID'];
		$datatrx['AS_OF_DATE']=date('d-M-y',strtotime($tgl));
		$datatrx['REDEEM']=$this->input->post('RP');
		$datatrx['FILE_NAME']=$fm;
		$datatrx['NOMINALREDEEM']=$this->input->post('RPSN');
		$datatrx['BIAYAKIRIM']=$this->input->post('BKN');
		$this->_home->save_trx($datatrx);
		redirect('home/point');
	}
	function update_redeem()
	{
		$config['upload_path'] 		= INVOICEBILL;
		$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
		$config['max_size']			= '2000';
		$config['max_width']  		= '0';
		$config['max_height']  		= '0';
		
		$this->load->library('upload');
		$this->upload->initialize($config);
		
		$err = '';
		$msg = '';
		
		if (!$this->upload->do_upload())
		{
			$err = $this->upload->display_errors('','');
		}	
		else
		{
			$result = $this->upload->data();
			
			$data = array('upload_data' => $result);
			#echo "<pre>"; print_r($data); die();
			$save = array(							
							'ID'			=>date('dmYHis'),
							'FILE_NAME'		=>$result['file_name'],
						 	'FILE_TYPE'		=>strtoupper(str_replace('.','',$result['file_ext'])),
							'FILE_SIZE'		=>$result['file_size'],
							'FILE_PATH'		=>$result['full_path'],
							'DATE_CREATED'	=>date('d-m-Y H:i:s'),
							'USER_CREATED'	=>$this->session->userdata('ID'),
							'STATUS'		=>'NEW',
							'TYPE'			=>'INVOICEBILL'
						 );
			$this->_home->save_files($save, 'FILES_INVOICEBILL');
			$msg 		= 'Your file was successfully uploaded!';
			$ft = $result['full_path'];
		}
		$tgl = date();
		$datatrx=array();
		$datatrx['TRXID']=$this->input->post('TRXID');
		$datatrx['ADMIN_ID']=$_SESSION['ID'];
		$datatrx['AS_OF_DATE']=date('d-M-y',strtotime($tgl));
		$datatrx['FILE_NAME']=$ft;
		$this->_home->update_trx($datatrx);
		redirect('home/point');
	}
	function update_feedback()
	{
		$data =array();
		$data['FBID']=$this->input->post('FBID');
		$data['IS_PUAS']=$this->input->post('is_puas');
		$data['KETERANGAN']=$this->input->post('keterangan');
		$this->_home->update_comment($data);
		redirect('home/point');
	}
	function save_kuesioner()
	{
		$data['SALES_ID'] 	= $this->session->userdata('ID');
		$data['USER_LEVEL'] 	= $this->session->userdata('USER_LEVEL');
		$data['Q1']  = $this->input->post('kuesioner');
		$data['Q2']  = $this->input->post('kuesioner2');
		$data['Q3']  = $this->input->post('kuesioner3');
		$data['Q4']  = $this->input->post('kuesioner4');
		$data['Q5']  = $this->input->post('kuesioner5');
		$data['Q6']  = $this->input->post('kuesioner6');
		$data['Q7']  = $this->input->post('kuesioner7');
		$data['Q8']  = $this->input->post('kuesioner8');
		$data['Q9']  = $this->input->post('kuesioner9');
		$data['Q10']  = $this->input->post('kuesioner10');
		$data['Q11']  = $this->input->post('kuesioner11');
		$data['Q12']  = $this->input->post('kuesioner12');
		$data['Q13']  = $this->input->post('kuesioner13');
		$data['Q14']  = $this->input->post('kuesioner14');
		$data['Q15']  = $this->input->post('kuesioner15');
		$data['Q16']  = $this->input->post('kuesioner16');
		$data['Q17']  = $this->input->post('kuesioner17');
		$data['Q18']  = $this->input->post('kuesioner18');
		$data['Q19']  = $this->input->post('kuesioner19');
		$data['Q20']  = $this->input->post('kuesioner20');
		$data['Q21']  = $this->input->post('kuesioner21');
		$data['Q22']  = $this->input->post('kuesioner22');
		$data['Q23']  = $this->input->post('kuesioner23');
		$data['Q24']  = $this->input->post('kuesioner24');
		$data['Q25']  = $this->input->post('kuesioner25');
		$data['Q26']  = $this->input->post('kuesioner26');
		$data['STATUS']  = 1;
		$this->_home->save_kuesioner($data);
		redirect('home');
	}
}