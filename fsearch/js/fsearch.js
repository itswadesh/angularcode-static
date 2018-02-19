/**
* fSearch 2.0 - jQuery plugin for facebook type search suggestions
*
* http://www.codenx.com/
*
* Copyright (c) 2013 Ipsita Sahoo 
*/
(function($){
$.fn.fsearch = function(){
  var $searchInput = $(this);
  $searchInput.after('<div id="divResult"></div>');
  $resultDiv = $('#divResult');
  $searchInput.focus();
  $searchInput.addClass('searchi');
  $resultDiv.html("<ul></ul><div id='search-footer' class='searchf'></div>");
  $searchInput.keyup(function(e) {
  var q=$(this).val();
    if(q != '')
    { 
      var current_index = $('.selected').index(),
      $options = $resultDiv.find('.option'),
      items_total = $options.length;

      // When Down Arrow key is pressed
      if (e.keyCode == 40) {
          if (current_index + 1 < items_total) {
              current_index++;
              change_selection($options,current_index);
          }
      } 

      // When Up Arrow is pressed
      else if (e.keyCode == 38) {
          if (current_index > 0) {
              current_index--;
              change_selection($options,current_index);
          }
      }

      // When enter key is pressed
      else if(e.keyCode == 13){
        var id = $resultDiv.find('ul li.selected').attr('id');
        var name = $resultDiv.find('ul li.selected').find('.name').text();
        $searchInput.val(name); 
        $resultDiv.fadeOut();// Here you get the id and name of the element selected. You can change this to redirect to any page too. Just like facebook.   
      }
      else{
      $resultDiv.fadeIn();
      $resultDiv.find('#search-footer').html("<img src='img/loader.gif' alt='Collecting Data...'/>");
      
      // Query search details from database
      var calculationRequest = null;
      
        if(calculationRequest != null)
        calculationRequest.abort();
        calculationRequest = $.getJSON("json.php",{searchword: q},function(jsonResult)
        { 
          var str='';
          for(var i=0; i<jsonResult.length;i++)
            {
              str += '<li id=' + jsonResult[i].uid + ' class="option"><img class="profile_image" src="photos/'+jsonResult[i].media+'" alt="'+jsonResult[i].username+'"/><span class="name">' + jsonResult[i].username + '</span><br/>'+jsonResult[i].country+'</li>';
            }
            $resultDiv.find('ul').empty().prepend(str);
            $resultDiv.find('div#search-footer').text(jsonResult.length + " results found...");
            $resultDiv.find('ul li').first().addClass('selected');
        }); 

        $resultDiv.find('ul li').live('mouseover',function(e){
        current_index = $resultDiv.find('ul li').index(this);
        $options = $resultDiv.find('.option');
        change_selection($options,current_index);
      });

      // Change selected element style by adding a css class
      function change_selection($options,current_index){
        $options.removeClass('selected');
        $options.eq(current_index).addClass('selected');
        }
      }
    }
    else{
      //Hide the results if there is no search input
      $resultDiv.hide();
    }
  });    

  // Hide the search result when clicked outside
  jQuery(document).live("click", function(e) { 
    var $clicked = $(e.target);
    if ($clicked.hasClass("searchi") || $clicked.hasClass("searchf")){
    }
    else{
      $resultDiv.fadeOut(); 
    }
  });

  // Show previous search results when the search box is clicked
  $searchInput.click(function(){
    var q=$(this).val();
    if(q != '')
    { 
      $resultDiv.fadeIn();
    }
  });

  // Select the element when it is clicked
  $resultDiv.find('li').live("click",function(e){ 
    var id = $(this).attr('id');
    var name = ($(this).find('.name').text());
    $searchInput.val(name);
  });

  };
})(jQuery);

