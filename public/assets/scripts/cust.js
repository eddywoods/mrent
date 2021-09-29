$(document).ready(function () {
  $('#awaiting-payment').hide();
  $.ajaxSetup({
     headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
  });


  $('input[type=radio]').click(function (e) {

     if ($(this).is(':checked')) {
        var c = $('input[name=category]:checked').val();
        var i = $('input[name=ipay-utility]:checked').val();

        var reason = '';

        if (c == 'rent') {
           $('.switch-field2').hide();
           $('#unit-house').show();
           $('#mpesa-payment').show();
           $('#loan-payment').hide();
           reason = 'R';
           $('#account_number').change(function () {

              $('#loading').show();

              var data = {
                 account_number: $(this).val()
              }

              $.ajax({
                 type: "POST",
                 url: "/tenant/unit-payable-amount/",
                 data: data,
                 success: function (response) {
                    $('#loading').hide();
                    $('#amount-payable').show();
                    $('#payable').show();
                    $('#amount-payable').html(response);
                    $('#amount').val(response);
                 },
                 error: function () {
                    console.log('Error occured');
                 }
              });


           });

        } else if (c == 'bills') {
           $('.switch-field2').hide();
           $('#unit-house').show();
           $('#mpesa-payment').show();
           $('#loan-payment').hide();
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
           reason = 'B';
           $('#account_number').change(function () {

              $('#loading').show();

              var data = {
                 account_number: $(this).val()
              }

              $.ajax({
                 type: "POST",
                 url: "/tenant/bills-payable-amount/",
                 data: data,
                 success: function (response) {
                    $('#loading').hide();
                    $('#amount-payable').show();
                    $('#payable').show();
                    $('#amount-payable').html(response);
                    $('#amount').val(response);


                 },
                 error: function () {
                    console.log('Error occured');
                 }
              });


           });
        } else if (c == 'utilities') {
           $('.switch-field2').show();
           $('#unit-house').hide();
           $('#mpesa-payment').show();
           $('#loan-payment').hide();
           reason = 'U';
        } else if (c == 'loan') {
           $('.switch-field2').hide();
           $('#unit-house').hide();
           $('#mpesa-payment').hide();
           $('#loan-payment').show();
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
        }

        if (i == 'Kenya Power Token') {
           $('#kplc_prepaid').show();
           $('#dstv').hide();
           $('#safaricom').hide();
           $('#airtel').hide();
           $('#telcom').hide();
           $('#post_paid').hide();
        } else if (i == 'GoTv') {
           $('#kplc_prepaid').hide();
           $('#dstv').show();
           $('#safaricom').hide();
           $('#airtel').hide();
           $('#telcom').hide();
           $('#post_paid').hide();
        } else if (i == 'Safaricom') {
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
           $('#safaricom').show();
           $('#airtel').hide();
           $('#telcom').hide();
           $('#post_paid').hide();
           
        } else if (i == 'Airtel') {
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
           $('#safaricom').hide();
           $('#airtel').show();
           $('#telcom').hide();
           $('#post_paid').hide();
           
        } else if (i == 'Telkom') {
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
           $('#safaricom').hide();
           $('#airtel').hide();
           $('#telcom').show();
           $('#post_paid').hide();
           
        } else if (i == 'Kenya Power Post Paid') {
           $('#kplc_prepaid').hide();
           $('#dstv').hide();
           $('#safaricom').hide();
           $('#airtel').hide();
           $('#telcom').hide();
           $('#post_paid').show();
           
        }

        if ($('input[name=ipay-utility]').val() == 'Safaricom') {
           $('#Safaricom').html('<img src="/assets/images/safaricom.jpeg"/>')
        }
        if ($('input[id=radio-ipay-airtel]').val() == 'Airtel') {
           $('#Airtel').html('<img src="/assets/images/airtel.png"/>')
        }

        if ($('input[id=radio-ipay-gotv]').val() == 'GoTv') {
           $('#GoTv').html('<img src="/assets/images/GOtv.jpg"/>')
        }

        if ($('input[id=radio-ipay-kplc_prepaid]').val() == 'Kenya Power Token') {
           $('#Kenya Power Token').html('<img src="/assets/images/kplc.jpeg"/>')
        }

     }

     $('#stk').click(function (e) {
        e.preventDefault();
        var accou;
        var utility_type;
        var data = {};

         if ($('input[id=radio-ipay-kplc_postpaid]:checked').val() == 'Kenya Power Post Paid') {
            accou = $('#postpaid_acc_no').val();
            utility_type = 'po';
         } 

         if ($('input[name=ipay-utility]:checked').val() == 'Safaricom') {
            accou = $('#safaricom_account').val();
            utility_type = 'sa';
         
         } 
            if ($('input[id=radio-ipay-airtel]:checked').val() == 'Airtel') {
            accou = $('#airtel_account').val();
            utility_type = 'ai';
         } 
         if ($('input[id=radio-ipay-gotv]:checked').val() == 'GoTv') {
            accou = $('#gotv_acc_no').val();
            utility_type = 'go';
         } 
         if ($('input[id=radio-ipay-kplc_prepaid]:checked').val() == 'Kenya Power Token') {
            accou = $('#prepaid_account').val();
            utility_type = 'pr';
         } 
         if ($('input[id=radio-ipay-telkom]:checked').val() == 'Telkom') {
            accou = $('#telkom_account').val();
            utility_type = 'te';
         }


        if (c == 'utilities') {
          var data = {
            mobile_number: $("#mobile_number").val(),
            amount: $("#amount").val(),
            account: utility_type + accou
         }
        } else {
          var data = {
            mobile_number: $("#mobile_number").val(),
            amount: $("#amount").val(),
            account: reason + $("#account_number").val()
         }

        }
       
        $.ajax({
           type: "POST",
           url: "trigger-stk/",
           data: data,
           success: function (response) {
              if (response.status == 'success') {
                 checkPayment(response.account);
                 $('#awaiting-payment').show();
                 $('#make-payment').hide()
              }

           },
           error: function () {
              console.log('Error occured');
           }
        });

     });


     function checkPayment(account) {

        var data = {
           account: account
        }

        $.ajax({
           type: "POST",
           data: data,
           url: "check-payment",
           success: function (response) {
              if (response.confirmed) {
                 $('#awaiting-payment').hide();
                 $('#make-payment').show()
                 toastr.success('Hello Customer', 'Payment was successful', {timeOut: 5000});
              } else {
                 setTimeout(() => {
                    checkPayment(account);
                 }, 5000);
              }

           },
           error: function () {
            toastr.error('You Got Error', 'Inconceivable!', {timeOut: 5000});
           }
        });
     }


  });


  //gotv fetch

  $('#gotv-fetch').click(function (e) {
     e.preventDefault();
     $('#amount').empty();
     $('#gotv-data').empty();
     $('#gotv-loader').show();
     $('#gotv-fetch').hide();
     var data = {
        account: $("#gotv_acc_no").val(),
     }

     $.ajax({
        type: "POST",
        url: "gotv-bill",
        data: data,
        success: function (response) {

           console.log('response data');
           $('#gotv-loader').hide();
           $('#gotv-fetch').show();
           console.log(response.header_status);
           if (response.header_status == 200) {

           } else if (response.header_status == 404) {
              $('#gotv-data').html(response.text);
           }

        },
        error: function () {
           console.log('Error occured');

        }
     });
  })


  //postpaid fetch

  $('#postpaid-fetch').click(function (e) {
     e.preventDefault();
     $('#postpaid-data').empty();
     $('#amount').empty();
     $('#postpaid-loader').show();
     $('#postpaid-fetch').hide();
     var data = {
        account: $("#postpaid_acc_no").val(),
     }

     $.ajax({
        type: "POST",
        url: "postpaid-bill",
        data: data,
        success: function (response) {

           console.log('response data');
           $('#postpaid-loader').hide();
           $('#postpaid-fetch').show();
           if (response.header_status == 200) {
              $('#postpaid-data').html(response.account_data.amountdue);
              $('#amount').val(response.account_data.amountdue);
           } else if (response.header_status == 404) {
              $('#postpaid-data').html(response.text);
           }

        },
        error: function () {
           console.log('Error occured');

        }
     });
  })


});