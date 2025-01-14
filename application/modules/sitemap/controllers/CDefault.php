<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CDefault extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('MCommon');
    }

    public function index(){
        $this->load->library('Sitemaps');

        /*
        foreach($posts AS $post)
        {
            $item = array(
                "loc" => site_url("blog/" . $post->slug),
                // ISO 8601 format - date("c") requires PHP5
                "lastmod" => date("c", strtotime($post->last_modified)),
                "changefreq" => "hourly",
                "priority" => "0.8"
            );

            $this->sitemaps->add_item($item);
        }
        */
        $menu = ['san-pham','tin-tuc','lien-he','gioi-thieu'];
        foreach ($menu as $itemmenu){
            $item = array(
                "loc" => site_url($itemmenu),
                "lastmod" => date("c", time()),
                "changefreq" => "hourly",
                "priority" => "0.8"
            );

            $this->sitemaps->add_item($item);
        }
        $cats = $this->MCommon->getAllRow_lang('vi','product_cat');
		if($cats){
			foreach ($cats as $cat){
				$item = array(
					"loc" => site_url('san-pham/'.$cat->slug),
					"lastmod" => date("c", time()),
					"changefreq" => "hourly",
					"priority" => "0.5"
				);

				$this->sitemaps->add_item($item);
			}
		}
        

        $products = $this->MCommon->getAllRow_lang('vi','product');
		if($products){
			foreach ($products as $product){
				$item = array(
					"loc" => site_url('san-pham/'.$product->slug.'-'.$product->id),
					"lastmod" => date("c", time()),
					"changefreq" => "hourly",
					"priority" => "1"
				);

				$this->sitemaps->add_item($item);
			}
		}
        
		
		$cats = $this->MCommon->getAllRow_lang('vi','news_cat');
		if($cats){
			foreach ($cats as $cat){
				$item = array(
					"loc" => site_url('tin-tuc/'.$cat->slug),
					"lastmod" => date("c", time()),
					"changefreq" => "hourly",
					"priority" => "0.5"
				);

				$this->sitemaps->add_item($item);
			}
		}
        

        $news = $this->MCommon->getAllRow_lang('vi','news');
		if($news){
			foreach ($news as $item){
				$item = array(
					"loc" => site_url('tin-tuc/'.$item->slug.'-'.$item->id),
					"lastmod" => date("c", time()),
					"changefreq" => "hourly",
					"priority" => "1"
				);

				$this->sitemaps->add_item($item);
			}
		}
        
		


        // file name may change due to compression
		header("Content-Type: text/xml;charset=iso-8859-1");
        echo $file_name = $this->sitemaps->build();

        //$reponses = $this->sitemaps->ping(site_url($file_name));

        // Debug by printing out the requests and status code responses
        // print_r($reponses);

        //redirect(site_url($file_name));
    }
}
