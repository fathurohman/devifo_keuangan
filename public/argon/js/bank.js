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
          '<input class="form-control account_id" type="text" id="account_id" name="account_id[]" hidden>' +
          '</td>' +
          '<td><input class="form-control amount" type="text" id="amount_c">' +
          '<input class="form-control amount_real" type="text" id="amount_real" name="amount_c[]" hidden>' +
          '</td>' +
          '<td><input class="form-control memo" type="text" id="memo" name="memo_c[]"></td>' +
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

function format(num) {
     var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
     if (str.indexOf(".") > 0) {
          parts = str.split(".");
          str = parts[0];
     }
     str = str.split("").reverse();
     for (var j = 0, len = str.length; j < len; j++) {
          if (str[j] != ",") {
               output.push(str[j]);
               if (i % 3 == 0 && j < (len - 1)) {
                    output.push(",");
               }
               i++;
          }
     }
     formatted = output.reverse().join("");
     return ("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
}

$('tbody').on('keyup', ".amount_c", function () {
     $(this).val(format($(this).val()));
     var tr = $(this).parent().parent();
     // var amount = tr.find('.amount_c').val();
     var clone = $(this).val();
     var cloned = clone.replace(/[A-Za-z$ ,-]/g, "");
     tr.find('.amount_real').val(cloned);
});

$("#input-amount").keyup(function () {
     $(this).val(format($(this).val()));
     var clone = $(this).val();
     var cloned = clone.replace(/[A-Za-z$ ,-]/g, "");
     $('#input-amount-real').val(cloned);
     var kurs = $('#input-kurs-idr-real').val();
     var coa = $('#coa-field-id').val();
     if (coa == '15') {
          var total = cloned * kurs;
          $('#input-total').val(total);
     }
     else {
          $('#input-total').val(cloned);
     }
});

$("#input-kurs-idr").keyup(function () {
     $(this).val(format($(this).val()));
     var clone = $(this).val();
     var cloned = clone.replace(/[A-Za-z$ ,-]/g, "");
     $('#input-kurs-idr-real').val(cloned);
     var amount = $('#input-amount-real').val();
     var coa = $('#coa-field-id').val();
     if (coa == '15') {
          $('#input-total').val(cloned);
     }
     else {
          var total = cloned * amount;
          $('#input-total').val(total);
     }
});

$('#status_coa_id').on('change', function (e) {
     var pid = e.target.value;
     if (pid == 'penerimaan') {
          // $('#myTable').removeAttr('style');
          $('#cheque').hide();
          $('#payee').hide();
     } else {
          // console.log('pengeluaran');
          $('#cheque').removeAttr('style');
          $('#payee').removeAttr('style');
     }
});