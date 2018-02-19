<?php
	// Jquery UI, LiveQuery plugins used
	 
	require_once("multipleDiv.inc.php");
	
	// Initiate Object
	$obj = new Multiplediv();
	
	// Add or Update Ajax Call
	if(isset($_GET['m_id']) and isset($_GET['g_id']))
		{
			$obj->addMembers((int)$_GET['m_id'], (int)$_GET['g_id']);
			exit;
		}
		
	// Remove Memebers from groups Ajax call
	if(isset($_GET['do']))
		{
			$obj->removeMember($_GET['mid']);
			exit;
		}
	
	// Reload groups each ajax call
	if(isset($_GET['reload'])){ echo $obj->getMembers_reload(); exit; }
	if(isset($_GET['reload_groups'])){ echo $obj->getmembergroups_reload(); exit; }
	
	// Initiate Groups and members		
	$members = $obj->public_members();
	$groups = $obj->groups();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Google+ Style Drag and Drop</title> 
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.js"></script>
<script type="text/javascript" src="jquery.livequery.min.js"></script>
<style type="text/css">
body { font-family:verdhana; font-size: 12px; text-align: center; }
#main_portion{ width:1100px; text-align: left; padding:0; float: left;}
#public { width:95%; border-bottom:3px dotted #ccc; height:137px;  padding:10px; }
.members{ cursor: pointer;width:180px; position: relative; float: left; border:1px dotted #ccc; text-align: left; padding:3px;font-size: 14px; margin-top: 3px; margin-left: 3px;z-index:999;}
.members img{ padding:2px; border:1px solid #ccc; float:left;}
#groupsall{ clear:both; width:100%; height:auto; padding:10px; padding-left: 0px; margin-top: 5px; }
.group{ float:left; position:relative; width:250px; border:1px solid #ccc; padding:3px; margin-left: 9px; text-align: left; min-height:70px; height:auto; background-color:#f5f5f5; z-index:0;}
.group ul{ padding:0; margin:0;}
.group li { float:left; list-style: none; padding:2px;}
.add{ position: absolute; z-index:99;}
.remove{ position: absolute; z-index:99;}
h2{ text-align: left;}
h1{ font-family: 'Love Ya Like A Sister', cursive; color: #cc0000; font-size: 40px;}
h4{ font-family: 'Love Ya Like A Sister', cursive; }
</style> 
<script type="text/javascript" >
	$(function() {	
	
		// Initiate draggable for public and groups
		var $gallery = $( ".members, .group" );
		$( "img", $gallery ).live("mouseenter", function(){
			 var $this = $(this);
			  if(!$this.is(':data(draggable)')) {
			    $this.draggable({
			     	helper: "clone",
					containment: $( "#demo-frame" ).length ? "#demo-frame" : "document", 
					cursor: "move"
			    });
			  }
		});
		
		// Initiate Droppable for groups
		// Adding members into groups
		// Removing members from groups
		// Shift members one group to another
		
		$(".group").livequery(function(){
			var casePublic = false;
			$(this).droppable({
				activeClass: "ui-state-highlight",
				drop: function( event, ui ) {
					var m_id = $(ui.draggable).attr('rel');
					if(!m_id)
						{
							casePublic = true;
							var m_id = $(ui.draggable).attr("id");
							m_id = parseInt(m_id.substring(3));
						}					
					var g_id = $(this).attr('id');
					dropPublic(m_id, g_id, casePublic);
					$("#mem"+m_id).hide();
					$( "<li></li>" ).html( ui.draggable ).appendTo( this );
				},
				 out: function(event, ui) {
				 	var m_id = $(ui.draggable).attr('rel');
					var g_id = $(this).attr('id');			 	
				 	$(ui.draggable).hide("explode", 1000);
				 	removeMember(g_id,m_id);
				 }
			});
		});
		
		// Add or shift members from groups
		function dropPublic(m_id, g_id,caseFrom)
			{
				$.ajax({
					type:"GET",
					url:"groups.php?m_id="+m_id+"&g_id="+g_id,
					cache:false,
					success:function(response){						
						$.get("groups.php?reload_groups", function(data){ 
							$("#groupsall").html(data);
							$("#added"+g_id).animate({"opacity" : "10" },10);
							$("#added"+g_id).show();
							$("#added"+g_id).animate({"margin-top": "-50px"}, 450);
							$("#added"+g_id).animate({"margin-top": "0px","opacity" : "0" }, 450);
						});
					}
				});
			}
		// Remove memebers from groups
		// It will restore into public groups or non grouped members
		function removeMember(g_id,m_id)
			{
				$.ajax({
					type:"GET",
					url:"groups.php?do=drop&mid="+m_id,
					cache:false,
					success:function(response){
						$("#removed"+g_id).animate({"opacity" : "10" },10);
						$("#removed"+g_id).show();
						$("#removed"+g_id).animate({"margin-top": "-50px"}, 450);
						$("#removed"+g_id).animate({"margin-top": "0px","opacity" : "0" }, 450);
						$.get("groups.php?reload", function(data){ $("#public").html(data); });
					}
				});
			}	
		
	});
</script>
</head> 
<body> 

<div id="main_portion">
	<div id="public">
	<h2>Friends</h2>
	<!-- Initiate members -->
		<?php
		if(!isset($members))
			$members = $obj->public_members();
			
			if($members)
				{
					foreach($members as $member)
						{
							extract($member);
							echo "<div class='members' id='mem".$member_id."'>\n";
							echo "<img src='images/".$member_image."' rel='".$member_id."'>\n";
							echo "<b>".ucwords($member_name)."</b>\n";
							echo "</div>";								
						}
				}
			else
				echo "<h2><center>Members not available</center></h2>";
		?>
	</div>
	<div id="groupsall">
	<!-- Initiate Groups -->
	<h2>Groups</h2>
		<?php
			if(!isset($groups))
				$groups = $obj->groups();
			if($groups)
				{
					foreach($groups as $group)
						{
							extract($group);
							echo "<div id='".$group_id."' class='group'>\n";
							echo ucwords($group_name);
							echo "<div id='added".$group_id."' class='add' style='display:none;' ><img src='images/green.jpg' width='25' height='25'></div>";
							echo "<div id='removed".$group_id."' class='remove' style='display:none;' ><img src='images/red.jpg' width='25' height='25'></div>";
							echo "<ul>\n";
							echo $obj->updateGroups($group_id);
							echo "</ul>\n";
							echo "</div>";								
						}
				}
		?>
	</div>
</div>
</body> 
</html> 