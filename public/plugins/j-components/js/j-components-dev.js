// Automatically cancel unfinished ajax requests 
// when the user navigates elsewhere.
  var xhrPool=[],global_spinner_conf=true,refresh=false,modal_open=false;
  $(document).ajaxSend(function(e, jqXHR, options){
    xhrPool.push(jqXHR);
  });
  $(document).ajaxComplete(function(e, jqXHR, options) {
    xhrPool = $.grep(xhrPool, function(x){return x!=jqXHR});
  });
  var abort = function() {
    $.each(xhrPool, function(idx, jqXHR) {
      jqXHR.abort();
    });
  };

  var oldbeforeunload = window.onbeforeunload;
  window.onbeforeunload = function() {
    var r = oldbeforeunload ? oldbeforeunload() : undefined;
    if (r == undefined) {
      // only cancel requests if there is no prompt to stay on the page
      // if there is a prompt, it will likely give the requests enough time to finish
      abort();
    }
    return r;
  }

/* ###################### J COMPONENTS ###################### 
Author: Dodong Juliver
*/
//center any element, tho' not working by class, elements ID is recommended. To use, $("element").center()
$.fn.center = function () {this.css("top", ( $(window).height() - this.height() ) / 2  + "px");this.css("left", ( $(window).width() - this.width() ) / 2 + "px");return this;}
//validate email. To use, IsEmail(element)
function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
return regex.test(email);
}
//limit the text from the target element, to use limitText("[element class or ID]", [minimum text], [maximum text]);
function limitText(el, limit, crop){
    // $('.limit_text').text($('.limit_text').text().substring(0,0) + '.....');
    $(el).each(function(){
       if(crop !== 0){
        var txt= $(this).text();
        if(txt.length > limit){
            $(this).text(txt.substring(0,crop) + '.....');
        }
        }else{
            $(this).text($(this).text().substring(0,crop) + '.....');
        } 
    });
}
//apply shadow to the specified element. To use, j_shadow("[specify the target element, a class element or an element by ID]", '[specify the color of the shadow, you can use rgba, hex color or a string color e.g. red, blue, green etc..]', '[specify the length of the shadow e.g. 50, 100 or whatsoever]', '[specify the position of the shadow e.g. top, left, right, bottom, top-left, top-right, bottom-left, bottom-right]')
function j_shadow(el, shadow_color, shadow_length, shadow_position){
    //required longshadow js
    $(el).longShadow({
        colorShadow: shadow_color,
        sizeShadow: shadow_length,
        directionShadow: shadow_position
    });
}
//add loading animation or a loading spinner. To use j_spinner("[specify if show or hide e.g. on or off]", "[specify a spinner type to be use e.g. spinner1]")
function j_spinner(status,spinner_type){
   if(status==="on"){
        switch(spinner_type){
            case 'spinner1' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner1"></div></div>');
                break;
            case 'spinner2' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner2"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div>');
                break;
            case 'spinner3' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner4"><div class="cube1"></div><div class="cube2"></div></div></div>');
                break;
            case 'spinner4' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner5"></div></div>');
                break;
            case 'spinner5' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner6"><div class="dot1"></div><div class="dot2"></div></div></div>');
                break;
            case 'spinner6' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner7"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>');
                break;
            case 'spinner7' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner8"><div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div></div>');
                break;
            case 'spinner8' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner9"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div></div>');
                break;
            case 'spinner9' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner10"><div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div></div>');
                break;
            case 'spinner10' :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner11"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div></div>');
                break;
            default :
                $("body").append('<div style="position:fixed;z-index:9998;background:rgba(255,255,255,0.5);width:100%;height:100vh;top:0px;right:0px;" id="spinner-wrapper"></div><div class=" display-table animated zoomIn" style="position:fixed;z-index:9999;-webkit-animation-duration: 450ms;animation-duration: 450ms;" id="spinner"><div class="spinner3"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div></div>');
        }
        $('#spinner').center().show();
        $('body').addClass('disabled');
   }else{
        $('#spinner').fadeOut(400,function(){
            $('#spinner').center().remove();
        });
        $('#spinner-wrapper').remove();
        $('body').removeClass('disabled');
   }
}
//to use, modal([title of the modal box], [you can specify a string, a variable or a custom element html contents], "[specify the functions to be called. If multiple, it must be separated with a space]")
function modal(title, content, dependencies){
    modal_open = true;
    //required materialize
    $("#modal-dialog .modal-title").html(title);
    $("#modal-dialog .modal-body").html(content);
    $("#modal-trigger-button").trigger("click");
    get_dependencies(dependencies);
}
//extra modal
function extra_modal(title, content, dependencies){
    modal_open = true;
    //required materialize
    $("#extra-modal .modal-title").html(title);
    $("#extra-modal .modal-body").html(content);
    $("#extra-modal-trigger-button").trigger("click");
    $("body").css({ 'overflow' : 'hidden' });
    get_dependencies(dependencies);
}
//run those functions specified from the called functions argument. To use, get_dependencies(function1 function2 function3 function4)
function get_dependencies(dependencies){
    //check if attr 'success-function' exist and not empty
    if(typeof dependencies !== typeof undefined && dependencies !== false && dependencies !== "") {
        var classList = dependencies.split(/\s+/);
        $.each(classList, function(index, item) {
            window[item]();
        });
    }

}
//lively pull a page. To use, get_page([the request page, note: the request page must be equal to the name of the file e.g. pulled_page.php], [cotainer class or element, where the pulled content will be placed], [dependecines, if multiple, it must be separated with a space])
function get_page(this_tab_content_link, container, dependencies){

    $.ajax({
        url : app_url + '/ajax-page',
        type : 'get',
        context: this,
        dataType : 'html',
        beforeSend: function(){j_spinner("on");},
        complete: function(){j_spinner("off");},
        data : { page : this_tab_content_link, _token : $("body").attr("data-token") },
        success : function(data) {
            $(container).html(data);
            get_dependencies(dependencies);
        }
    });
}
//create a notification. To use, j_notification("[specift the content]", "[specify if autohide]", "[specify if yes or no]")
function j_notification(data, auto_hide, hide){
    if(auto_hide !== "yes"){
        if($("#j-notification-dialog").length){
            $("#j-notification-dialog").html(data);
            $("#j-notification-dialog").show();
        }else{
            $("body").append('<div class="animated slideInRight shadow-z-1" id="j-notification-dialog">' + data + '</div>'); 
            $("#j-notification-dialog").show();
        }
        if(hide === "yes"){
            $("#j-notification-dialog").delay(3000).fadeOut(500);
        }
    }else{
        if($("#j-notification-dialog").length){
            $("#j-notification-dialog").html(data);
            $("#j-notification-dialog").show();
            // $("body").append('<div class="animated slideInRight shadow-z-1" id="j-notification-dialog" style="display:table;top:'+$("#j-notification-dialog:first-child").offset().top+30+'px">' + data + '</div>'); 
        }else{
            $("body").append('<div class="animated slideInRight shadow-z-1" id="j-notification-dialog">' + data + '</div>'); 
            $("#j-notification-dialog").show();
        }
        $("#j-notification-dialog").delay(5000).fadeOut(500);
    }
}   
$(document).ready(function(){
    $('.thehide').hide();
    //token set up
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': app_token
        }
    });
    $(".hide").hide();
    $(document).on("keypress keydown keyup",".dont-write",function(){return false;});
    //email validation
    $(".validate-email").focusout(function(){
        if(!IsEmail($(this).val())){
            $('this').next('.error').fadeIn();
            $(this).focus();
        }
    });
    //allow only numbers
    $(document).on("keydown", ".numbersonly", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    //add animation to the element that has a class of .line-animation
    var this_previous_delay;
    $(".parent .line-animation").each(function(){
        var this_delay;

        if(!$(this).is(":first-child")){
                this_delay = this_previous_delay + 300;
                this_previous_delay = this_delay;
                this_delay = this_delay.toString() + "ms";
        }else{
            this_delay = $(this).index() + 300;
            this_previous_delay = this_delay;
            this_delay = this_delay.toString() + "ms";
        } //end of checking if not first-child
        
        $(this).css('-webkit-transition-delay', this_delay )
           .css('-moz-transition-delay', this_delay)
           .css('-ms-transition-delay', this_delay)
           .css('-o-transition-delay', this_delay)
           .css('transition-delay', this_delay);

    }); //end of looping unto the top_submenu li
    //end of .line-animation
    //j menu
    
    $(document).on("click", ".j-components .j-menu .j-menu-nav a", function(e){
        var dis = $(this);
        //if allowed to set an active state and active indentifier
        if(dis.attr("data-allow-active") === "yes"){
            if(dis.attr("data-has-submenu") === "no" || !dis.attr("data-has-submenu") || dis.attr("data-submenu-allowactive") === "yes"){
                dis.closest(".j-menu-nav").find(".parent").removeClass("j-active j-active-state");
                dis.addClass("j-active j-active-state");
            }
        }
        //if tabs
        if(dis.attr("data-tabs") === "yes"){
            $("#"+dis.closest(".j-menu-nav").attr("data-tabs-container")+" > .j_tabs").removeClass("active-tab").hide();
            $("#"+dis.closest('[data-tabs-container]').attr("data-tabs-container")+" "+dis.attr("href")).addClass("active-tab").fadeIn(200);
            var custom_function = dis.attr("data-monkey-run");
            if(typeof custom_function !== typeof undefined && custom_function !== false && custom_function !== "") {
                var classList = custom_function.split(/\s+/);
                $.each(classList, function(index, item) {
                  window[item]();
                });
            }
            checkwidth();

        }
        //if there's a submenu
        if(dis.attr("data-has-submenu") === "yes"){
            if(dis.next(".j-menu-dp-container").is(":visible")){
                dis.next(".j-menu-dp-container").fadeOut(200);

                //run data-on-close function on close event of dropdown menu
                var on_close = dis.attr("data-on-close");
                if(typeof on_close !== typeof undefined && on_close !== false && on_close !== "") {
                    var classList = on_close.split(/\s+/);
                    $.each(classList, function(index, item) {
                      window[item]();
                    });
                }
                
            }else{
                dis.next(".j-menu-dp-container").css({ 'display': 'table','min-width' : dis.closest("li").width() + 'px' }).fadeIn(200);
                if(dis.next(".j-menu-dp-container").offset().left+(dis.next(".j-menu-dp-container").width()*1) > $(window).width()){
                    dis.next(".j-menu-dp-container").css({ 'margin-left' : "-110px" });
                }

                //run data-on-close function on close event of dropdown menu
                var on_open = dis.attr("data-on-open");
                if(typeof on_open !== typeof undefined && on_open !== false && on_open !== "") {
                    var classList = on_open.split(/\s+/);
                    $.each(classList, function(index, item) {
                      window[item]();
                    });
                }
            }
            if(dis.next(".j-menu-dp-container").height() >= 400){
                dis.next(".j-menu-dp-container").css({ 'height' : '300px' });
            }
        }else{
            if(!dis.hasClass("dont-hide")){
                $(".top-submenu").hide();
                $($(this).attr("data-has-submenu")).show().find("li").show();
            }
        } // end of else if sub-menu is not equal to yes
        if(dis.attr("data-navigate") !== "yes"){
            e.preventDefault();
        }
    });
    //menu mouseover
    $(document).on("mouseover", ".j-components .j-menu .j-menu-nav a", function(e){
        var dis = $(this);
        if(dis.attr("data-allow-hover") === "yes"){
        dis.closest(".j-menu-nav").find(".parent").removeClass("j-active-state");
        dis.addClass("j-active-state");
        }
    }).on("mouseleave", ".j-menu .j-menu-nav a", function(){
        var dis = $(this);
        dis.removeClass("j-active-state");
        dis.closest(".j-menu-nav").find(".j-active").addClass("j-active-state");
    });

    //when click on the menu's dropdown
    $(document).on("click", ".j-menu-dp-container li a", function(e){
            var dis = $(this);
            if(dis.closest(".j-menu-dp-container").attr("data-allow-menureplace") === "yes"){
              dis.closest(".j-menu-dp-container").prev(".parent").find(".j-text").text(dis.text());
            }
            if(dis.closest(".j-menu-dp-container").attr("data-allow-menuhide") === "yes" ){
                if(!dis.next().hasClass("j-menu-dp-container")){
                    dis.closest(".j-menu-dp-container").fadeOut(200); 
                }
            }
            if(dis.closest(".j-menu-dp-container").attr("data-submenu-allowactive") === "yes" ){
                 dis.closest(".j-menu-nav").find(".parent").removeClass("j-active j-active-state");
                 dis.closest(".j-menu-dp-container").prev(".parent").addClass("j-active j-active-state");
            }
    });
    //event click j menu listener
    $(document).on("mousedown touchstart",function (e) {    
        var calendar = $(".dtp-content"),j_dp = $(".j-menu-dp-container");
        if (!j_dp.is(e.target) && calendar.has(e.target).length === 0 && j_dp.has(e.target).length === 0) {
            j_dp.stop(true).fadeOut(200);
            //run data-on-close function on close event of dropdown menu
            var on_close = $(".j-menu-dp-container:visible").prev('a[data-has-submenu="yes"]').attr("data-on-close");
            if(typeof on_close !== typeof undefined && on_close !== false && on_close !== "") {
                var classList = on_close.split(/\s+/);
                $.each(classList, function(index, item) {
                  window[item]();
                });
            }
        }
    });

// ##################################### AJAX FORM TOOLS #####################################
//<form class="ajax-form" 
// action="[url]" 
// method="[post/get. Default is post]" 
// data-onsuccess="[specify the function you want the success response to be pass on]" 
// data-message-place="[specify an element tag(s)/class(s)/id(s) where the success message will be put on instead on its default container which is after the opening of the form tag]" 
// data-custom-message="[custom message e.g. successfully saved, specify your custom success mesage]" 
// data-success-function="[invoke function(s) when XMLHttpRequest request completed. Separate by comma if multiple]" 
// data-fail-function="[invoke function(s) when XMLHttpRequest request fail. Separate by comma if multiple]" 
// data-constructor-function="[invoke a function(s) before XMLHttpRequest request. Separate by comma if multiple]"
// >
    //EXAMPLE
    $(document).on("submit", ".j-components .ajax-form", function(e){
        abort();
        dialog_open = true;
        e.preventDefault();

        //declare the major variables
        var dis = $(this),datatype = $(this).attr("data-type"),method = $(this).attr("method"), custom_message = $(this).attr("data-custom-message"), msg = dis.attr("data-message-place"), custom_on_success = $(this).attr("data-onsuccess"),before_send = $(this).attr("data-before-send");
        //check if attr 'constructor-function' exist and not empty
        //check if there is data-before-send, if there is then trigger that function first
        if(typeof before_send !== typeof undefined && before_send !== false && before_send !== "") {
            var classList = before_send.split(/\s+/);
            $.each(classList, function(index, item) {
              window[item]();
            });
        }
        //check if attr 'method' exist and not empty
        if(typeof method === typeof undefined && method === false && method === "") {
            method = "post";
        }
        //check if attr 'custom-message' exist and not empty
        if(typeof custom_message === typeof undefined && custom_message === false && custom_message === "") {
            custom_message = "Successfully saved!";
        }
         //check if attr 'custom-message' exist and not empty
        if(typeof datatype === typeof undefined && datatype === false && datatype === "") {
            datatype = 'html';
        }
        
        if(typeof dis.attr('data-before-send') !== typeof undefined && dis.attr('data-before-send') !== false && dis.attr('data-before-send') !== "") {
            var classList = dis.attr('data-before-send').split(/\s+/);
            $.each(classList, function(index, item) {
              window[item]();
            });
        }
        var formData = new FormData(dis[0]);

        $.ajax({
            url : dis.attr("action"),
            type : method,
            data : formData,
            dataType : datatype,
            cache: false,
            async: true,
            contentType: false,
            processData: false,
            beforeSend: function(){
                if(global_spinner_conf===true&&dis.attr("data-spinner")!=="off"){
                    j_spinner("on");
                }
            },
            complete: function(){
                if(global_spinner_conf===true&&dis.attr("data-spinner")!=="off"){
                    j_spinner("off");
                }
            },
            success: function(e){
                var success_transaction = false;
                $(".alert").remove();
                //check if attr 'datatype' exist and not empty
                if(typeof custom_on_success !== typeof undefined && custom_on_success !== false && custom_on_success !== "") {
                    if(e.success){
                        if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                            if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                                $(msg).html('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                            }else{
                                dis.prepend('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                            }
                        }
                        success_transaction = true;
                        window[custom_on_success](e);


                    }else{
                        //if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                        if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                            $(msg).html('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e.message+'</td></tr></table></div>');
                        }else{
                            dis.prepend('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e.message+'</td></tr></table></div>');
                        }
                        //}
                        success_transaction = false;
                    }
                }else{
                    if(datatype === 'json'){
                        if(e.success){
                            if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                                if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                                    $(msg).html('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                                }else{
                                    dis.prepend('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                                }
                            }
                            success_transaction = true;
                        }else{
                            //if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                            if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                                $(msg).html('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e.message+'</td></tr></table></div>');
                            }else{
                                dis.prepend('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e.message+'</td></tr></table></div>');
                            }
                            //}
                            success_transaction = false;
                        }
                    }else{
                        if($.trim(e) === "success"){
                            if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                                if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                                    $(msg).html('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                                }else{
                                    dis.prepend('<div class="font13 alert alert-success" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-check-circle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+custom_message+'</td></tr></table></div>');
                                }
                            }
                            success_transaction = true;
                        }else{
                            //if(typeof custom_message !== typeof undefined && custom_message !== false && custom_message !== "" || custom_message === "none") {
                            if(typeof msg !== typeof undefined && msg !== false && msg !== "") {
                                $(msg).html('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e+'</td></tr></table></div>');
                            }else{
                                dis.prepend('<div class="font13 alert alert-danger" role="alert"><a href="#" data-dismiss="alert" style="color:rgba(0,0,0,0.3);display:block;float:right;"><i class="fa fa-times" aria-hidden="true"></i></a><table cellpadding="0" cellspacing="0" style="padding:0px;margin:0px"><tr><td class="padding-right10px" style="width:25px;vertical-align:top;" valign="top"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></td><td class="font13 text-align-left">'+e+'</td></tr></table></div>');
                            }
                            //}
                            success_transaction = false;
                        }
                    }
                }
                //on success parameter
                if(success_transaction === true){
                    //check if attr 'success-function' exist and not empty
                    var custom_function = dis.attr("data-success-function");
                    if(typeof custom_function !== typeof undefined && custom_function !== false && custom_function !== "") {
                        var classList = custom_function.split(/\s+/);
                        $.each(classList, function(index, item) {
                          window[item]();
                        });
                    }
                }else{

                    //check if attr 'fail-function' exist and not empty
                    var custom_function = dis.attr("data-fail-function");
                    if(typeof custom_function !== typeof undefined && custom_function !== false && custom_function !== "") {
                        var classList = custom_function.split(/\s+/);
                        $.each(classList, function(index, item) {
                          window[item]();
                        });
                    }
                }

            }

        });
        
        if(!$(".reveal-modal").length){
            dialog_open = false;    
        }
        
    });
    // ##################################### END AJAX FORM TOOLS #####################################
});

$(window).resize(function(){
    $("#white-spinner-theme").fadeOut(200);
    $(".windows8").center();
    $(".sk-fading-circle").center();
    $("#dark-spinner-theme").center(200);
    $(".j-menu-dp-container").hide();
});

$(function(){
     $(document).on('keypress keyup keydown','.j-datepicker,.j-timepicker',function(){
        return false;
    });
    // *************************************************** J  T I M E P I C K E R ***************************************************
    //init j-timepicker
    j_timepicker();
    $(document).on("click",".j-timepicker",function(){
        if($(this).val()!==""){
            var time = $(this).val().replace(':',' ').split(' ');
            $(this).closest(".component-factory").find('.j-timepicker-factory select[name="hours"]').val(time[0]).trigger("change");
            $(this).closest(".component-factory").find('.j-timepicker-factory select[name="minutes"]').val(time[1]).trigger("change");
            $(this).closest(".component-factory").find('.j-timepicker-factory select[name="am_pm"]').val(time[2].toLowerCase()).trigger("change");
        }
        $(this).closest(".component-factory").find(".j-components .parent").trigger("click");
    });
    $(document).on("click",".j-timepicker-ok",function(e){
        e.preventDefault();
        $(this).closest(".component-factory").find(".j-timepicker").val($(this).closest(".j-timepicker-factory").find('select[name="hours"]').val()+":"+$(this).closest(".j-timepicker-factory").find('select[name="minutes"]').val()+" "+$(this).closest(".j-timepicker-factory").find('select[name="am_pm"]').val().toUpperCase()).closest(".component-factory").find(".j-menu-dp-container").fadeOut(200);
    });
    $(document).on("click",".j-timepicker-current",function(e){
        e.preventDefault();
        $(this).closest(".component-factory").find(".j-timepicker").val(moment().format('hh')+":"+moment().format("mm")+" "+moment().format('A')).closest(".component-factory").find(".j-menu-dp-container").fadeOut(200);
    });
    // *************************************************** J  D A T E P I C K E R ***************************************************
    //init j-datepicker
    j_datepicker();
    var days_change=false;
    $(document).on("click",".j-datepicker",function(){
        if($(this).val()!==""){
            var dates = $(this).val().replace(',','').split(' ');
            $(this).closest(".component-factory").find('.j-datepicker-factory select[name="months"] option[value="'+dates[0]+'"]').prop("selected",true).closest("select").trigger("change");
            days_change=dates[1];
            $(this).closest(".component-factory").find('.j-datepicker-factory select[name="years"] option[value="'+dates[2]+'"]').prop("selected",true).closest("select").trigger("change");
        }else{
            days_change=false;
        }
        $(this).closest(".component-factory").find(".j-components .parent").trigger("click");
    });
    $(document).on("click",".j-datepicker-ok",function(e){
        e.preventDefault();
        var ff = typeof $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== typeof undefined && $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== false && $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== "" ? $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') : 'MMMM DD, YYYY',
            dd = $(this).closest(".j-datepicker-factory").find('select[name="months"]').val()+" "+$(this).closest(".j-datepicker-factory").find('select[name="days"]').val()+", "+$(this).closest(".j-datepicker-factory").find('select[name="years"]').val();

        $(this).closest(".component-factory")
            .find(".j-datepicker")
            .val(moment(dd).format(ff)).closest(".component-factory").find(".j-menu-dp-container").fadeOut(200);
    });
    $(document).on("click",".j-datepicker-current",function(e){
        e.preventDefault();
        var ff = typeof $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== typeof undefined && $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== false && $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') !== "" ? $(this).closest('.component-factory').find('.j-datepicker').attr('data-format') : 'MMMM DD, YYYY',
            current_date = moment().format('MMMM')+" "+moment().format("D")+", "+moment().format('YYYY');
        
        $(this).closest(".component-factory")
            .find(".j-datepicker")
            .val(moment(current_date).format(ff))
            .closest(".component-factory").find(".j-menu-dp-container").fadeOut(200);
    });
    $(document).on("change",'.j-datepicker-factory select[name="months"],.j-datepicker-factory select[name="years"]',function(){
        if($(this).val()!==""){
            var days='';
            $.each(getDaysArray($(this).closest(".j-datepicker-factory").find('select[name="years"]').val(),$(this).closest(".j-datepicker-factory").find('select[name="months"] option:selected').attr("data-month")),function(index,value){
                var dd = "0"+value.toString();
                days+='<option value="'+dd.slice(-2)+'">'+dd.slice(-2)+'</option>';
            });
            $(this).closest(".j-datepicker-factory").find('select[name="days"]').html(days);
            if(days_change!==false){
                $(this).closest(".j-datepicker-factory").find('select[name="days"] option[value="'+days_change+'"]').prop("selected",true).closest("select").trigger("change");
            }else{
                $(this).closest(".j-datepicker-factory").find('select[name="days"] option:first-child').prop("selected",true).closest("select").trigger("change");
            }
        }
    });
    // *************************************************** E N D  J  D A T E P I C K E R ***************************************************
})


function j_timepicker(){
    if (!window.moment) { 
        return;
    }
    $(".j-timepicker-factory").remove();
    var hours = '<select class="form-control j-timepicker-hrs" style="width:70px;" name="hours">';
    for(i=1;i<13;i++){
        var hrs = "0"+i.toString();
        hours+='<option value="'+hrs.slice(-2)+'">'+hrs.slice(-2)+'</option>';
    }
    hours+='</select>';
    var minutes = '<select class="form-control" style="width:70px;" name="minutes"><option value="00">00</option>';
    for(i=1;i<60;i++){
        var mins = "0"+i.toString();
        minutes+='<option value="'+mins.slice(-2)+'">'+mins.slice(-2)+'</option>';
    }
    minutes+='</select>';
    var am_pm = '<select class="form-control" style="width:70px;" name="am_pm">';
    am_pm+='<option value="am">AM</option>';
    am_pm+='<option value="pm">PM</option>';
    am_pm+='</select>';

    var cp = $(this).attr('data-placeholder');
        if(typeof cp !== typeof undefined && cp !== false && cp !== "") {
            $(this).attr('placeholder','Click to select date');
        }else{
            $(this).attr('placeholder',cp);
        }

    $('.j-timepicker').each(function(){
        //unwrap
        if($(this).parent().hasClass('component-factory time-factory')){
            $(this).unwrap();
        }
        //init
        $(this).attr( 'readonly' , false).wrap('<div></div>').parent().addClass("parent component-factory");

        var cp = $(this).attr('data-placeholder');
        if(typeof cp !== typeof undefined && cp !== false && cp !== "") {
            $(this).attr('placeholder','Click to select time');
        }else{
            $(this).attr('placeholder',cp);
        }
        $(this).after('<div class="j-components j-timepicker-factory"><div class="j-menu"><ul class="j-menu-nav list-style-none clear p00 m00">'+
        '<li class="list-style-none clear"><a href="#" class="parent" data-has-submenu="yes" style="display:none;">click</a>'+
            '<ul class="j-menu-dp-container list-style-none display-none bg-white p15 radius-3px shadow-z-1" style="border:1px solid #ededed;margin-top:0px;">'+
                '<li class="list-style-none"><div class="display-table">'+
                    '<div class="display-row"><div class="display-cell pr7"><span class="font10 font500">HOURS:</span><br>'+hours+'</div><div class="display-cell pr7"><span class="font10 font500">MINUTES:</span><br>'+minutes+'</div><div class="display-cell"><span class="font10 font500">AM/PM:</span><br>'+am_pm+'</div></div></div>'+
                    '<div class="display-table mt8"><div class="display-row"><div class="display-cell padding-right10px"><a href="#" class="btn mb0 j-timepicker-current">CURRENT TIME</a></div><div class="display-cell"><a href="#" class="btn mb0 j-timepicker-ok">OK</a></div></div></div>'+
                '</li>'+
            '</ul>'+
        '</li>'+
        '</ul></div></div>');
    });
}
//days function
var getDaysArray = function(year, month) {
  // var names = [ 'sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat' ];
  var date = new Date(year, month-1, 1);
  var result = [];
  while (date.getMonth() == month-1) {
    // result.push(date.getDate()+"-"+names[date.getDay()]);
    result.push(date.getDate());
    date.setDate(date.getDate()+1);
  }
  return result;
}
function j_datepicker(){
    //j datepicker
    if (!window.moment) { 
        return;
    }
        
    $(".j-datepicker-factory").remove();
            
    //years
    var start_year = 1930,current_year = new Date().getFullYear(),years='<select class="form-control" style="width:90px;" name="years">';
    for (var i = start_year; i <= current_year; i++) {
        if(i===parseInt(moment().format('YYYY')))
            years+='<option value="'+i+'" selected>'+i+'</option>';
        else
            years+='<option value="'+i+'">'+i+'</option>';
    }
    years+='</select>';
    //months
    var list_months = [[1,'Jan'],[2,'Feb'],[3,'Mar'],[4,'Apr'],[5,'May'],[6,'Jun'],[7,'Jul'],[8,'Aug'],[9,'Sep'],[10,'Oct'],[11,'Nov'],[12,'Dec']],months='<select class="form-control" style="width:95px;" name="months">';
    $.each(list_months,function(index,value){
        if(value[1].toUpperCase()===moment().format('MMM').toUpperCase())
            months+='<option value="'+value[1]+'" data-month="'+value[0]+'" selected>'+value[1]+'</option>';
        else
            months+='<option value="'+value[1]+'" data-month="'+value[0]+'">'+value[1]+'</option>';
    });
    months+='</select>';
    //days
    var days = '<select class="form-control" style="width:70px;" name="days">';
    $.each(getDaysArray(moment().format("YYYY"),moment().format('M')),function(index,value){
        var dd = "0"+value.toString();
        if(value===parseInt(moment().format('D')))
            days+='<option value="'+dd.slice(-2)+'" selected>'+dd.slice(-2)+'</option>';
        else
            days+='<option value="'+dd.slice(-2)+'">'+dd.slice(-2)+'</option>';
    });
    days+='</select>';
    $(".j-datepicker").each(function(){
         //unwrap
        if($(this).parent().hasClass('component-factory')){
            $(this).unwrap();
        }
        //init
        $(this).attr( 'readonly' , false).wrap('<div></div>').parent().addClass("parent component-factory date-factory");

        var cp = $(this).attr('data-placeholder');
        if(typeof cp !== typeof undefined && cp !== false && cp !== "") {
            $(this).attr('placeholder',cp);            
        }else{
            $(this).attr('placeholder','Click to select date');
        }
        $(this).after('<div class="j-components j-datepicker-factory"><div class="j-menu"><ul class="j-menu-nav list-style-none clear p00 m00">'+
        '<li class="list-style-none clear"><a href="#" class="parent" style="display:none;" data-has-submenu="yes">click</a>'+
            '<ul class="j-menu-dp-container list-style-none display-none bg-white p15 radius-3 shadow-z-1" style="border:1px solid #ededed;margin-top:0px;">'+
                '<li class="list-style-none"><div class="display-table">'+
                    '<div class="display-row"><div class="display-cell pr7"><span class="font10 font500">MONTHS:</span><br>'+months+'</div><div class="display-cell pr7"><span class="font10 font500">DAYS:</span><br>'+days+'</div><div class="display-cell"><span class="font10 font500">YEARS:</span><br>'+years+'</div></div></div>'+
                    '<div class="display-table mt8"><div class="display-row"><div class="display-cell padding-right10px"><a href="#" class="btn mb0 j-datepicker-current">CURRENT DATE</a></div><div class="display-cell"><a href="#" class="btn mb0 j-datepicker-ok">OK</a></div></div></div>'+
                '</li>'+
            '</ul>'+
        '</li>'+
        '</ul></div></div>');

    });
}


$(window).load(function(){
    $("body").fadeIn(200);
    //run the checkwidth function
    checkwidth();
    //on window resize
});
$(window).resize(function(){
    //run the checkwidth function
    checkwidth();
});

function checkwidth(){
    //$(".overflow_x:visible table").hide();
    //give a full height to those element that has a class of "full height"
    $(".full-height").css({ 'height' : $(window).height() + 'px' });
    //give width to elements that has a class of ".fixed-child" equals to the parent reference element width that has a class of ".fixed-parent"
    $(".fixed-child").each(function(){
        $(this).css({ 'width' : $(this).closest(".fixed-parent").width() + 'px' });
    });
    //give height to the elements that has a class of ".fixed-parent" equals to its first child element height that has a class of ".fixed-child"
    $(".fixed-parent").each(function(){
         $(this).css({ 'height' : $(this).find(".fixed-child:first-child").innerHeight() + 'px' });
    });
    m_size();
}



// make random string
function random_str() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < 5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));

  return text;
}


function m_size(){
    $('.j-equal').css( 'height' , 'auto' );
    if($(window).width()>=992){
        $('.j-equal-container').each(function(){
            var dis = $(this);

            // Get an array of all element heights
            var elementHeights = dis.find('.j-equal').map(function() {
                return $(this).outerHeight();
            }).get();

            // Math.max takes a variable number of arguments
            // `apply` is equivalent to passing each height as an argument
            var maxHeight = Math.max.apply(null, elementHeights);

            // Set each height to the max height
            dis.find('.j-equal').css('height',maxHeight);


            $('.switched_contents').each(function(){
                $(this).insertBefore($(this).prev('.col-sm-6'));
                $(this).removeClass('switched_contents');
            });
        });
    }else{
        $('.j-equal-container').each(function(){

            if($(this).find('.zoom-hover-img').closest('.col-sm-6').prev('.col-sm-6').find('.boxed').length){

                var image_box = $(this).find('.zoom-hover-img').closest('.col-sm-6'),
                contents = $(this).find('.boxed').closest('.col-sm-6');

                contents.addClass('switched_contents');

                contents.insertAfter(image_box);
            }
        });
    }
}