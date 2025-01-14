<?php
/**
 * Module: ci
 * Create by Nguyen Huu Dat
 * Last Modified: 9/15/17 10:33 AM
 * Date: 9/15/17 3:05 PM
 *
 */

/**
 * Class CAdmin
 * @property CAdmin $CAdmin event module
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class CAdmin extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MCart');
        $this->load->model('MCommon');
    }

    public function listall()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $this->config->load('pagination');
        $config['base_url'] = site_url().'admin/cart/listall/';
        $config['total_rows'] = $this->MCommon->getTotalRow('orders');
        $config['per_page'] = 20;
        $config['uri_segment'] = 4;
        //end css
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $page = $this->uri->segment(4)?$this->uri->segment(4):1;
        $page = get_page($page);
        $start = ($page-1)*$config['per_page'];
        $list = $this->MCommon->getAllRowWithPage('orders',$config['per_page'],$start,"id DESC");
        $pagination_link = $this->pagination->create_links();
		
		if(isset($_POST['btnExcel'])){
			
			$data['download'] = '/admin/cart/export?datefrom='.urldecode($this->input->post('datefrom')).'&dateto='.urldecode($this->input->post('dateto'));
		}


        if($list)
            $data['list'] = $list;

        //template
        $data['pagination_link'] = $pagination_link;
        $data['total_product'] = $config['total_rows'];
        $data['module'] = $module;
        $data['title'] = "Danh sách đơn hàng";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }
	
	
	public function export()
    {

        $datefrom = $this->input->get("datefrom");
        $dateto = $this->input->get("dateto");

        
        $where = array();
            
        if($datefrom != "")
            $where['create_time >='] = $datefrom.":00";
        if($dateto != "")
            $where['create_time <='] = $dateto.":00";



        $data = array();
        $no = 0;
		
        $list = $this->MCommon->getAllRowByWhere('invoice',$where,null,"id DESC");
        if($list){
			
			require "Classes/PHPExcel.php";
			//Khởi tạo đối tượng
			$excel = new PHPExcel();
			//Chọn trang cần ghi (là số từ 0->n)
			$excel->setActiveSheetIndex(0);
			//Tạo tiêu đề cho trang. (có thể không cần)
			$excel->getActiveSheet()->setTitle('Danh sach');

			//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
			$excel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
			$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('C')->setWidth(14);
			$excel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
			$excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
			$excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
			$excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			$excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$excel->getActiveSheet()->getColumnDimension('I')->setWidth(60);
			$excel->getActiveSheet()->getColumnDimension('J')->setWidth(19);
			$excel->getActiveSheet()->getColumnDimension('K')->setWidth(50);

			
			$excel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);

			$excel->getActiveSheet()->setCellValue('A1', 'STT');
			$excel->getActiveSheet()->setCellValue('B1', 'Giá');
			$excel->getActiveSheet()->setCellValue('C1', 'Giảm');
			$excel->getActiveSheet()->setCellValue('D1', 'Ship');
			$excel->getActiveSheet()->setCellValue('E1', 'Tên khách');
			$excel->getActiveSheet()->setCellValue('F1', 'Sản phẩm');
			$excel->getActiveSheet()->setCellValue('G1', 'Tổng SL');
			$excel->getActiveSheet()->setCellValue('H1', 'SĐT');
			$excel->getActiveSheet()->setCellValue('I1', 'Địa chỉ');
			$excel->getActiveSheet()->setCellValue('J1', 'Ngày lập');
			$excel->getActiveSheet()->setCellValue('K1', 'Ghi chú');
			
			$numRow = 2;
			$i = 1;
			
			foreach($list as $row){
				$tongsoluong = $row->qty;
				$sanpham = '';
				$cart = json_decode($row->content);
				$t = 0;
				if(count($cart) > 0){
					foreach ($cart as $p){
						$product = $this->MCommon->getRow('product',['id'=>$p->product_id]);
						if($product){
							$sanpham.="- [".$product->code."] ".$p->name." - ".$p->size." - ".$p->qty."\n";
							$t = $t + $p->qty;
						}
						
					}
				}
				if($tongsoluong == 0)
					$tongsoluong = $t;
				
				$excel->getActiveSheet()->setCellValue('A'.$numRow, $i);
				
				$excel->getActiveSheet()->setCellValue('B'.$numRow, $row->price);
				$excel->getActiveSheet()->getStyle('B'.$numRow)->getNumberFormat()->setFormatCode('#,##0');
				
				$excel->getActiveSheet()->setCellValue('C'.$numRow, $row->discount);
				$excel->getActiveSheet()->getStyle('C'.$numRow)->getNumberFormat()->setFormatCode('#,##0');
				
				$excel->getActiveSheet()->setCellValue('D'.$numRow, $row->ship);
				$excel->getActiveSheet()->getStyle('D'.$numRow)->getNumberFormat()->setFormatCode('#,##0');
				
				$excel->getActiveSheet()->setCellValue('E'.$numRow, ($row->customer_realname == "")?$row->customer_name:$row->customer_realname);
				
				$excel->getActiveSheet()->setCellValue('F'.$numRow, trim($sanpham));
				$excel->getActiveSheet()->getStyle('F'.$numRow)->getAlignment()->setWrapText(true);
				
				$excel->getActiveSheet()->setCellValue('G'.$numRow, $tongsoluong);
				$excel->getActiveSheet()->getStyle('G'.$numRow)->getNumberFormat()->setFormatCode('#,##0');

				$excel->getActiveSheet()->setCellValue('H'.$numRow, $row->customer_phone);
				$excel->getActiveSheet()->getStyle('H'.$numRow)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
				
				$excel->getActiveSheet()->setCellValue('I'.$numRow, $row->address.", ".$row->thanhpho.", ".$row->tinh);
				
				$excel->getActiveSheet()->setCellValue('J'.$numRow, date("H:i:s d/m/Y",strtotime($row->create_time)));
				
				$excel->getActiveSheet()->setCellValue('K'.$numRow, $row->note);

				$numRow++;
				$i++;
			}
			
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="data.xls"');
			PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');
		}
		else{
			echo "Khong tim thay du lieu";
		}
			
    }
	
	
	public function del()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/cart/listall','refresh');

        $this->MCommon->delete('invoice',['id'=>$id]);

        redirect('/admin/cart/listall','refresh');

    }
	
	public function view()
    {
        $module = $this->router->fetch_module();
        $permission_id = $module."/".$this->router->fetch_method();
        modules::run('auth/Permission/check',$permission_id);

        $id = (int)$this->uri->segment(4);
        if($id =="" or  $id == 0)
            redirect('/admin/order/listall','refresh');

        //update
        if(!empty($this->input->post('btnPendding')))
        {
            $this->MCommon->update(['status'=>1, 'user_id'=>$this->session->userdata("userid")],'orders',['id'=>$id]);
        }

        if(!empty($this->input->post('btnFinish')))
        {
            $this->MCommon->update(['status'=>2, 'user_id'=>$this->session->userdata("userid")],'orders',['id'=>$id]);
        }

        if(!empty($this->input->post('btnCancel')))
        {
            $this->MCommon->update(['status'=>3, 'user_id'=>$this->session->userdata("userid")],'orders',['id'=>$id]);
        }


        $order = $this->MCommon->getRow('orders',['id'=>$id]);
        if(!$order)
            redirect('/admin/order/listall','refresh');

        
		$data['order'] = $order;


        //template
        $data['module'] = $module;
        $data['title'] = "Chi tiết đơn hàng";
        $data['method'] = $this->router->fetch_method();
        echo modules::run('template/getlayout/admin', $data);
    }


}
