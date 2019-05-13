<?php
class Pages extends CI_Controller {
        public function view($page = 'home') {
                if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                        // Whoops, we don't have a page for that!
                        show_404();
                }
                $logged = $this->session->userdata('logged');

                if (isset($logged) && $logged == true) {
                        $this->load->model('memberships_model');
                        if ($this->memberships_model->access_level() == 0){
                            header("Location: ".$this->config->item('base_url')."/logoff");
                        }
                        $data['title'] = ucfirst($page); // Capitalize the first letter

                        $this->load->view('templates/header', $data);
                        $this->load->view('pages/'.$page, $data);
                        $this->load->view('templates/footer', $data);
                } else {
                        $this->load->view('login/login_view');
                }
        }
}