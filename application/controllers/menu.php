<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model', 'menu');
    }
    public  function index()
    {
        $data['kontol'] = $this->db->get('menu');
        $data['title'] = "Menu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->AddMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu was Added!!   
            </div>');
            redirect('menu');
        }
    }
    public function editMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->update('user_menu', ['menu' => $this->input->post('menu')]); // gives UPDATE mytable SET field = field+1 WHERE id = 2
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Menu was Update!!   
        </div>');
        redirect('menu');
    }
    public function deleteMenu($id)
    {
        $this->menu->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu was deleted!!   
            </div>');
        redirect('menu');
    }

    public function submenu()
    {
        $data['title'] = "Submenu Management";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['submenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $this->menu->AddSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            NewMenu was Added!!   
            </div>');
            redirect('menu/submenu');
        }
    }

    public function editSubMenu($id)
    {
        $this->menu->editSubMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        SubMenu was Update!!   
        </div>');
        redirect('menu/submenu');
    }

    public function subMenudelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Menu was deleted!!   
            </div>');
        redirect('menu/submenu');
    }
}
