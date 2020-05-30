<?php
	class follow extends database{
		function __construct(){
			$this->table = 'follows';
			database::__construct();
		}
		public function addFollowIcons($data,$is_die=false){
			return $this->addData($data,$is_die);
		}

		public function getFollowIconsbyId($follow_id,$is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $follow_id,
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function getAllFollowIcons($is_die=false){
			
			$args = array(
				'where'	=> array(
					'and' => array(
							'status' => 'Active',
						)
					)
				);

			return $this->getData($args,$is_die);
		}

		public function updateFollowIconsbyId($data,$id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->updateData($data,$args,$is_die);
		}

		public function deleteFollowIconsbyId($id,$is_die=false){
			$args = array(
				'where'	=> array(
					'and' => array(
							'id' => $id,
						)
					)
				);

			return $this->deleteData($args,$is_die);
		}
	}

?>