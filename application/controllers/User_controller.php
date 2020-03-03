<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class FirstMissingException extends  Exception {};
class SecondMissingException extends  Exception {};
class ThirdMissingException extends  Exception {};

class User_controller extends REST_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('users_model');
	}

	public function forgot_password_post()
	{
		$response_status = 0;
		$response_message = "Something was wrong.";

		try
		{
			$missing_key = array();

			if($this->input->post('data') == null)
			{
				$missing_key[] = 'data';
			}
			else
			{
				$data = $this->input->post('data');
			}

				if(count($missing_key) == 0)
				{
			        $update_random_password = $this->users_model->random_password_update($random_password,$email);
			        if($update_random_password == TRUE)
			        {
			        	$response_status = 1;
			            $response_message = "Please check your mail for temporary password.";

			            $response = array("status" => $response_status, "message" => $response_message);
			            $this->response($response, REST_Controller::HTTP_OK);
			        }
				}
				else
				{
					throw new MissingException();
				}

		}
		catch(MissingException $ex)
		{
			$response_status = 0;
			$implode_missing_key = implode(', ', $missing_key);
            $response_message = $implode_missing_key." - is missing!";

            $response = array("status" => $response_status, "message" => $response_message);
            $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
		}


	}














}