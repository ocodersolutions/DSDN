/**
 * Document Ready
 */
$(document).ready(function () {
    // Script for Browe Image Icon and Image Input
    $("#BrowseImageIcon1").click(function () {
        var ckfider = new CKFinder();
        ckfider.selectActionFunction = function (fileUrl) {
            $("#Image1").val(fileUrl);
        };
        ckfider.popup();
    });
    $("#BrowseImageIcon2").click(function () {
        var ckfider = new CKFinder();
        ckfider.selectActionFunction = function (fileUrl) {
            $("#Image2").val(fileUrl);
        };
        ckfider.popup();
    });
    $("#BrowseImageIcon3").click(function () {
        var ckfider = new CKFinder();
        ckfider.selectActionFunction = function (fileUrl) {
            $("#Image3").val(fileUrl);
        };
        ckfider.popup();
    });

    $(".alert").fadeOut(15000);

    // SELECTBOX filter_published - CHANGE
    $(formAdmin + ' select[name=filter_published]').change(function () {
        submitFormAdmin();
    });
    // INPUT filter_keyword_value - KEYPRESS
    $(formAdmin + ' input[name=filter_keyword_value]').keypress(function (event) {
        if (event.which == 13) {
            event.preventDefault();
            submitFormAdmin();
        }
    });

    var totalItemChecked = 0;
    //When unchecking the checkbox
    $("#check-all").on('ifUnchecked', function (event) {
        $("input[type='checkbox']").iCheck("uncheck");
        showTotalItemCheck(0);
    });

    //When checking the checkbox
    $("#check-all").on('ifChecked', function (event) {
        $("input[type='checkbox']").iCheck("check");
        var items = $(formAdmin + ' table tbody input[type=checkbox]:checked').length;
        showTotalItemCheck(items);
    });

    //When checking the checkbox
    $("table tbody input[type=checkbox]").on('ifChecked', function (event) {
        totalItemChecked += 1;
        showTotalItemCheck(totalItemChecked);
    });

    $("table tbody input[type=checkbox]").on('ifUnchecked', function (event) {
        totalItemChecked -= 1;
        showTotalItemCheck(totalItemChecked);
    });

    // TOOLBAR BUTTON CLICK
    $('a[data-type=delete]').click(function(){ 
        deleteItem('Bạn có muốn xóa các phần tử đã được chọn!', 'Không có phần tử nào được chọn!'); 
    });
    $('button[data-type=save]').click(function () {
        changeAction('save');
    });
    $('button[data-type=save-close]').click(function () {
        changeAction('save-close');
    });
    $('button[data-type=save-new]').click(function () {
        changeAction('save-new');
    });
    
    
});


/**
 * Script for Form
 */
var formAdmin = '#adminForm';

// SUBMIT FORM ADMIN
function submitFormAdmin(url) {
    if (url != "") {
        $(formAdmin).attr('action', url);
    }
    $(formAdmin).submit();
}

// DELETE ITEM
function deleteItem(message, error) {
    event.preventDefault();

    var checkboxes = document.getElementsByName('cid[]');
    var checkboxesChecked = [];
    // loop over them all
    for (var i = 0; i < checkboxes.length; i++) {
        // And stick the checked ones onto an array...
        if (checkboxes[i].checked) {
            checkboxesChecked.push(checkboxes[i]);
        }
    }

    if (checkboxesChecked.length == 0) {
        alert(error);
    } else {
        var r = confirm(message);
        if (r == true) {
            var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "delete");
            submitFormAdmin(linkSubmit);
        }
    }
}

// DELETE ITEM
function deleteItemCustom(message, error) {
    event.preventDefault();

    var checkboxes = document.getElementsByName('cid[]');
    var checkboxesChecked = [];
    // loop over them all
    for (var i = 0; i < checkboxes.length; i++) {
        // And stick the checked ones onto an array...
        if (checkboxes[i].checked) {
            checkboxesChecked.push(checkboxes[i]);
        }
    }

    if (checkboxesChecked.length == 0) {
        alert(error);
    } else {
        var r = confirm(message);
        if (r == true) {
            var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "deleteCustom");
            submitFormAdmin(linkSubmit);
        }
    }
}

function confirmDelete(url, message) {
    event.preventDefault();

}

function toggle(source) {
    checkboxes = document.getElementsByName('check_list[]');
    for (var i = 0, n = checkboxes.length; i < n; i++) {
        checkboxes[i].checked = source.checked;
    }
    checkboxes2 = document.getElementsByName('select-all');
    for (var i = 0, n = checkboxes2.length; i < n; i++) {
        checkboxes2[i].checked = source.checked;
    }
}

// SORT LIST
function sortList(orderBy, order) {
    $(formAdmin + ' input[name=order]').val(order);
    $(formAdmin + ' input[name=order_by]').val(orderBy);
    submitFormAdmin();
}

// CHANGE PUBLISHED
function changePublished(id, published) {
    var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "published");
    $(formAdmin + ' input[name=published_id]').val(id);
    $(formAdmin + ' input[name=published_value]').val(published);
    submitFormAdmin(linkSubmit);
}

// SHOW TOTAL ITEM CHECK
function showTotalItemCheck(total) {
    $('a[data-type=show-total] span').remove();
    if (total > 0) {
        $('a[data-type=show-total]').prepend('<span class="badge bg-aqua">' + total + '</span>');
    }
}

//CHANGE MULTI PUBLISHED
function changeMultiPublished(type) {
    $(formAdmin + ' input[name=published_value]').val(type);
    var linkSubmit = $(formAdmin).attr('action').replace(/filter/gi, "multi-published");

    submitFormAdmin(linkSubmit);
}

// CHANGE ACTION
function changeAction(type) {
    $(formAdmin + ' input[name=action]').val(type);
    submitFormAdmin();
}