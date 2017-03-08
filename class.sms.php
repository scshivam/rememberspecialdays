<?php

include_once "cprint.php";

class sms
{
    var $username,$password;
    var $curl,$server,$data;

    public function __construct()
    {
        $this->curl=new cURL();
        //$this->curl->setProxy("");
        $this->data=array();
    }

    public function setGateway($serverName)
    {
        switch($serverName)
        {
            case 'way2sms':
            $this->server='way2sms';
            break;
            
            default :
            print "Currently only Way2sms is supported";
            break;
        }
    }
    public function login($username,$password)
    {
        $server=$this->server;
        return(call_user_func(array($this,"login_$server"),$username,$password));
    }

    public function send($number,$msg)
    {
        $server=$this->server;
        return(call_user_func(array($this,"send_$server"),$number,$msg));
    }

    private function login_way2sms($username,$password)
    {
        $html=($this->curl->post("http://www.way2sms.com","1=1"));

        if (!preg_match("/Location:(.*)\n/",$html,$matches)) {
            print("Error getting domain");
            cprint($html);
            return(0);
        }

        $domain=trim($matches[1]);
        $this->data['domain']=$domain;
        cprint("Domain:$domain");

        $html= $this->curl->post(
            "${domain}Login1.action",
            "username=$username&password=$password&Submit=Sign+in"
        );


        if (!preg_match('/<h3>Welcome to Way2SMS<.h3>/',$html)) {
            print("Error Logging In");
            print($html);
            return(0);
        }


        if (!preg_match("/Location:(.*)[?]id=(.*)\n/",$html,$matches)) {
            print("Error getting location & token");
            cprint($html);
            return(0);
        }

        $referer=trim($matches[1]);
        $token=trim($matches[2]);
        $this->data['referer']=$referer;
        $this->data['token']=$token;
        cprint("Referer:$referer");
        cprint("Token:$token");
        return(1);
    }
    
     
    private function send_way2sms($number,$msg)
    {
        $domain=$this->data['domain'];
        $token=$this->data['token'];

        $html=$this->curl->post(
            "{$domain}main.action?section=s",
            "vfType=register_verify&Token=${token}",
            $this->data['referer']
        );

        $msg=urlencode($msg);
        $html=$this->curl->post(
            "{$domain}smstoss.action",
            "ssaction=ss&Token=${token}&mobile=$number&message=$msg"
        );

        if (!preg_match('/Message has been submitted successfully/',$html)) {
            print("Error in sending sms");
            print($html);
            return(0);
        }
        else {
            echo "<script type=\"text/javascript\">alert('OTP Successfully sent');</script>";
            return(1);
        }
    }

}

?>