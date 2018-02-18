$(document).ready(function(){
    $("#click").click(function(){
        alert("The paragraph was clicked.");
    });

    //for adding subject while checking practical
    $("#prac").change(function(){
        var ans = $("#prac").val();
        if(ans == 'Yes'){
            $("#th").val(Number(0));
            $("#pr").val(Number(0));
            $("#ttm").val(Number(0));
            $("#pracMarks").css("display","block");
            
        }
        else{
            $("#th").val(Number(100));
            $("#pr").val(Number(0));
            $("#ttm").val(Number(100));
            $("#pracMarks").css("display","none");
        }
    });

    //for calculating total marks
    $('.marks').focusout(function(){
        var thMarks = 0;
        var prMarks = 0;
        thMarks =Number($("#th").val());
        prMarks =Number($("#pr").val());

        var total = Number(thMarks + prMarks);
        if(total%1 === 0){
            $("#ttm").val(total);    
        }
    });


    //for returning year based on student selection
    $("#studentname").change(function(){
       $.post("../schoolresult/studentajax.php",
        {
           id: $("#studentname").val(),
           type: 'year',
        },
            function(data, status){
                if (status === 'success') {
                   $('.student').val(data)
                }
            });
    });

     $("#printphp").click(function(){
        //check display is hidden or not
        if( ($(".printform").is(":visible"))){
            console.log('ivisnle');
            $(".printform").css("visibility", "visible");
        }

        var mode = 'iframe'; //popup
        var close = mode == "popup";
        var options = { mode : mode, popClose : close};
        $("div.printform").printArea( options );
        $(".printform").css("visibility", "hidden");
    });


    $('#th1').focusout(function(){
        var a = $('#th1').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th1').val(" ");
        }
        
    });
    

    $('#th2').focusout(function(){
        var a = $('#th2').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th2').val(" ");
        }
    
    });
    
    $('#th3').focusout(function(){
        var a = $('#th3').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th3').val(" ");
        }
        
    });
    
    $('#th4').focusout(function(){
        var a = $('#th4').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th4').val(" ");
        }
    });
    
    $('#th5').focusout(function(){
        var a = $('#th5').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th5').val(" ");
        }
    });
    
    $('#th6').focusout(function(){
        var a = $('#th6').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th6').val(" ");
        }
    });
    
    $('#th7').focusout(function(){
        var a = $('#th7').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th7').val(" ");
        }
    });
    
    $('#th8').focusout(function(){
        var a = $('#th8').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th8').val(" ");
        }
        
    });
    
    $('#th9').focusout(function(){
        var a = $('#th9').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th9').val(" ");
        }
    });
    
    $('#th10').focusout(function(){
        var a = $('#th10').val();
        var check = $(this).myfunctionThoery(a);
        if (check === false) {
            $('#th10').val(" ");
        }
    });
    

    $('#pr1').focusout(function(){
        var a = $('#pr1').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr1').val(" ");
        }
        
    });

    $('#pr2').focusout(function(){
        var a = $('#pr2').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr2').val(" ");
        }
        
    });

    $('#pr3').focusout(function(){
        var a = $('#pr3').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr3').val(" ");
        }
        
    });
    $('#pr4').focusout(function(){
        var a = $('#pr4').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr4').val(" ");
        }
        
    });
    $('#pr5').focusout(function(){
        var a = $('#pr5').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr5').val(" ");
        }
        
    });
    $('#pr6').focusout(function(){
        var a = $('#pr6').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr6').val(" ");
        }
        
    });
    $('#pr7').focusout(function(){
        var a = $('#pr7').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr7').val(" ");
        }
        
    });
    $('#pr8').focusout(function(){
        var a = $('#pr8').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr8').val(" ");
        }
        
    });
    $('#pr9').focusout(function(){
        var a = $('#pr9').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr9').val(" ");
        }
        
    });
    $('#pr10').focusout(function(){
        var a = $('#pr10').val();
        var check = $(this).myfunctionPractical(a);
        if (check === false) {
            $('#pr10').val(" ");
        }
        
    });

    $.fn.extend({
        myfunctionThoery: function (a) {
            if(a === 'a' || a === 't'){
                alert("Enter *A for absent Or *T for theory missing");
                return false;
                
           } 
           else if( a < 1 || a > 100){
                alert("Less than 1 and greter then 100 are not accpeted");
                return false;
                
           }
           else{
              return true;
           }
        
        }
    });

    $.fn.extend({
        myfunctionPractical: function (a) {
            if(a === 'a' || a === 't' || a=== 'p'){
                alert("Enter *A for absent or *P for Practical missing");
                return false;
                
           } 
           else if( a < 1 || a > 50){
                alert("Less than 1 and greter then 50 are not accpeted");
                return false;
                
           }
           else{
              return true;
           }
        
        }
    });

});