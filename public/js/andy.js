
/**
 * Created by andrea on 14/03/16.
 */

/*
$("#send_mail").click(function(){
       $("#mailModal").modal('show');
});*/

$("#myModal").on('hidden.bs.modal', function () {
    $("#floatingArrows").addClass("hidden");
});

// $(".showmodal").click(function () {
 
// });

$("body").on("click", "#button-close-work-modal", function(){
    $("#myModal").modal('hide');
})

$("body").on("click", ".loadWorkAdmin", function(){
    $("#myModal").modal('show');
    $("#floatingArrows").toggleClass("hidden");
});

$("body").on("click", ".openmailmodal", function(){
    $("#mailModal").modal('show');
});

$("body").on("click", "#closeMailModal", function(){
    $("#mailModal").modal('hide');
});

$("body").on("click", "#admin-get-single-work", function(){
    var id = $(this).attr("meta-work-id");
    var form = "#form-mod-single-work-"+id;
    $(form).submit();
});

$( ".carousel" ).on( "swipeleft", function(){
    $(this).carousel("next");
});

$( ".carousel" ).on( "swiperight", function(){
    $(this).carousel("prev");
});

$(".mod-single-work").click(function(){
    
    // var html = "<input type='text' value='" + id + "' />";
    var td = $(this).parent();
    
    var id = td.siblings(".td-idwork").children("span").attr("meta-work-id");

    var name = td.siblings(".td-namework").children("span").attr("meta-work-name");
    var desc = td.siblings(".td-descwork").children("span").attr("meta-work-desc");
    var link = td.siblings(".td-linkwork").children("span").attr("meta-work-link");

    var htmlname = "<input type='text' value='" + name + "' />";
    var htmldesc = "<input type='text' value='" + desc + "' />";
    var htmllink = "<input type='text' value='" + link + "' />";

    $(td.siblings(".td-namework")).html(htmlname);
    $(td.siblings(".td-descwork")).html(htmldesc);
    $(td.siblings(".td-linkwork")).html(htmllink);

    // $("#form-mod-single-work").toggleClass("hidden");

    $(td.siblings(".td-fisrtimgwork")).html("<button id='admin-get-single-work' meta-work-id='"+id+"' class='btn'>+</button>");

    // $(td).html("asd");

});

/*function loadwork(x){
    if (window.XMLHttpRequest)
    {
        xmlhttp=new XMLHttpRequest();
    }
    else
    {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("modalmbodycontent").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","AJAX/loadwork.php?id_lavoro="+x,true);
    xmlhttp.send();
}
*/


/*
$("body").on("click", "#prev-work-modal", function(){

    var id = $(this).attr("meta-work-id");

   $.post("AJAX/get_prev_work.php", { workId: id }, function(xhr, textStatus, errorThrown) {

        console.log('Request sent successfully'+xhr+textStatus+errorThrown);
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
});*/

/*
$("body").on("click", "#next-work-modal", function(){

    var id = $(this).attr("meta-work-id");

   $.post("AJAX/get_next_work.php", { workId: id }, function(xhr, textStatus, errorThrown) {
        var work = JSON.parse(xhr);
        // console.log(work);

        var workid = work.id_work;
        var workName = work.name_work;
        var descWork = work.desc_work;
        var linkPhoto = work.link_photo_work;
        var linkWork = work.link_work;
        var noomeCategoria = work.nome_categoria;

        var images = work[0];

        var imagesLng = images.lenght;

        var title_link = "<div class='row'>\
                            <div class='col md-6 text-center name-work-style'><h2 id='title-work-modal'> " + workName + "</h2></div><div id='link-work-modal' class='col md-6 text-center'>" + descWork + "</div></div>";
        
        var desc_html = "<div class='row'><div id='desc-work-modal' class='col-md-12 text-center'>" + descWork + "</div></div>";
        // console.log("titlink" + title_link);

        var imagesLoop = "";
        var myimg = "";

        // console.log(images);

        // calulate correct lenght of array images WHY dosen't count?
        console.log(imagesLng);

        for( var i = 0; i < 3; i++ ) {
              imagesLoop = imagesLoop + "<div class='row'>\
                                    <div class='col-md-12 img-portfolio'>\
                                        <img class='img-responsive' src='" + images[i] + "' alt=''>\
                                    </div>\
                                </div>";
        }

        // console.log(imagesLoop);

        $("#title-work-modal").html(title_link);
        $("#desc-work-modal").html(desc_html);
        $("#title-work-modal").html(title_link);

        console.log('Request sent successfully');
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

*/

