<?php defined('BASEPATH') OR exit();

class Admin_regions extends Admin_Controller
{
	protected $section = 'regions';
	
	public function __construct()
	{
		parent::__construct();

		log_message('debug', 'Raw Materials - Regions section intialized.');
		
		$this->load->driver('streams');
		$this->load->language('raw_materials');
	}

	public function index()
	{
		$this->load->model('regions_m');
		$where = array();
		// Filters 
		if($this->input->post('f_status'))
		{
			$where['status'] = (int) $this->input->post('f_status');
		}
		if($this->input->post('f_parent'))
		{
			$where['parent'] = (int) $this->input->post('f_parent');
		}

		$pagination = create_pagination('admin/raw_materials/regions/index2', $this->regions_m->count_by($where));
		$this->db->limit($pagination['limit'], $pagination['offset']);

		$regions = (count($where) == 0)
			? $this->regions_m->get_all()
			: $this->regions_m->get_many_by($where);

		if($this->input->is_ajax_request())
		{
			$this->template->set_layout(false);
		}

		// Filter parent options
		$options = array( '0' => lang('global:select-all'));
		foreach($regions AS $region)
		{
			$options[$region->id] = $region->name;			
		}

		$this->template
			->title($this->module_details['name'])
			->set('pagination', $pagination)
			->set('regions', $regions)
			->set('f_parent_opts', $options)
			->set_partial('filters', 'admin/partials/filters_regions')
			->append_js('admin/filter.js');

		$this->input->is_ajax_request() 
			? 	$this->template->build('admin/partials/table_regions') 
			: $this->template->build('admin/index');
	}
	
	public function form($id = false)
	{
		$_mode = ($id == false) ? 'new' : 'edit';
		$extra = array(
		    'return'            => 'admin/raw_materials/regions',
		    'success_message'   => lang('quiz.submit_success'),
		    'failure_message'   => lang('quiz.submit_failure'),
		    'title'             => lang('quiz.title.regions'.$_mode)
		);
		$this->streams->cp->entry_form('regions', 'raw_materials', $_mode, ($_mode == 'new') ? null : $id, true, $extra);
	}

	public function delete($id = false)
	{
		if($id != false)
		{
			$this->streams->entries->delete_entry($id, 'regions', 'raw_materials');
		}
		redirect('admin/raw_materials/regions');
	}
}