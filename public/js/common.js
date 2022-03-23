function refresh()
{
    window.location.href = window.location.href.replace(/#.*$/, '');
}


function changeButtonText(_text, _id, _nodeValue) {
    //var value = document.getElementById('submit_button').nodeType === 3;
    // console.log(value);
    let str = '#';
    let selector =  str.concat(_id);

    $(selector).contents().each(function() {
        if (this.nodeType === _nodeValue && this.nodeValue.trim()) {
            this.textContent = _text;
        }
    })
    //$('#iconChange').find('i').addClass('fa-edit');
}

function moveToTop() {
    window.scroll({
        top:0,
        left:0,
        behavior: 'smooth'
    });
}

function returnStringFormatDate(_date) {
    let targetDate = Date.parse(_date);
    let currentDate = new Date(targetDate);
    return currentDate.toDateString();
    //return targetDate.('en')
}

function returnBDStringFormatDate(_date) {
    let targetDate = Date.parse(_date);
    let currentDate = new Date(targetDate);
    let date = currentDate.getDate();
    if(date < 10){
        date = '0' + date;
    }
    let month = currentDate.getMonth() + 1;
    if(month < 10){
        month = '0'+month;
    }
    let year = currentDate.getFullYear();
    return date + '/' + month + '/' + year;
}

function moveToIDLocation(_target) {
  /*  window.scrollTo(_target.offsetLeft,_target.offsetTop);*/
    let str = '#';
    let selector =  str.concat(_target);
    $('html, body').animate({
        scrollTop: $(selector).offset().top
    }, 500);
    /*window.scroll({
        top:0,
        left:0,
        behavior: 'smooth'
    });*/
}


function isNumberKey(event){
    return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57));
}

function isNumberKeyDecimal(event) {
    return (event.charCode !=8 && event.charCode ==0 || ( event.charCode == 46 || (event.charCode >= 48 && event.charCode <= 57)));
}

function clearForm(_id) {
    setTimeout(function () {
        let str = '#';
        let selector =  str.concat(_id);
        $(':input', selector)
            .not(':button, :submit, :reset')
            .val('')
            .removeAttr('checked').change()
            .removeAttr('selected').change();
    }, 2000);
   // document.getElementById(_id).reset();
}

function clearFormWithoutDelay(_id) {
    let str = '#';
    let selector =  str.concat(_id);
    $(':input', selector)
        .not(':button, :submit, :reset')
        .val('')
        .removeAttr('checked').change()
        .removeAttr('selected').change();
}

function swalSuccessFullWithRefresh() {
    swal({
        title: "Operation Successful!",
        icon: "success",
        button: "Ok!",
    }).then(function (value) {
        if(value){
            refresh();
        }
    });
}



function swalSuccessFullWithDatatableRemove(_target, _table) {
    swal({
        title: "Operation Successful!",
        icon: "success",
        button: "Ok!",
    }).then(function (value) {
        if(value){
           _table.row(_target.parents("tr")).remove().draw();
        }
    });
}

function swalUnSuccessFull() {
    swal({
        title: "Operation Unsuccessful!",
        text: "Something wrong happened please check!",
        icon: "error",
        button: "Ok!",
        className: "myClass",
    });
}

function swalInsertSuccessfulWithRefresh() {
    swal({
        title: "Data Inserted Successfully!",
        icon: "success",
        button: "Ok!",
    }).then(function (value) {
        if(value){
            refresh();
        }
    });
}

function swalInsertSuccessFullWithClearModalForm(_id, _formId) {
    swal({
        title: "Data Inserted Successfully!!",
        icon: "success",
        button: "Ok!",
    }).then(function (value) {
        if(value){
            clearFormWithoutDelay(_id);
            $(_formId).modal('hide');
        }
    });
}

function swalUpdateSuccessfulWithRefresh() {
    swal({
        title: "Data Updated Successfully!",
        icon: "success",
        button: "Ok!",
    }).then(function (value) {
        if(value){

            refresh();
        }
    });
}

function swalDataNotSaved() {
    swal({
        title: "Data Not Saved!",
        text: "Please Check Your Data!",
        icon: "error",
        button: "Ok!",
        className: "myClass",
    });
}

function swalNoDataFound() {
    swal({
        title: "No Data Found!",
        text: "no data!",
        icon: "error",
        button: "Ok!",
        className: "myClass",
    });
}

function swalError(_error) {
    swal({
        title: "Error!",
        text: _error,
        icon: "error",
        button: "Ok!",
        className: "myClass",
    });
}

function resetCkeditor(_name, _id) {
    let editor = CKEDITOR.instances[_name];
    let str = '#';
    let selector =  str.concat(_id);
    if (editor) {
        editor.destroy(true);
    }

    $(selector).html('');
    CKEDITOR.replace(_name,{
        uiColor: '#CCEAEE'
    });
}

function fillCkeditorWithValue(_name, _id, _value) {
    //console.log(_value);
    let editor = CKEDITOR.instances[_name];
    let str = '#';
    let selector =  str.concat(_id);
    if (editor) {
        editor.destroy(true);
    }
    $(selector).html(_value);
    CKEDITOR.replace(_name,{
        uiColor: '#CCEAEE'
    });
}
