$('document').ready(function(){
  $('.sidebar').mouseenter(function(){
    $('.sidebar').addClass('expand');
    $('.top-left').addClass('expand');
  //  $('#large-logo').addClass('show');
  //  $('#small-logo').removeClass('show');
    $('.side-nav-link').addClass('show');
    $('.side-nav-icon').addClass('hide');
   // $('.main').addClass('slide');
  });
  $('.sidebar').mouseleave(function(){
    $('.sidebar').removeClass('expand');
    $('.top-left').removeClass('expand');
//    $('#small-logo').addClass('show');
 //   $('#large-logo').removeClass('show');
    $('.side-nav-link').removeClass('show');
    $('.side-nav-icon').removeClass('hide');
    //$('.main').removeClass('slide');
  });
  setTimeout(
    function(){
      //  $('.preloader-wrapper').removeClass('active');
        $('.left-panel').addClass('clear');
       $('.right-panel').addClass('clear');
      $('.vertical-centered-box').fadeOut();
      $('.main').fadeIn();
    }, 1000);

    $('.collapsible').collapsible();

    var i = 1;
    $('#add-column-to-model').on('click', function(){
      if(i < 1){  i = 1; }
      j = i + 1;
      document.getElementById('insert'+i).innerHTML =
      "<tr id="+i+">" +
      "<td>"+j+"<input type='hidden' name='count-"+j+"' value="+j+"></td>"+
      "<td>"+
      "<select name='data-type-"+i+"' id=''>"+
      "<option value='string'>String</option>"+
      "<option value='text'>Text</option>"+
      "<option value='integer'>Integer</option>"+
      "<option value='float'>Float</option>"+
      "<option value='image'>Image</option>"+
      "</select>"+
      "</td>"+
      "<td>" +
      "<input type='text' name='name-"+i+"'>"+
      "</td>"+
      "<td>"+
      "<input type='text' name='default-"+i+"'>"+
      "</td>"+
      "<td>"+
      "<input type='text' name='extra-"+i+"'>"+
      "</td>" +
      "</tr>";

      i++;
    });

    $('#remove-column-to-model').on('click', function(){
      if(i < 1){ i = 1; }
      $('#'+i).remove();
      i--;
    });

});
