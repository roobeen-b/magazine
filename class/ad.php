<?php 
	class ad extends database{
		function __construct(){
			$this->table = 'ads';
			database::__construct();
		}

		public function addAd($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getAdbyId($ad_id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $ad_id,
						)
					)
			);
			return $this->getData($args,$is_die);
		}

		public function getWideAd($is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status' => 'Active',
							
							'adType' => 'widead',
						)
					)
			);
			return $this->getData($args,$is_die);
		}

		public function getSimpleAd($is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'status' => 'Active',
							
							'adType' => 'simplead',
						)
					)
			);
			return $this->getData($args,$is_die);
		}

		public function getAllAd($is_die=false){
			$args = array(
					            
				'where' => array(
						'and' => array(
							'status'=>'Active',
						)
					)
			);
			return $this->getData($args,$is_die);
		}
		
		public function updateAdById($data,$id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $id,
						)
					)
			);
			return $this->updateData($data,$args,$is_die);
		}

		public function deleteAdById($id,$is_die=false){
			$args = array(
				'where' => array(
						'and' => array(
							'id' => $id,
						)
					)
			);
			return $this->deleteData($args,$is_die);
		}
	}

 ?>