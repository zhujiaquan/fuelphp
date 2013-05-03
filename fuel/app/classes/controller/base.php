<?php

class Controller_Base extends Controller
{
    public function before()
    {
        parent::before();
        
        // 初期処理
        // POSTチェック
        $post_methods = array(
            'created',
            'updated',
            'removed',
        );
        $method = Uri::segment(2);
        if (Input::method() !== 'POST' && in_array($method, $post_methods)) 
        {
            Response::redirect('users/timeout');
        }
        
        // ログインチェック
        $auth_methods = array(
            'logined',
            'logout',
            'update',
            'remove',
        );
        if (in_array($method, $auth_methods) && !Auth::check()) 
        {
            Response::redirect('users/login');
        }
        
        // ログイン済みチェック
        $nologin_methods = array(
            'login',
        );
        if (in_array($method, $nologin_methods) && Auth::check()) 
        {
            Response::redirect('users/logined');
        }
        
        // CSRFチェック
        /*
        if (Input::method() === 'POST') 
        {
            if (!Security::check_token()) 
            {
                Response::redirect('users/timeout');
            }
        }
        */
    }
    
    public function after($response)
    {
        return parent::after($response);
    }
}
