<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library extends the CodeIgniter CI_Language class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Lang.php
 *
 * @copyright	Copyright (c) 2011 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Lang extends CI_Lang
{
	var $language    = array();
    var $is_loaded    = array();
    var $idiom;
    var $set;

    var $line;
    var $CI;
	
	public function load($lang = '', $return = FALSE, $add_suffix = TRUE, $alt_path = '', $_module = '')	
	{
		$this->set = CI::$APP->router->fetch_module();
        
		$deft_lang = CI::$APP->config->item('language');
		$idiom = ($lang == '') ? $deft_lang : $lang;
		$this->idiom = $idiom;
		
		$database_lang =  $this->_get_from_db();
		if($database_lang)
		{
			$lang = $database_lang;
			$this->is_loaded[] = CI::$APP->router->fetch_module();
			$this->language = array_merge($this->language, $lang);
			unset($lang);
			
			return $this->language;
			
		}
		
		
	}
	
	
	private function _get_from_db()
    {
          $CI =& get_instance();

        $CI->db->select   ('*');
        $CI->db->from     ('language');
        $CI->db->where    ('language', $this->idiom);
        $CI->db->where_in    ('set', [$this->set,'common']);


        $query = $CI->db->get();
		if($query->num_rows() > 0){
			$query = $query->result();
			foreach ( $query as $row )
			{
				$return[$row->key] = $row->text;
			}
			unset($CI, $query);
			return $return;
		}
        else{
			unset($CI, $query);
			return false;
		}
            
    }
}