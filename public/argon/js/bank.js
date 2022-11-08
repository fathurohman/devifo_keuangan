var a = 1;
var nextid_b = 2;
var nextid_s = 2;
//prevent enter
$(document).on("keydown", ":input:not(textarea):not(:submit)", function (event) {
     if (event.key == "Enter") {
          event.preventDefault();
     }
});

$(document).on('click', '#addkolom', function (e) {
     e.preventDefault();
     addkolom();
     // console.log(curr);
});

function addkolom() {
     var kolom = '<tr class="row-account">' +
          '<td><input class="form-control account_no" type="text" id="account_no" name="account_no[]" readonly></td>' +
          '<td><input class="form-control autosuggest ui-widget" type="text" id="account_name" name="account_name[]">' +
          '<input class="form-control" type="text" id="account_id" name="account_id[]" hidden>' +
          '</td>' +
          '<td><input class="form-control amount" step="any" type="number" id="amount" name="amount[]"></td>' +
          '<td><input class="form-control memo" type="text" id="memo" name="memo[]"></td>' +
          '<td><input class="form-control department" id="department"></td>' +
          '<td><input type="text" id="project" class="form-control project" name="project[]"></td>' +
          '<td>' +
          '<a href="#" class="btn btn-primary btn-sm" id="addkolom"><i class="fa fa-plus"></i></a>' +
          '<a href="#" id="refreshkolom" class="btn btn-warning btn-sm refresh"><i class="fa fa-spinner"></i></a>' +
          '<a href="#" id="removekolom" class="btn btn-danger btn-sm remove"><i class="fa fa-times"></i></a>' +
          '</td >' +
          '</tr > ';
     $('.account').append(kolom);
     nextid_b++;
};

$(document).on('click', '.remove', function (e) {
     e.preventDefault();
     var l = $('tbody.account tr').length;
     // console.log(l);
     if (l == 1) {
          alert('tidak dapat menghapus lagi');
     } else {
          $(this).parent().parent().remove();
     }
});