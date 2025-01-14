<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set('Asia/Ho_Chi_Minh');
class Statistics_box_widget extends MY_Widget
{
    
    function index(){
		
		//kiem tra truy cap
		$ip = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		$check = $this->MCommon->getRow('statistics_logs',['ip'=>$ip,'user_agent'=>$user_agent,'DATE(last_access)'=>date("Y-m-d",time())]);
		if($check){
			$this->MCommon->update(['last_access'=>date("Y-m-d H:i:s",time()),'active'=>1],'statistics_logs',['id'=>$check->id]);
		}
		else{
			$this->MCommon->insert(['ip'=>$ip,'user_agent'=>$user_agent,'last_access'=>date("Y-m-d H:i:s",time())],'statistics_logs');
			
			$total_today = $this->MCommon->getRow('statistics',['key'=>'today']);
			if($total_today)
				$this->MCommon->update(['value'=>$total_today->value+1],'statistics',['key'=>'today']);
			
			$total_total = $this->MCommon->getRow('statistics',['key'=>'total']);
			if($total_total)
				$this->MCommon->update(['value'=>$total_total->value+1],'statistics',['key'=>'total']);
		}
		
		//loai bo user khong online
		$list = $this->MCommon->getAllRowByWhere('statistics_logs',['active'=>1]);
		if($list)foreach($list as $item){
			if((int)time() - (int)strtotime($item->last_access) > 300){
				$this->MCommon->update(['active'=>0],'statistics_logs',['id'=>$item->id]);
			}
		}
		

        $total_today = $this->MCommon->getRow('statistics',['key'=>'today','last_update'=>date("Y-m-d",time())]);
        if($total_today)
			$data['total_today'] = $total_today->value + 500;
		else{
			$this->MCommon->update(['last_update'=>date("Y-m-d",time())],'statistics',['key'=>'today']);
			
			//update yesterday
			$total_today_old = $this->MCommon->getRow('statistics',['key'=>'today']);
			$this->MCommon->update(['value'=>$total_today_old->value],'statistics',['key'=>'yesterday']);
			
			//reset today
			$this->MCommon->update(['value'=>0],'statistics',['key'=>'today']);
			$data['total_today'] = 1;
			
			//delete logs
			$this->MCommon->delete('statistics_logs',['id !='=>0]);
			
		}
            
		
		
		$total_yesterday = $this->MCommon->getRow('statistics',['key'=>'yesterday']);
        if($total_yesterday)
            $data['total_yesterday'] = $total_yesterday->value + 500;
		
		
		$total_total = $this->MCommon->getRow('statistics',['key'=>'total']);
        if($total_total)
            $data['total_total'] = $total_total->value;
		
		$total_online = $this->MCommon->getTotalRow('statistics_logs',['active'=>1]);
            $data['total_online'] = $total_online + rand(2,6);
		
		
        $data['a'] = "a";

        $this->load->view('view',$data);
    }
}