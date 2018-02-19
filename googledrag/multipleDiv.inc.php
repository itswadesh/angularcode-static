<?php
// Database declaration's
define("SERVER", "mysql3.000webhost.com");

define("USER", "a5214129_fb");

define("PASSWORD", "facebook0");

define("DB", "a5214129_fb");

		class Multiplediv
			{
				// db tables
				private $_tgroups = "groups";
				private $_tusers = "users";
				private $_tmembers = "members";
				private $_usergroups = "user_group";
				
				private $_con = "";
				
				// Construct Database connection		
				
				public function __construct()
					{
						if($this->db_connection())
							$this->_con = $this->db_connection();
						else
							echo "Database connection failed.,";
					}  
					
				// Database connection function
				
				private function db_connection()
					{
						$connection = mysql_connect(SERVER, USER, PASSWORD);
						if($connection)
							{
								mysql_select_db(DB, $connection);
								return $connection;
							}
						else
							return false; 
					}
						
				// load's available non groued members		
				public function public_members()
					{
						$result = array();
						$grouped_members = $this->getGroupedMembers();
							$qry = mysql_query("SELECT member_id, member_name, member_image FROM ".$this->_tmembers." ORDER BY member_name");
						if(mysql_num_rows($qry))
							{
								while($rows = mysql_fetch_array($qry))
									{
										if($grouped_members)
											{
												if(!in_array($rows['member_id'], $grouped_members))
													$result[] = $rows;
											}
										else
											$result[] = $rows;										
									}
							}
						return $result;
					}	
					
				// get member id
				private function getGroupedMembers()
					{
						$ids = array();
						$qry = mysql_query("SELECT member_id FROM ".$this->_usergroups." GROUP BY member_id");
						if(mysql_num_rows($qry) > 0)
							{
								while($a = mysql_fetch_array($qry))
									$ids[] = $a['member_id'];
							}
						return $ids;
					}
				
				// Delete users from groups
				public function removeMember($mid)
					{
						if($mid)
							{
								mysql_query("DELETE FROM ".$this->_usergroups." WHERE member_id = ".$mid);
							}
					}
				
				// get members on groups
					
				public function updateGroups($group_id)
					{
						$html = "";
						$qry = mysql_query("SELECT a.member_id, b.member_image FROM ".$this->_usergroups." a, ".$this->_tmembers." b WHERE b.member_id = a.member_id AND a.group_id = ".$group_id." GROUP BY member_id");
						if(mysql_num_rows($qry) > 0)
							{
								while($a = mysql_fetch_array($qry))
									$html .= "<li><img src='images/".$a['member_image']."' rel='".$a['member_id']."'></li>\n";
							}
						return $html;
					}
					
				// Get's available groups
				
				public function groups()
					{
						$result = array();
						$qry = mysql_query("SELECT group_id, group_name FROM ".$this->_tgroups." ORDER BY sort");
						if(mysql_num_rows($qry))
							{
								while($rows = mysql_fetch_array($qry))
									$result[] = $rows;
							}
						return $result;
					}
					
				// Add or shift members into groups
				public function addMembers($member_id, $group_id)
					{
						$user_id = 1;
						if($member_id and $group_id)
							{
								$check = mysql_query("SELECT 1 FROM ".$this->_usergroups." WHERE member_id = ".$member_id);
								if(mysql_num_rows($check) > 0)
									$qry = mysql_query("UPDATE ".$this->_usergroups." SET group_id = ".$group_id." WHERE member_id = ".$member_id);
								else
									$qry = mysql_query("INSERT INTO ".$this->_usergroups." (user_id, group_id, member_id, sort)VALUES('".$user_id."','".$group_id."','".$member_id."', sort+1)");
							}
					}
					
				// Public members reload after ajax call
				public function getMembers_reload()
					{
						$members = $this->public_members();
						$html = "";
							if($members)
								{
									foreach($members as $member)
										{
											extract($member);
											$html .= "<div class='members' id='mem".$member_id."'>\n";
											$html .= "<img src='images/".$member_image."' rel='".$member_id."'>\n";
											$html .= "<b>".ucwords($member_name)."</b>\n";
											$html .= "</div>";								
										}
								}
							else
								$html .= "<h2><center>Members not available</center></h2>";	
						return $html;
					}
					
				// Grouped members reload after ajax call
				public function getmembergroups_reload()
					{
						$groups = $this->groups();
						$html = "";
						if($groups)
							{
								foreach($groups as $group)
									{
										extract($group);
										$html .= "<div id='".$group_id."' class='group'>\n";
										$html .= ucwords($group_name);
										$html .= "<div id='added".$group_id."' class='add' style='display:none;' ><img src='images/green.jpg' width='25' height='25'></div>";
										$html .= "<div id='removed".$group_id."' class='remove' style='display:none;' ><img src='images/red.jpg' width='25' height='25'></div>";
										$html .= "<ul>\n";
										$html .= $this->updateGroups($group_id);
										$html .= "</ul>\n";
										$html .= "</div>";								
									}
							}
						return $html;
					}			
				
			}	
	
?>