<?php
class CDefault extends MX_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('MLanguage');
        $this->load->model('MCommon');
        //$this->load->model('courcefree/MCourcefree');
    }

    public function lang()
    {

        //kiem tra ngon ngu
        $id = $this->uri->segment(2);
        if($id =="")
            redirect(site_url(),'refresh');

        $check = $this->MCommon->getRow("language_list",['lang'=>$id]);
        if(!$check)
            redirect(site_url(),'refresh');

        $this->session->set_userdata("lang",$id);

        $this->load->library('user_agent');

        if($this->agent->is_referral() == false)
        {
            redirect($this->agent->referrer(),'refresh');
        }
        else{

            redirect(site_url(),'refresh');
        }

    }

}
?>