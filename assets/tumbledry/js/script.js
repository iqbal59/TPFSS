/**
 * Script
 *
 * @author Shahzaib
 */

"use strict";

$(function () {
  // Display the attached image ( of ticket ) under
  // the bootstrap modal and popup it:
  // @version 1.7
  $('.popup-img-attachment').on('click', function () {
    var attachmentSource = $(this).attr('src');

    $('#popup-attachment-img-download').attr('href', attachmentSource);
    $('#for-popup-attachment-img').attr('src', attachmentSource);
    $('#view-ticket-attachment').modal('show');
  });


  // Ajax requests handling:
  $(document).on('submit', '.z-form', function (event) {
    event.preventDefault();
    formAjaxRequest($(this));
  });


  // Bootstrap 5 Tooltip:
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });


  // Send email to user modal management:
  $('.seu-tool').on('click', function () {
    $('#seu-email').val($(this).attr('data-email'));
  });

  $('#send-email-user').on('hidden.bs.modal', function () {
    $('.textarea').summernote('reset');
    resetForm($(this).find('form'));
  })


  // Manage requestor modals without sending the ajax request:
  $('.z-table, .z-card').on('click', function (event) {
    var $element = $(event.target);
    var isFine = true;

    /**
     * The element you want to use to set the record ID for the modal form,
     * must have a class "tool". If the setter element is the child of "tool"
     * class, add the "tool-c" class also to the child element.
     *
     * The element that is having "tool" class, must have these attributes:
     * "data-target" OR "data-bs-target" Modal ID e.g. delete
     * "data-id" Record ID
     */

    if ($element.hasClass('tool-c')) {
      $element = $element.parent('.tool');
    }
    else {
      if (!$element.hasClass('tool')) {
        isFine = false;
      }
    }

    if (isFine === true) {
      var dataTarget = $element.attr('data-target');
      var dataBsTarget = $element.attr('data-bs-target');
      var $modal;

      if (typeof dataTarget !== typeof undefined && dataTarget !== false) {
        var $modal = $($element.attr('data-target'));
      }
      else if (typeof dataBsTarget !== typeof undefined && dataBsTarget !== false) {
        var $modal = $($element.attr('data-bs-target'));
      }

      var dataID = $element.attr('data-id');

      $modal.find('[name="id"]').val(dataID);
    }
  });


  // Google Analytics:
  if (typeof googleAnalyticsID !== 'undefined') {
    window.dataLayer = window.dataLayer || [];
    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', googleAnalyticsID);
  }


  // Cookie Popup:
  if ($.isFunction($.cookie)) {
    $('.accept-btn').on('click', function () {
      $('.cookie-popup').css('display', 'none');
      $.cookie('z_accepted', true, { expires: 365, path: '/' });
    });

    if ($.cookie('z_accepted') == null) {
      $('.cookie-popup').css('display', 'block');
    }
  }


  /**
   * Scroll to specific box management.
   *
   * @global string  moveToBoxId
   * @global integer subtractBoxMove
   */
  if (typeof moveToBoxId !== 'undefined') {
    var toSubtract = 0;

    if (typeof subtractBoxMove != 'undefined') {
      toSubtract = subtractBoxMove;
    }

    if ($('#section-' + moveToBoxId).length) {
      $('html, body').animate(
        {
          scrollTop: $('#section-' + moveToBoxId).offset().top - toSubtract
        });
    }
  }


  /**
   * Articles Voting
   *
   * @global string csrfToken
   */
  $(document).on('click', '.article-vote', function () {
    $('.article-vote').attr('disabled', 'disabled');

    $.ajax(
      {
        url: $(this).attr('data-action'),
        data: { tumbledry_csrf: csrfToken },
        method: 'POST',
        success: function (response) {
          response = jsonResponse(response);

          if (response.status === 'false') {
            showResponseMessage(null, response.value, 0);
          }
          else if (response.status === 'voted') {
            $('#article-votes').text(response.value);
          }
        }
      });
  });


  // Select 2:
  readySelect2();


  // On modal shown, clear extra:
  $(window).on('shown.bs.modal', function () {
    resetResponseMessages();
  });
  var fabricHtml = '';

  $('#garment_user').change(() => {
    //console.log($('#garment_user').val());
    $.ajax({
      url: baseURL + 'support/get_allfabrics',
      data: { tumbledry_csrf: csrfToken, garment: $('#garment_user').val() },
      dataType: "json",
      method: 'POST',
      success: function (res) {
        fabricHtml = '';
        console.log(res);
        $.map(res.data.fabrics, function (v, i) {

          fabricHtml += '<option value="' + v.id + '">' + v.name + '</option>';
        });
        $('#fabric_user').html(fabricHtml);
      }, error: function (error) { console.log(error); }
    });
  });


});


