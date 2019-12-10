<?php
class Service extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        check_login_user();
        $this->load->model('Service_model');
    } 

    /*
     * Listing of services
     */
    function index()
    {
        $data['services'] = $this->Service_model->get_all_services();
        
        $data['main_content'] = $this->load->view('admin/service/index',$data, TRUE);
        $this->load->view('admin/index',$data);
    }

    /*
     * Adding a new service
     */
    function add()
    {   
        $this->load->library('form_validation');

		$this->form_validation->set_rules('code','Code','required|is_unique[services.code]');
		
		if($this->form_validation->run())     
        {   
            $params = array(
				'name' => $this->input->post('name'),
				'code' => $this->input->post('code'),
				'sac_code' => $this->input->post('sac_code'),
				'royality' => $this->input->post('royality'),
            );
            
            $service_id = $this->Service_model->add_service($params);
            $this->session->set_flashdata('msg', 'Service added Successfully');           
            redirect('admin/service/index');
        }
        else
        {            
            $data['main_content'] = $this->load->view('admin/service/add',null,  TRUE);
            $this->load->view('admin/index',$data);
        }
    }  

    /*
     * Editing a service
     */
    function edit($id)
    {   
        // check if the service exists before trying to edit it
        $data['service'] = $this->Service_model->get_service($id);
        
        if(isset($data['service']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('code','Code','required|edit_unique[services.code.'.$data['service']['id'].']');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'name' => $this->input->post('name'),
					'code' => $this->input->post('code'),
					'sac_code' => $this->input->post('sac_code'),
					'royality' => $this->input->post('royality'),
                );

                $this->Service_model->update_service($id,$params); 
                $this->session->set_flashdata('msg', 'Service updated Successfully');           
                redirect('admin/service/index');
            }
            else
            {
                $data['main_content'] = $this->load->view('admin/service/edit', $data, TRUE);
                $this->load->view('admin/index',$data);
            }
        }
        else
            show_error('The service you are trying to edit does not exist.');
    } 

    /*
     * Deleting service
     */
    function remove($id)
    {
        $service = $this->Service_model->get_service($id);

        // check if the service exists before trying to delete it
        if(isset($service['id']))
        {
            $this->Service_model->delete_service($id);
            $this->session->set_flashdata('msg', 'Service deleted Successfully');           
            redirect('admin/service/index');
        }
        else
            show_error('The service you are trying to delete does not exist.');
    }
    
}