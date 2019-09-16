/**
 * Created by fara on 8/18/2018.
 */
jQuery(document).ready(function () {

    jQuery(".show-hide").on('click', function () {
        var departmentId = jQuery(this).data('department-id');
        var what = jQuery(this).data('what');
        if(what == 'hide') {
            jQuery('.addresses_'+departmentId).show();
            jQuery(this).data('what', 'show');
            jQuery(this).html('Skjule');
        } else {
            jQuery('.addresses_'+departmentId).hide();
            jQuery(this).data('what', 'hide');
            jQuery(this).html('Vis alt');
        }

    });

    jQuery("#link_type_i").on('click', function () {
       jQuery("#internal_link").show();
       jQuery("#external_link_text").hide();
    });

    jQuery("#link_type_e").on('click', function () {
       jQuery("#internal_link").hide();
       jQuery("#external_link_text").show();
    });

    jQuery(".delete").on('click', function (event) {
        event.preventDefault();
        $(this).off('click');
        var url = $(this).data('url');
        var id = $(this).data('id');
        var data = {'_token': _token};
        var modalElement = jQuery("#modal-delete");
        modalElement.show();
        jQuery(".delete-confirm").on('click', function () {

            sendAjax(url,data, 'POST', function (response) {
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
                var html = '<option value="" >Vælg Skadested</option>';
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

    jQuery("#company_id_id").on('change', function(){
        var value = jQuery(this).val();

        var loader = jQuery("i#company_loader");
        var department = jQuery("select#department_id");
        var departments = jQuery("select#departments");
        department.html('');
        departments.html('');

        var selectedDepartment = jQuery("#hidden_department_1").val();
        var url = $(this).data('url') + value;
        var data = {};
        if(department.length > 0) {
            if (value != '') {
                loader.show();
                sendAjax(url, data, 'get', function (response) {
                    if (response.length > 0) {
                        var html = '<option value="" >Vælg afdeling</option>';
                        var select = '';
                        jQuery.each(response, function (key, value) {
                            select = '';
                            if (selectedDepartment == value.id) {
                                select = 'selected="selected"';
                            }
                            html = html + '<option value="' + value.id + '"' + select + '>' + value.name + '</option>';
                        });
                        department.html(html);
                    }

                    loader.hide();
                    jQuery("#department_id").trigger('change');
                });
            }
        }else if(departments.length > 0) {
            departments.multiSelect('refresh');
            var departmentsSelected = jQuery("#departments_selected").val();
            if(departmentsSelected == 'null' || departmentsSelected == '') {
                departmentsSelected = [];
            } else {
                departmentsSelected = JSON.parse(departmentsSelected);
            }


            var url = $(this).data('url') + value;
            var data = {};
            if (value != '') {
                loader.show();
                sendAjax(url, data, 'get', function (response) {
                    if (response.length != 0) {
                        var html = '';
                        var select = '';
                        jQuery.each(response, function (key, value) {

                            html = html + '<optgroup label="'+key+'">';
                            jQuery.each(value, function (k,v) {
                                select = '';
                                if (departmentsSelected.includes(v.id.toString())){
                                    select = 'selected="selected"';
                                }
                                html = html + '<option value="' + v.id + '"' + select + '>' + v.name + '</option>';
                            });
                            html = html + '</optgroup>';
                        });
                        departments.html(html);
                        departments.multiSelect('refresh');
                    }
                    loader.hide();
                });
            }
        }


    });
    jQuery("#customer_id").on('change', function(){
        var value = jQuery(this).val();
        var loader = jQuery("i#customer_loader");
        var department = jQuery("select#department_id");
        var company = jQuery("select#company_id_id");
        var departments = jQuery("select#departments");
        var team = jQuery('select#team_id');
        team.html('');

        departments.html('');
        if (company.length > 0) {
            console.log('hello');
            var selectedCompany = jQuery("#hidden_company_1").val();
            var url = $(this).data('url') + value;
            var data = {};
            if (value != '' ) {
                sendAjax(url, data, 'get', function (response) {
                    company.html('');
                    if (response.length > 0) {

                        var html = '<option value="" >Vælg Selskab</option>';
                        var select = '';
                        jQuery.each(response, function (key, value) {
                            select = '';
                            if (selectedCompany == value.id) {
                                select = 'selected="selected"';
                            }
                            html = html + '<option value="' + value.id + '"' + select + '>' + value.name + '</option>';
                        });

                        company.html(html);
                        company.prop('disabled', false);
                    }
                });

                loader.hide();
            }

        } else if(department.length > 0) {
            var selectedDepartment = jQuery("#hidden_department_1").val();
            var url = $(this).data('url') + value;
            var data = {};
            if (value != '') {
                loader.show();
                sendAjax(url, data, 'get', function (response) {
                    if (response.length > 0) {
                        var html = '<option value="" >Vælg afdeling</option>';
                        var select = '';
                        jQuery.each(response, function (key, value) {
                            select = '';
                            if (selectedDepartment == value.id) {
                                select = 'selected="selected"';
                            }
                            html = html + '<option value="' + value.id + '"' + select + '>' + value.name + '</option>';
                        });

                        department.html(html);
                    }

                    loader.hide();
                    jQuery("#department_id").trigger('change');

                });
            }
        } else if(departments.length > 0) {
            departments.multiSelect('refresh');
            var departmentsSelected = jQuery("#departments_selected").val();
            if(departmentsSelected == 'null' || departmentsSelected == '') {
                departmentsSelected = [];
            } else {
                departmentsSelected = JSON.parse(departmentsSelected);
            }


            var url = $(this).data('url') + value;
            var data = {};
            if (value != '') {
                loader.show();
                sendAjax(url, data, 'get', function (response) {
                    if (response.length != 0) {
                        var html = '';
                        var select = '';
                        jQuery.each(response, function (key, value) {

                            html = html + '<optgroup label="'+key+'">';
                            jQuery.each(value, function (k,v) {
                                select = '';
                                if (departmentsSelected.includes(v.id.toString())){
                                    select = 'selected="selected"';
                                }
                                html = html + '<option value="' + v.id + '"' + select + '>' + v.name + '</option>';
                            });
                            html = html + '</optgroup>';
                        });
                        departments.html(html);
                        departments.multiSelect('refresh');
                    }
                    loader.hide();
                });
            }
        } else if (team.length > 0) {
            var selectedTeam = jQuery("#hidden_teams_id").val();
            var selectedCompany = jQuery("#hidden_company_id").val();
            var url = $(this).data('url') + value;
            var data = {};
            if (value != '') {
                loader.show();
                sendAjax(url, data, 'get', function (response) {
                    if (response.teams.length > 0) {
                        var html = '<option value="" >Vælg hold</option>';
                        var select = '';
                        jQuery.each(response.teams, function (key, value) {
                            select = '';
                            if (selectedTeam == value.id) {
                                select = 'selected="selected"';
                            }
                            html = html + '<option value="' + value.id + '"' + select + '>' + value.name + '</option>';
                        });

                        team.html(html);
                        team.prop('disabled', false);
                    }
                    if (response.companies.length > 0) {
                    var company = $("#company_id");
                        company.html('');
                        var html = '<option value="" >Vælg Selskab</option>';
                        var select = '';
                        jQuery.each(response.companies, function (key, value) {
                            select = '';
                            if (selectedCompany == value.id) {
                                select = 'selected="selected"';
                            }
                            html = html + '<option value="' + value.id + '"' + select + '>' + value.name + '</option>';
                        });

                        company.html(html);
                        company.prop('disabled', false);
                    }

                    loader.hide();
                });
            }
        }

    });
    /*console.log($('#company_id_id').length);
    console.log( $('#company_id_id option').length);*/
    if($('#company_id_id').length > 0) {
            if($('#company_id_id option').length <= 1)
                jQuery("#customer_id").trigger('change');
    } else {
        jQuery("#customer_id").trigger('change');
    }
    jQuery("#company_id_id").trigger('change');


    jQuery("table#datatable1").on('click', '.enable-disable', function () {
        var isChecked = $(this).is(':checked');
        var url = $(this).data('url');
        var csrf = $(this).data('csrf');
        var id = $(this).data('id');
        $('i#loader_'+id).show();

        sendAjax(url, {'status': isChecked, '_token': csrf}, 'post', function (result) {
            if(result) {
                $('i#loader_'+id).hide();

            }
        });
    });


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

    jQuery('body').on('click','a.load-content',function(e){
        e.preventDefault();
        loadSideBar($(this));
    });
    var anchors = jQuery("a.load-content");
    jQuery(anchors[0]).trigger('click');

/*    jQuery("#claim_mechanic_id").on("change",function(){
        var element = jQuery(this);
        var m = element.val();
        var html = '';
        if(m.length > 0) {
            $.each(m, function( index, value ) {
                html = html + '<tr id="mechanic_'+value+'"><td>'+'<input type="hidden" value="'+value+'" style="width:150px;" class="form-control col-md-3 col-xs-12" name="mechanic['+index+'][id]" >'+element.select2('data')[index].text+'</td>';
                html = html + '<td>'+'<input type="text" style="width:150px;" class="form-control col-md-3 col-xs-12" name="mechanic['+index+'][estimate]" >'+'</td>'+'</tr>';
            });
            jQuery("#tbody_id").append(html);
        }
    });*/

    jQuery("button#add_address").on('click', function(){
        var parent = jQuery('tbody#address_div');
        var index = jQuery(".addresses").length;
        parent.append('<tr style="margin-bottom: 35px;" class="addresses">' +
                '<td><input type="text" style="width:150px;" class="form-control col-md-3 col-xs-12" name="addresses['+index+'][address]" ></td>' +
                '<td><input type="text" style="width:150px;" class="form-control col-md-2 col-xs-12" name="addresses['+index+'][zip_code]" ></td>' +
                '<td><input type="text" style="width:150px;" class="form-control col-md-2 col-xs-12" name="addresses['+index+'][city]" ></td>' +
                '<td><input type="text" style="width:150px;" class="form-control col-md-2 col-xs-12" name="addresses['+index+'][build_year]" ></td>' +
                '<td><input type="text" style="width:150px;" class="form-control col-md-3 col-xs-12" name="addresses['+index+'][m2]" ></td>' +
            '</tr>');
    });
    jQuery("button#add_emails").on('click', function(){
        var parent = jQuery('div#emails_div');
        parent.append('<div style="margin-bottom: 35px;"><input type="text"  class="form-control col-md-7 col-xs-12" name="emails[]" ></div>');
    });

});

function loadSideBar(element) {
    var parent = jQuery("div#content-details");
    parent.html('<div class="row"><div class="col-md-4"></div><div class="col-md-4"><i class="fa fa-spinner fa-spin fa-4x" /></div><div class="col-md-4"></div></div>');
    var url = jQuery(element).data('url');

    var id = jQuery(element).data('id');
    jQuery('#ul_'+id).toggle();


    sendAjax(url,{}, 'GET', function (response) {
        if(response.status == true) {
            parent.html(response.html);
        }
    });
}

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