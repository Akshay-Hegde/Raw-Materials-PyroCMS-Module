<?php defined('BASEPATH') OR exit();

class Admin extends Admin_Controller
{
	protected $section = 'markets';
	
	public function __construct()
	{
		parent::__construct();

		$this->load->driver('streams');
		$this->load->language('raw_materials');
	}

	public function index()
	{
		$extra['title']	= lang('raw_materials:title.markets.index');
		$extra['columns'] = array(
			'name', 
			'default_director', 
			'status', 
			'launch_date_expected', 
			'launch_date_actual'
		);
		$extra['sorting'] = true;
		$extra['buttons'] = array(
			array(
		        'label'     => lang('global:edit'),
		        'url'       => 'admin/raw_materials/form/-entry_id-'
		    ),
		    array(
		        'label'     => lang('global:delete'),
		        'url'       => 'admin/raw_materials/delete/-entry_id-',
		        'confirm'   => true
		    )
		);
		$this->streams->cp->entries_table('markets', 'raw_materials', 50, 'admin/raw_materials/index', true, $extra);		
	}

	public function form($id = false)
	{
		$_mode = ($id == false) ? 'new' : 'edit';
		$extra = array(
		    'return'            => 'admin/raw_materials',
		    'success_message'   => lang('raw_materials:msg.success'),
		    'failure_message'   => lang('raw_materials:msg.failure'),
		    'title'             => lang('quiz.title.markets'.$_mode)
		);
		$this->streams->cp->entry_form('markets', 'raw_materials', $_mode, ($_mode == 'new') ? null : $id, true, $extra);
	}

	public function delete($id = false)
	{
		if($id != false)
		{
			$this->streams->entries->delete_entry($id, 'markets', 'raw_materials');
		}
		redirect('admin/raw_materials');
	}
}