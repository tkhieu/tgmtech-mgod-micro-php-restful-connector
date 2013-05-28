<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TGMToken
 *
 * @author hieu
 */
class TGMToken {
    //put your code here
    
    private $key = "GuN4fM2NjQE6wgpEwrRhhqX2kajTsnKDEUZ7TS9J75Jus5XMhK";
    private $secret = "cjpmrJG7nRqD9NDRFRKJSwNZKZybKe69Vt8Qd8cxmCEMGxSzPvGd4u4ftUDvZSWqV9hPmcWDytmb3UxshTKgGMUB72jaed7BBPRr";
    
    public function check($param) {
        $sign = $param["sign"];
        $app_key = $param["key"];
        $timestamp = $param["timestamp"];
        
        if($app_key == $this->key){
            /* @var $secret type */
            $check = $this->key . md5($timestamp) . $this->secret;
            echo $check. "<br />";
            
            $check_md5 = md5($check);
            echo $check_md5. "<br />";
            
            if($check_md5 == $sign)
                echo "a";
            else echo "b";
        }
        
        
    }

    
    
}

?>
