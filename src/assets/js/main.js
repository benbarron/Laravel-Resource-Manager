"use strict";

var Dashboard = function() {
  var global = {
    tooltipOptions: {
      placement: "right"
    },
    menuClass: ".c-menu"
  };

  var menuChangeActive = function menuChangeActive(el) {
    var hasSubmenu = $(el).hasClass("has-submenu");
    $(global.menuClass + " .is-active").removeClass("is-active");
    $(el).addClass("is-active");

    // if (hasSubmenu) {
    // 	$(el).find("ul").slideDown();
    // }
  };

  var sidebarChangeWidth = function sidebarChangeWidth() {
    var $menuItemsTitle = $("li .menu-item__title");

    $("body").toggleClass("sidebar-is-reduced sidebar-is-expanded");
    $(".hamburger-toggle").toggleClass("is-opened");

    if ($("body").hasClass("sidebar-is-expanded")) {
      $('[data-toggle="tooltip"]').tooltip("destroy");
    } else {
      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };

  return {
    init: function init() {
      $(".js-hamburger").on("click", sidebarChangeWidth);

      $('.l-sidebar').hover(sidebarChangeWidth);

      

      $(".js-menu li").on("click", function(e) {
        menuChangeActive(e.currentTarget);
      });

      $('[data-toggle="tooltip"]').tooltip(global.tooltipOptions);
    }
  };
}();

Dashboard.init();


$('document').ready(function(){
  var i = 1;
  $('#add-column-to-table').on('click', function(){
  
    if (i < 1) { i = 1; }
    var j = i + 1;

    document.getElementById('insert'+i).innerHTML = 
      "<tr id="+i+">" +
      "<th>"+j+"<input type='hidden' name='count-"+j+"' value="+j+"></th>"+
      "<td>"+
      "<select name='data-type-"+i+"' id='' class='form-control rounded-0'>"+
      "<option value='string' >String</option>"+
      "<option value='text'>Text</option>"+
      "<option value='integer'>Integer</option>"+
      "<option value='float'>Float</option>"+
      "<option value='image'>Image</option>"+
      "</select>"+
      "</td>"+
      "<td>" +
      "<input type='text' name='name-"+i+"' class='form-control rounded-0'>"+
      "</td>"+
      "<td>"+
      "<input type='text' name='default-"+i+"' class='form-control rounded-0'>"+
      "</td>";
      i++;
  });
  $('#remove-column-to-table').on('click', function(){
    if(i < 1){ i = 1; }
    $('#'+i).remove();
    i--;
  });
});