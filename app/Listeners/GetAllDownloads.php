<?php
namespace GFormProtected\Listeners;

class GetAllDownloads extends AJAXAdminListenerBase
{
	/**
	* Array of all Downloads
	*/
	private $downloads = array();

	public function __construct()
	{
		parent::__construct();
		$this->getDownloads();
		return $this->response($this->downloads);
	}

	/**
	* Get all Published Downloads
	*/
	private function getDownloads()
	{
		$dq = new \WP_Query(array(
			'post_type' => 'download',
			'posts_per_page' => -1
		));
		if ( $dq->have_posts() ) : 
			$c = 0;
			while ( $dq->have_posts() ) : $dq->the_post();
				$this->downloads[$c]['id'] = get_the_id();
				$this->downloads[$c]['title'] = get_the_title();
			$c++;
			endwhile;
		else :
			$this->error(__('There are currently no downloads', 'gfpd'));
		endif; wp_reset_postdata();
	}
}