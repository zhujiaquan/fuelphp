<?php

class Controller_Users extends Controller_Base
{
    public function action_index()
    {
        return Response::forge( View::forge("users/index"), 200 );
    }
    
    public function action_signup()
    {
        try
        {
            // Setup Validation
            $val = Validation::forge('signup_user');

            // Set validation rules
            $val->add('username', 'Username')
                ->add_rule('required')
                ->add_rule('min_length', 3)
                ->add_rule('max_length', 20);

            $val->add('password', 'Password')
                ->add_rule('required')
                ->add_rule('min_length', 3)
                ->add_rule('max_length', 20);

            $val->add('email', 'Email Address')
                ->add_rule('required')
                ->add_rule('valid_email');

            // Validate
            if ($val->run())
            {
                // Create user
                if ( Auth::instance()->create_user($val->validated('username'), $val->validated('password'), $val->validated('email'), 1) )
                {
                    Session::set_flash('success', 'Thanks for registering!');
                    Response::redirect('users/index');
                }
                else
                {
                    throw new Exception('An unexpected error occurred. Please try again.');
                }
            }
            else
            {
                $val->set_message('valid_email', 'The field :label is not a valid email address.');
            }
        }
        catch(SimpleUserUpdateException $ex)
        {
            Session::set_flash('failed', $ex->getMessage());
        }
        catch(Exception $ex)
        {
            Session::set_flash('failed', $ex->getMessage());
        }
        return Response::forge( View::forge('users/signup')->set('val', $val, false), 200 );
    }

    public function action_login()
    {
        // Setup Validation
        $val = Validation::forge('login_user');

        // Set validation rules
        $val->add('username', 'Username')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        $val->add('password', 'Password')
            ->add_rule('required')
            ->add_rule('min_length', 3)
            ->add_rule('max_length', 20);

        // Validate
        if ($val->run())
        {
            // Authenticate user
            if ( Auth::instance()->login($val->validated('username'), $val->validated('password')) )
            {
                Response::redirect('users/index');
            }
            else
            {
                Session::set_flash('error', 'Incorrect username or password Please try again.');
                Response::redirect('users/login');
            }
        }

        return Response::forge( View::forge('users/login')->set('val', $val, false), 200 );
    }
}
