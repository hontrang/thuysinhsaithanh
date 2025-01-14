<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Loader class */
require APPPATH."third_party/MX/Loader.php";
require 'MY_Widget.php';
class MY_Loader extends MX_Loader {

    public function widget($widget_directory, $agrs = array()) 
    {
        
        // Đường dẫn đến file controller widget
        $path = APPPATH . 'widgets/' . $widget_directory . '/controller.php';
         
        // Tên controller widget
        $class_name = ucfirst(str_replace('/', '_', $widget_directory)) . '_widget';
 
        // Kiểm tra widget tồn tại ko
        if (!file_exists($path)) {
            show_error('The Widget ' . $path . ' Not Found');
        }
 
        //--------------------------------
        // Tạo đường dẫn để load file view trong widget
        $this->_ci_view_paths = array(APPPATH . 'widgets/' . $widget_directory . '/' => TRUE);
 
        //--------------------------------
        // Load Widget
        require_once($path);
 
        if (!class_exists($class_name)) {
            show_error("Class Name Widget $class_name Not Found, URL Is $path");
        }
 
        $MD = new $class_name;
 
        if (!method_exists($MD, 'index')) {
            show_error("Method Index Of Widget $class_name Not Found, URL Is $path");
        }
 
        ob_start();
        call_user_func_array(array($MD, 'index'), $agrs);
        $content = ob_get_contents();
        ob_end_clean();
 
        // Trả lại phương thức load views cho hệ thống CI
        $this->_ci_view_paths = array(APPPATH . 'views/' => TRUE);
 
        return $content;
    }
}