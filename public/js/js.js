// $(document).ready(function(){
    $(".sideBar-button").on("click",function(){
        $(".sideBar").toggle(300);
    });
    // $("body").niceScroll();
    $(".sideBar").niceScroll();

    $("body").on("click", ".has-data", function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('href'),
            method:"get",
            beforeSend:function(){
                $(".load_content").show();
            },
            success:function(responsetext){
                $(".load_content").hide();
                $(".displayViewContent").html(responsetext);            
                $(".displayView").css("display", "block");            
            },
        });
        
        // $(".displayView").css("display", "block");
    });
    $(".displayView").on("click", ".close", function(){
        $(".displayView").css("display","none");
    });

    // start datatable
    $('.dataTables_filter input').removeClass('form-control-sm');
    $('.dataTables_filter input').css('width', "98%");
    $('.dataTables_filter label').contents().filter(function() {
        return this.nodeType === 3; // Node type 3 is a text node
    }).remove();
    $('.dataTables_filter label').css('width', "100%");
    $('.dataTables_filter').parents("div:first").removeClass("col-md-6").addClass("col-md-10");
    $('.dataTables_length select').removeClass('form-select-sm');
    $('.dataTables_length select').css('width', "98%");
    $('.dataTables_length label').contents().filter(function() {
        return this.nodeType === 3; // Node type 3 is a text node
    }).remove();
    $('.dataTables_length label').css('width', "100%");
    $('.dataTables_length').parents("div:first").removeClass("col-md-6").addClass("col-md-2");
    // end datatable
    
    // $("body").on("click", "a[name='delete']",function(e){
    //     e.preventDefault();
    //     var _token = $("#_token").val();
    //     var url = $(this).attr("href");
    //     var status = confirm("حذفك لهذا الحقل سيؤدى الى حذف جميع البيانات المتعلقه به");
    //     if(status==true){
    //         $.ajax({
    //             url:url,
    //             method:"post",
    //             data:{"_token":_token},
    //             beforeSend:function(){
    //                 $(".load_content").css("display","block");
    //             },
    //             success:function(responsetext){
    //                 $(".load_content").css("display","none");
    //                 $("#alert_message").text("تم حذف الحقل بنجاح").fadeIn().delay(2000).fadeOut();
    //                 $("#table_body").html(responsetext);
    //             },
    //             error: function(data_error, exception){
    //                 $(".load_content").css("display","none");
    //                 if(exception == "error"){
    //                     $("#alert_message").text(data_error.responseJSON.message).fadeIn().delay(2000).fadeOut();
    //                 }
    //             }
    //         });
    //     }
        
    // });
    
// });



