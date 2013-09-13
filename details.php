<?php defined('BASEPATH') OR exit();

class Module_Raw_materials extends Module 
{
	public $version = '1.0.0';

	public function __construct()
	{
		parent::__construct();

		$this->load->driver('streams');
	}

	public function info()
	{
		$info = array(
			'name'	=> array(
				'en'	=> 'Raw Materials'
			),
			'description'	=> array(
				'en'	=> 'Manage Raw Materials'
			),
			'frontend'	=> true,
			'backend'	=> true,
			'menu'		=> 'content',
			'author'	=> 'Daksh H. Mehta',
			'sections'	=> array(
				'markets' => array(
	                'name'  => 'raw_materials:lbl.markets',
	                'uri'   => 'admin/raw_materials',
	            	'shortcuts' => array(
						array(
					 	   'name' => 'raw_materials:lbl.create_market',
						   'uri' => 'admin/raw_materials/form',
						   'class' => 'add'
						),
					),
	            ),
	            'regions' => array(
	                'name'  => 'raw_materials:lbl.regions',
	                'uri'   => 'admin/raw_materials/regions',
	            	'shortcuts' => array(
						array(
					 	   'name' => 'raw_materials:lbl.create_region',
						   'uri' => 'admin/raw_materials/regions/form',
						   'class' => 'add'
						),
					),
	            ),
			)
		);

		return $info;
	}

	public function install()
	{
		// Create Markets stream
		if($this->streams->streams->add_stream('Markets', 'markets', 'raw_materials'))
		{
			// Then, create Regions stream
			if($this->streams->streams->add_stream('Regions', 'regions', 'raw_materials'))
			{
				$regionsStream = $this->streams->streams->get_stream('regions', 'raw_materials');

				// Markets stream fields
				$marketsFields = array(
					array(
						'name'			=> 'Name',
						'slug'			=> 'name',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true,
						'title_column'	=> true // Not in documention, but I added.
					),
					array(
						'name'			=> 'Slug',
						'slug'			=> 'slug',
						'type'			=> 'slug',
						'extra'			=> array('slug_field' => 'name', 'space_type' => '-'),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true,
						'unique'		=> true // Not in documentation, but I added.
					),
					array(
						'name'			=> 'City',
						'slug'			=> 'city',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'State/Province/Region',
						'slug'			=> 'state',
						'type'			=> 'state',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'Expected Launch Date',
						'slug'			=> 'launch_date_expected',
						'type'			=> 'datetime',
						'extra'			=> array('use_time'	=> 'no', 'storage'	=> 'unix', 'input_type' => 'datepicker'),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'Actual Launch Date',
						'slug'			=> 'launch_date_actual',
						'type'			=> 'datetime',
						'extra'			=> array('use_time'	=> 'no', 'storage'	=> 'unix', 'input_type' => 'datepicker'),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Date Cancelled',
						'slug'			=> 'cancel_date',
						'type'			=> 'datetime',
						'extra'			=> array('use_time'	=> 'no', 'storage'	=> 'unix', 'input_type' => 'datepicker'),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Market Status',
						'slug'			=> 'status',
						'type'			=> 'choice',
						'extra'			=> array(
							'choice_type'	=> 'dropdown', 
							'default_value'	=> '1',
							'choice_data'	=> '1:Active
							2:Hiring
							3:Coming
							4:Inactive'
						),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'Region',
						'slug'			=> 'region',
						'type'			=> 'relationship',
						'extra'			=> array('choose_stream' => $regionsStream->id),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'Currency',
						'slug'			=> 'currency',
						'type'			=> 'text', // Keeping it as text, as no documentation available for dropdown values.
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> true
					),
					array(
						'name'			=> 'Showcase Director(s)',
						'slug'			=> 'default_director',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Photographer(s)',
						'slug'			=> 'default_photographer',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Videographer(s)',
						'slug'			=> 'default_videographer',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Production Assistant(s)',
						'slug'			=> 'default_prodassistant',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'DJ(s)',
						'slug'			=> 'default_dj',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Host(s)',
						'slug'			=> 'default_host',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Market Model',
						'slug'			=> 'model',
						'type'			=> 'text', // Don't find documentation for relational stream: models
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Facebook',
						'slug'			=> 'facebook',
						'type'			=> 'url',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					),
					array(
						'name'			=> 'Twitter',
						'slug'			=> 'twitter',
						'type'			=> 'url',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'markets',
						'required'		=> false
					)
				);

				// Regions stream fields
				$regionsFields = array(
					array(
						'name'			=> 'Country',
						'slug'			=> 'country',
						'type'			=> 'country',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'regions',
						'required'		=> true
					),
					array(
						'name'			=> 'Parent',
						'slug'			=> 'parent',
						'type'			=> 'relationship',
						'extra'			=> array('choose_stream' => $regionsStream->id),
						'namespace'		=> 'raw_materials',
						'assign'		=> 'regions',
						'required'		=> false
					),
					array(
						'name'			=> 'Regional Manager',
						'slug'			=> 'regional_manager',
						'type'			=> 'text',
						'namespace'		=> 'raw_materials',
						'assign'		=> 'regions',
						'required'		=> false
					),
				);
				if($this->streams->fields->add_fields($marketsFields))
				{
					// Add fields to regions stream of markets stream ( We cant duplicate slug within a same namespace. )
					$this->streams->fields->assign_field('raw_materials', 'regions', 'name', array(
						'required'		=> true,
						'title_column'	=> true
					));
					$this->streams->fields->assign_field('raw_materials', 'regions', 'slug', array(
						'required'		=> true,
						'unique'		=> true
					));
					$this->streams->fields->assign_field('raw_materials', 'regions', 'status', array(
						'required'		=> true
					));

					// Add other fields to regions as required.
					if($this->streams->fields->add_fields($regionsFields))
					{
						return true;
					}
					else
					{
						$this->uninstall();
						return false;
					}
				}
				else
				{
					$this->uninstall();
					return false;
				}
			} 
			else
			{
				$this->uninstall();
				return false;
			}
		}
		else
		{
			$this->uninstall();
			return false;
		}
	}

	public function uninstall()
	{
		$this->streams->utilities->remove_namespace('raw_materials');

		return true;
	}

	public function upgrade($oldVersion)
	{
		return true;
	}

	public function help()
	{
		return '';
	}
}