$(window).on('load', function () {
  // Make pay modal button activated on the page is fully loaded:
  $('.btn.pay-modal').removeAttr('disabled');

});



$(".delete").on('click', function () {
  $('.case:checkbox:checked').parents("tr").remove();
  $('.check_all').prop("checked", false);
  //check();

});

var i = 1;
var machineHtml = '';
var dataToSend = { tumbledry_csrf: csrfToken };

$.ajax({
  url: baseURL + 'admin/kbm/washing/get_allmachine',
  data: dataToSend,
  dataType: "json",
  method: 'POST',
  success: function (res) {
    console.log(res);
    $.map(res.data.machines, function (v, i) {

      machineHtml += '<option value="' + v.id + '">' + v.name + '</option>';
    });
  }, error: function (error) { console.log(error); }
})

$(".addmore").on('click', function () {
  //var count = $('table tr').length;
  //alert(count);
  var data = '<tr> <td><input type="checkbox" class="case" /></td>  <td><select class="form-control select2 search-disabled" data-placeholder="Select Machine"  onchange="getWashandDryProgram(this.value, \'' + baseURL + 'admin/kbm/washing/get_allprogram\', ' + i + ')" id="wash_machine_' + i + '" name="wash[' + i + '][machine_id]"> <option>--Select--</option>' + machineHtml + ' </select></td> <td><select class="form-control select2 search-disabled" data-placeholder="Select Wash Program" id="wash_program_' + i + '" name="wash[' + i + '][wash_program_id]"> <option>--Select--</option> </select></td> <td><select class="form-control select2 search-disabled" data-placeholder="Select Wash Chemical" id="wash_chemical_' + i + '" name="wash[' + i + '][wash_chemical_ids][]" multiple="multiple"> <option>--Select--</option> </select></td> <td><select class="form-control select2 search-disabled" data-placeholder="Select Dry Program" id="dry_program_' + i + '" name="wash[' + i + '][dry_program_id]"> <option>--Select--</option> </select></td>  </tr>';
  $('table').append(data);
  i++;

  readySelect2();
});

function select_all() {
  $('input[class=case]:checkbox').each(function () {
    if ($('input[class=check_all]:checkbox:checked').length == 0) {
      $(this).prop("checked", false);
    } else {
      $(this).prop("checked", true);
    }
  });
}


function getWashandDryProgram(id, source, divId = 0) {
  if (!id) {
    return;
  }
  dataToSend = { id: id, tumbledry_csrf: csrfToken };
  $.ajax({
    url: source,
    data: dataToSend,
    dataType: "json",
    method: 'POST',
    success: function (res) {
      //console.log(res.data);
      var washHtml = '';
      var dryHtml = '';
      var washChemicalHtml = '';

      $.map(res.data.wash, function (v, i) {

        washHtml += '<option value="' + v.id + '">' + v.wash_program_name + '</option>';
      });

      $.map(res.data.dry, function (v, i) {

        dryHtml += '<option value="' + v.id + '">' + v.dry_program_name + " (" + v.dry_time + ")" + '</option>';
      });

      $.map(res.data.chemicals, function (v, i) {

        washChemicalHtml += '<option value="' + v.id + '">' + v.chemical_name + '</option>';
      });

      $('#wash_program_' + divId).html(washHtml);
      $('#dry_program_' + divId).html(dryHtml);
      $('#wash_chemical_' + divId).html(washChemicalHtml);


    }, error: function (error) { console.log(error); }
  });


}



// function check() {
//   obj = $('table tr').find('span');
//   $.each(obj, function (key, value) {
//     id = value.id;
//     $('#' + id).html(key + 1);
//   });
// }