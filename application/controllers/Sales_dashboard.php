<?php
    defined('BASEPATH') OR exit ('No direct script access allowed');
    class Sales_dashboard extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('sales_model');
            $this->load->library('cart');
        }

        /**
         * When a user is logged in and the user has salesman's rights the system directs him to the sales dashboard
         * The dashboard initializes with:
         *  1. A search bar where the user can enter the part number or part name or model number
         *  2. On hitting the search button a table that shows the parts search for with their
         *          price 
         *          description 
         *          quantity for that particular branch 
         *          quantity for that part in other branches
         *          for every row returned for the search an option to add to cart is also includeded
         *  $data array variables 1. privilege_group
         *                        2. isUserLoggedIn
         *                        3. privilege
         *                        4. results
         *                        5. tab_title
         *                        6. user_name,_sname,_branch,_email,_type
         *                        7. page_breadcrumb
         *                        8. search_string
         *                        9. data
         */
        public function index()
        {
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
                    // $this->load->view('elements/universal_header_element',$data);
                    // $this->load->view('elements/sales/left_aside_view',$data);
                    // $this->load->view('elements/sales/right_aside_view');
                    // $this->load->view('elements/universal_top_bar_element');
                    // $this->load->view('sales/sales_landing_view',$data);
                    // $this->load->view('elements/sales/sales_footer');                    
                    //fetch appropriate data from the database
                    $data['customers'] = array();
                    $this->load->view('sales/sales_temporary_view',$data);
                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;
        }


        public function part_search()
        {
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
                    $data['search_string'] = $_POST['part_searched'];
                    if(isset($_POST['part_searched'])):
                        $data['current_search']=$data['search_string'];
                    endif;
                    $data['data']=json_decode(json_encode($this->sales_model->get_parts($data['current_search'])),true);
                    $data['branch1'] = array_slice($data['data'],0,(count($data['data'])/2));
                    $data['branch2'] = array_slice($data['data'],(count($data['data'])/2));
                    $data['customers'] = array();//$this->sales_model->get_registered_customers(); 

                    $this->load->view('sales/sales_temporary_view',$data);
                    //fetch appropriate data from the database


                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;
        }
        /**
         *  When the user who is registered as a salesman hits the add to cart button
         *  the part is added to the list for the shopping cart in preparation for check out or ticket/quotation printing and creating a sales entry
         */
        public function add_to_cart()
        {
            // $this->session->set_flashdata('current_search',$_POST['current_search']);
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
                    


                    $data['current_search'] = $this->input->post('current_search');
                            $insert_data= array(
                                                    'id'=>$this->input->post('id'),
                                                    'number'=>$this->input->post('number'),
                                                    'name'=>$this->input->post('name'),
                                                    'price'=>$this->input->post('price'),
                                                    'model'=>$this->input->post('model'),
                                                    'qty'=>1,
                                                    'discount'=>1
                                                );
                            $this->cart->insert($insert_data);

                    if($this->session->flashdata('current_search')):
                        $data['data']=json_decode(json_encode($this->sales_model->get_parts($_POST['current_search'])),true);
                        $data['branch1'] = array_slice($data['data'],0,(count($data['data'])/2));
                        $data['branch2'] = array_slice($data['data'],(count($data['data'])/2));
                    endif;
                    $data['customers'] = array();//$this->sales_model->get_registered_customers(); 
                    $data['last_search']=true;
                    //$this->load->view('sales/sales_landing_view',$data);
                    $this->show_cart();

                    //fetch appropriate data from the database
                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;

        }

        public function show_cart()
        {
            $this->load->view('sales/cart_view');
        }

        public function view()
        {
            if(count($this->cart->contents())===0):
                echo "<h4>Empty</h4>";
            else:
                $this->load->view('sales/cart_view');
            endif;
        }
        public function  print_ticket()
        {
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

                    $data['cart'] = $this->cart->contents();
                    $data['total']=$this->cart->total();
           
                    $data['quote_items']=$this->sales_model->process_quotation();
                    
                    $data['branch_name']=$this->sales_model->get_branch_name();
                    $data['company_logo']=$this->sales_model->get_company_logo();
                    $data['company_registration']=$this->sales_model->get_company_registration();
                    $data['company_tax_registration']=$this->sales_model->get_company_tax_number();
                    $data['company_phone']=$this->sales_model->get_company_contact_details()['phone']." / ".$this->sales_model->get_company_contact_details()['phone_extension'];
                    $data['company_address']=$this->sales_model->get_company_contact_details()['address'];
                    $data['customer_name']="";
                    $data['customer_address']="stub";
                    $data['customer_tax_registration']="stub";
                    $data['quotation_number']=$this->sales_model->get_quotation_number();
                    //$this->load->view('sales/print_quote_view',$data);
                    $this->load->view('sales/sales_quote_temp_view',$data);
                    //fetch appropriate data from the database
                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;

        }

        public function process_refunds()
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
                    $data['details_button']=false;

                    $data['invoices']=$this->sales_model->get_waiting_invoices();
                    $this->load->view('sales/sales_refunds_temp_view',$data);
                    // $this->load->view('sales/process_refunds_view',$data);
                    // $this->load->view('elements/sales/sales_footer');

                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;
        }
        public function  refund_details()
        {
            $data['currency']="R ";
            $quote_id=array_values($this->input->post());
            $data['details_button']=true;
            $data['invoice_details']=$this->sales_model->get_invoice_line_items((array_values($this->input->post())[0]));
            $_SESSION['invoice_details']=$data['invoice_details'];
            $this->load->view('sales/refund_items_details_view',$data);
            
        }
        public function refund_finito()
        {
            
            echo $this->sales_model->refund_all();
        }
        public function process_invoices()
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
                    $data['details_button']=false;
                    $data['quote_items']=$this->sales_model->process_quotation();
                    
                    $data['branch_name']=$this->sales_model->get_branch_name();
                    $data['company_logo']=$this->sales_model->get_company_logo();
                    $data['company_registration']=$this->sales_model->get_company_registration();
                    $data['company_tax_registration']=$this->sales_model->get_company_tax_number();
                    $data['company_phone']=$this->sales_model->get_company_contact_details()['phone']." / ".$this->sales_model->get_company_contact_details()['phone_extension'];
                    $data['company_address']=$this->sales_model->get_company_contact_details()['address'];
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
                            $all=$this->sales_model->create_invoice_entry($_POST['quote_total']);
                            $data['invoice_line_items']=$all['invoice_line_items'];
                            $data['invoice_data']=$all['insert_array'];
                            $this->load->view('sales/sales_invoice_temp_view',$data);
                        elseif($_POST['quote_total']<>$paid):
                            echo "invoice has a bill";
                        endif;
                    endif;
                else:
                    //view is not allowed for the user's assigned privilege
                endif;
            else:
                //if user is not logged in send the system to log in page
                redirect('auth/login');
            endif;

        }
        public function test()
        {
            
            $data['results'] = $this->sales_model->process_refund();
            $this->load->view('sales/refunded_today_view',$data);
        }


    }
?>