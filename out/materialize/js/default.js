$(document).ready(function(){
    $(".parallax").parallax();
    $('.slider').slider();
    $('select').material_select();
});

    $(".category").click(function(e){
        e.stopPropagation();
      
        var suitOfTable = $(this).parent().attr('class');
        var postId = suitOfTable.split("cust_tab ")[1];
        var triggedElement =postId.toString();
       // var triggedElement ="#"+postId.toString();
        
        if ($('.sub_cat').hasClass(triggedElement)){
          e.preventDefault();
          
          $('.sub_cat').css("display", "none");
          $("#"+triggedElement).css("display", "block");
          
          if($(".category").hasClass('on_active')){

             $(".category").removeClass('on_active');
             $(this).addClass('on_active');
             
          }
        }else{
          
        }  
});