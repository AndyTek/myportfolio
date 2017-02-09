$("body").on("click", ".loadWork", function(e){

    e.preventDefault();

	var id = $(this).siblings(".work-id-thumb").val();
    var token = $(this).siblings(".token").val();

    var datax = {
        workId: id, 
        token: token
    }

    // console.log(datax);

	$.post("functions.php", datax, function(xhr, textStatus, errorThrown) {


        var work = JSON.parse(xhr);

        var workid = work.id_work;
        var workName = work.name_work;
        var descWork = work.desc_work;
        var linkPhoto = work.link_photo_work;
        var linkWork = work.link_work;
        var noomeCategoria = work.nome_categoria;
        var linkWork = work.link_work;
        var posWork = work.posizione_work;

      	var nextID = work.prevnext.post_next_id.id_work;
        var prevID = work.prevnext.post_prev_id.id_work;

        var images = work['pics'];

        var imagesLng = images.length;

        var title_link = "<div class='row'>\
                            <div class='col md-6 text-center name-work-style'>\
                                <h2 id='title-work-modal'>" + workName + "</h2>\
                            </div>\
                            <div id='link-work-modal' class='col md-6 text-center'>\
                                <a href="+linkWork+" target='_blank'> "+ linkWork + "</a>\
                            </div>\
                        </div>";

        var desc_html = "<div class='row'>\
                            <div id='desc-work-modal' class='col-md-12 text-center'>\
                            <p>" + descWork + "</p></div></div>";

        var imagesLoop = "";
        var myimg = "";

        for( var i = 0; i < imagesLng; i++ ) {
              imagesLoop = imagesLoop + "<div class='row'>\
                                    <div class='col-md-12 img-portfolio'>\
                                        <img class='img-responsive' src='public/" + images[i] + "' alt=''>\
                                    </div>\
                                </div>";
        }

        if( nextID && prevID ) {
            $("#prev-work-modal").attr("meta-work-id", prevID).removeClass("hidden");
            $("#next-work-modal").attr("meta-work-id", nextID).removeClass("hidden");
        }else if( nextID && !prevID ){
            $("#prev-work-modal").attr("meta-work-id", prevID).addClass("hidden");
            $("#next-work-modal").attr("meta-work-id", nextID).removeClass("hidden");
        }else{
            $("#prev-work-modal").attr("meta-work-id", prevID).removeClass("hidden");
            $("#next-work-modal").attr("meta-work-id", nextID).addClass("hidden");
        }  

        $("#title-work-modal-content").html(title_link);
        $("#desc-work-modal-content").html(desc_html);
        $("#cont-pic-modal-content").html(imagesLoop);
        
        $("#floatingArrows").toggleClass("hidden");
        $('#myModal').animate({ scrollTop: 0 }, 'slow').modal('show');
        // console.log('Request sent successfully');
    })
    .fail( function(xhr, textStatus, errorThrown) {
        var errors = xhr.responseJSON;
        var errorshtml = "<ul>";
        $.each(errors, function(key, value) {
            errorshtml += "<li>" + value + "</li>";
        });
        errorshtml += "</ul>";
        console.log(errorshtml);
    }); 

});


$("#submit-form").click(function(e){
    e.preventDefault(); 

    var mailx = $("#inputEmail").val();
    var namex = $("#name-contact-form").val();
    var tel = $("#tel-contact-form").val();
    var mex = $("#desc-contact-form").val();

    var validate = false;

    if(!mailx ){
        $("#response").html("<p>Please add your email");
        $("#inputEmail").focus();
    }else if(!namex){
        $("#response").html("<p>Please add your name");
        $("#name-contact-form").focus();
    }else if(!mex){
        $("#response").html("<p>Please add message");
        $("#desc-contact-form").focus();
    }else{

        var datax = {
            mail: mailx,
            name: namex,
            tel: tel,
            message: mex
        }

        $.post("functions.php", datax, function(xhr, textStatus, errorThrown) {

            $("#response").html("<p>Message sent, Thank you "+datax.name+"!</p>");

            setTimeout( function(){ 
                $("#mailModal").modal('hide');
              }  , 1000 );
     

        }).fail( function(xhr, textStatus, errorThrown) {
            var errors = xhr.responseJSON;
            var errorshtml = "<ul>";
            $.each(errors, function(key, value) {
                errorshtml += "<li>" + value + "</li>";
            });
            errorshtml += "</ul>";
            console.log(errorshtml);
        }); 

    }

    
});

    
// $("#submit-authip").click(function(e){
//     e.preventDefault(); 

//     var username = $("#name-auth-form").val();
//     var password = $("#password-auth-form").val();
//     var ip = $("#ip-auth-form").val();
//     var tkn = $("#token-auth-form").val();

//     var datax = {
//         usernamevalidate: username,
//         passwordvalidate: password,
//         ipvalidate: ip,
//         token: tkn
//     }

//     console.log(datax);

//     $.post("../functions.php", datax, function(xhr, textStatus, errorThrown) {

//         $("#response").html("<p>Authorized</p>");

//     }).fail( function(xhr, textStatus, errorThrown) {
//         var errors = xhr.responseJSON;
//         var errorshtml = "<ul>";
//         $.each(errors, function(key, value) {
//             errorshtml += "<li>" + value + "</li>";
//         });
//         errorshtml += "</ul>";
//         console.log(errorshtml);
//     }); 

// });

    
// $("#submit-authip").click(function(e){
//     e.preventDefault(); 

//     var username = $("#name-auth-form").val();
//     var secret = $("#secret-auth-form").val();
//     var ip = $("#ip-auth-form").val();
//     var tkn = $("#token-auth-form").val();

//     var datax = {
//         usernamevalidate: username,
//         secretvalidate: secret,
//         ipvalidate: ip,
//         token: tkn
//     }

//     console.log(datax);

//     $.get("../functions.php", datax, function(xhr, textStatus, errorThrown) {

//         console.log(datax)
//         $("#response").html("<p>Authorized</p>");

//     }).fail( function(xhr, textStatus, errorThrown) {
//         var errors = xhr.responseJSON;
//         var errorshtml = "<ul>";
//         $.each(errors, function(key, value) {
//             errorshtml += "<li>" + value + "</li>";
//         });
//         errorshtml += "</ul>";
//         console.log(errorshtml);
//     }); 

// });



