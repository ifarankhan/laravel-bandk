/**
 * Created by fara on 8/18/2018.
 */
jQuery(document).ready(function () {

    jQuery(".delete").on('click', function (event) {
        event.preventDefault();
        $(this).off('click');
        var url = $(this).data('url');
        var id = $(this).data('id');
        var data = {'_token': _token};
        var modalElement = jQuery("#modal-delete");
        modalElement.show();
        jQuery(".delete-confirm").on('click', function () {

            sendAjax(url,data, 'DELETE', function (response) {
                if(response.success) {
                    jQuery("#content_"+id).hide('slow');
                }
                modalElement.modal('hide');
            });

            $(this).off('click');

        });
    });

    jQuery("#department_id").on('change', function(){
        var value = jQuery(this).val();
        var loader = jQuery("i#department_loader");
        var address = jQuery("select#address_1");
        var selectedAddress = jQuery("#hidden_address_1").val();
        var url = $(this).data('url')+value;
        var data = {};
        loader.show();

        sendAjax(url,data, 'get', function (response) {
            if(response.length > 0) {
                var html = '';
                var select = '';
                jQuery.each( response, function( key, value ) {
                    select = '';
                    if(selectedAddress == value.id) {
                        select = 'selected="selected"';
                    }
                    html = html + '<option value="'+value.id+'"'+select+'>'+value.address+'</option>';
                });

                address.html(html);
            }

            loader.hide();
        });
    });

    jQuery("#department_id").trigger('change');

    jQuery("input#fileUpload").on('change', function () {

        //Get count of selected files
        var countFiles = jQuery(this)[0].files.length;

        var imgPath = jQuery(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = jQuery("#image-holder");
        image_holder.empty();

        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {

                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++) {

                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }

                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }

            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });

    jQuery("a.load-content").on('click', function(){
        var parent = jQuery("div#content-details");
        parent.html('<div class="row"><div class="col-md-4"></div><div class="col-md-4"><i class="fa fa-spinner fa-spin fa-4x" /></div><div class="col-md-4"></div></div>');
        var url = jQuery(this).data('url');
        console.log(url);

        sendAjax(url,{}, 'GET', function (response) {
           if(response.status == true) {
               parent.html(response.html);
           }
        });
    });

    var anchors = jQuery("a.load-content");
    jQuery(anchors[0]).trigger('click');


    jQuery("button#add_address").on('click', function(){
        var parent = jQuery('div#address_div');
        parent.append('<div style="margin-bottom: 35px;"><input type="text"  class="form-control col-md-7 col-xs-12" name="addresses[]" ></div>');
    });

});

function sendAjax(url, data, method, callback)
{
    jQuery.ajax({
        url: url,
        method: method,
        dataType: 'json',
        data: data,
        success: function (result) {
            callback(result);

        },
        error: function (error) {
            callback(error);
        }
    });
}