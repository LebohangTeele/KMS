<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Process_invoices extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('sales_model');
        }

        public function index()
        {
            $data=array();
            $data['privilege_group'] = $this->session->userdata('privilege');
            //verify if user is logged in  and session is valid

            if($this->session->userdata('isUserLoggedIn')===true):
                $data=array();
                $data['privilege_group'] = $this->session->userdata('privilege');
                //verify if the logged in user belongs to the appropriate privilege group for this function
                if($data['privilege_group']==='admin'||$data['privilege_group']==='mgt'||$data['privilege_group']==='sales'):
                    $data['tab_title']='Sales dashboard';
                    $data['user_name']=$this->session->userdata('user_name');
                    $data['user_sname']=$this->session->userdata('user_sname');
                    $data['user_branch']=$this->session->userdata('user_branch');
                    $data['user_email']=$this->session->userdata('user_email');
                    $data['user_type']=$this->session->userdata('user_type');
                    $data['page_breadcrumb']=$this->router->class;
                    $data['search_string'] = '';
                    //select all quotations order according to last created from tbl_quotes
                    $data['quotations']=$this->sales_model->get_waiting_quotations();
                    $data['invoices_today']=$this->sales_model->get_processed_invoices();

                    $this->load->view('sales/process_invoices_temp_view',$data);
                    
                    //display in a table with link to open and view full quotation [link named details]
                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;
        }

        public function  quote_details()
        {
            $data['currency']="R ";
            $data['payment_modes']=$this->sales_model->get_payment_modes();
            $quote_name=array_values($this->input->post());
            $data['quote_details']=$this->sales_model->get_quotation_line_items(($quote_name[0]));
            $this->load->view('sales/quote_items_details_view',$data);
        }

        public function create_invoice()
        {
            print_r($_POST);
            if($_POST['paymentValue2']):
                $paid = number_format($_POST['paymentValue1']+$_POST['paymentValue2'],2,',','.');
                if($_POST['quote_total']===$paid):
                    echo "invoice settled with 1 payment";
                   // $this->sales_model->create_invoice_entry($paid);
                elseif($_POST['quote_total']<>$paid):
                    echo "invoice not settled with both payments";
                endif;
            else:
                $paid = ($_POST['paymentValue1']);
                if($_POST['quote_total']===$paid):
                    $this->sales_model->create_invoice_entry($_POST['quote_total']);
                    $this->load->view('sales/sales_invoice_temp_view');
                elseif($_POST['quote_total']<>$paid):
                    echo "invoice has a bill";
                endif;
            endif;
        }

        public function print_invoice()
        {
            print_r($this->input->get());
        }
    } 
?>