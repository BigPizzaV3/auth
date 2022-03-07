<?php

class Aes
{
    //密钥 须是16位
    public $key ;
 
    //偏移量
    public $iv = '1234567890123456';
 
    /**
     * 解密字符串
     * @param string $data 字符串
     * @return string
     */
    public function __construct()
    {
    	$this->key = '1234567890123456';
    }
 
    public  function decode($str)
    {
        return openssl_decrypt(base64_decode($str),"AES-128-CBC",$this->key,OPENSSL_RAW_DATA, $this->iv);
    }
 
    /**
     * 加密字符串
     * @param string $data 字符串
     * @return string
     */
    public  function encode($str)
    {
        return base64_encode(openssl_encrypt($str,"AES-128-CBC",$this->key,OPENSSL_RAW_DATA, $this->iv));
    }
 
}