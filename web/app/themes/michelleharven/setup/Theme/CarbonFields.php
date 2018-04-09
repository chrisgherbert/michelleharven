<?php

namespace Theme;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

class CarbonFields {

	public $containers = [
		'resume_journalism',
		'resume_additional',
		'resume_education',
		'resume_skills'
	];

	public function __construct(){

		// Execute all the "container" methods
		if ($this->containers){
			foreach ($this->containers as $container){
				add_action('carbon_fields_register_fields', [$this, $container]);
			}
		}

		// Init Carbon Fields
		add_action('after_setup_theme', function(){
			\Carbon_Fields\Carbon_Fields::boot();
		});

	}

	public function resume_journalism(){
		Container::make('post_meta', 'resume_journalism', 'Journalism Experience Items')
			->where('post_template', '=', 'page-resume.php')
			->add_fields([
				Field::make('complex', 'journalism_experience_items', 'Items')
					->add_fields([
						Field::make('text', 'employer_name', 'Employer Name'),
						Field::make('text', 'job_title', 'Job Title'),
						Field::make('text', 'duration', 'Dates'),
						Field::make('rich_text', 'description', 'Description')
					])
			]);
	}

	public function resume_additional(){
		Container::make('post_meta', 'resume_additional', 'Additional Experience Items')
			->where('post_template', '=', 'page-resume.php')
			->add_fields([
				Field::make('complex', 'additional_experience_items', 'Items')
					->add_fields([
						Field::make('text', 'employer_name', 'Employer Name'),
						Field::make('text', 'job_title', 'Job Title'),
						Field::make('text', 'duration', 'Dates'),
						Field::make('rich_text', 'description', 'Description')
					])
			]);
	}

	public function resume_education(){
		Container::make('post_meta', 'resume_education', 'Education')
			->where('post_template', '=', 'page-resume.php')
			->add_fields([
				Field::make('complex', 'education_items', 'Education Items')
					->add_fields([
						Field::make('text', 'employer_name', 'School Name'),
						Field::make('text', 'duration', 'Dates'),
						Field::make('rich_text', 'description', 'Description')
					])
			]);
	}

	public function resume_skills(){
		Container::make('post_meta', 'resume_skills', 'Skills')
			->where('post_template', '=', 'page-resume.php')
			->add_fields([
				Field::make('complex', 'skills', 'Skills')
					->add_fields([
						Field::make('text', 'skill', 'Skill'),
					])
			]);
	}

}