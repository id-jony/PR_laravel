
document.addEventListener('DOMContentLoaded', function (event) {
  var phoneMask = IMask(
    document.getElementById('phone'), {
    mask: '(000)000-00-00'
  })
})

document.addEventListener('DOMContentLoaded', function (event) {
  var phone_resMask = IMask(
    document.getElementById('phone_res'), {
    mask: '(000)000-00-00'
  })
})

document.addEventListener('DOMContentLoaded', function (event) {
  var codeMask = IMask(
    document.getElementById('code'), {
    mask: '000-000'
  })
})

document.addEventListener('DOMContentLoaded', function (event) {
  var codeMask = IMask(
    document.getElementById('code2'), {
    mask: '00-00'
  })
})

document.addEventListener('DOMContentLoaded', function (event) {
  var codeMask = IMask(
    document.getElementById('uin'), {
    mask: '0000-0000-0000'
  })
})




$(function () {

  $.ajaxSetup({
    headers: {
      'x-csrf-token': $('meta[name=csrf-token]').attr('content')
    }
  });

  var ajax_modal = document.getElementById('ajax-modal')
  ajax_modal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var modalTitle = ajax_modal.querySelector('.modal-title')
    var modalBody = ajax_modal.querySelector('.modal-content')
    $("#ajax-modal .lds-ellipsis").removeClass("d-none")

    const recipient = button.getAttribute('href')
    $.get(recipient, function (t) {
      $("#ajax-modal .lds-ellipsis").addClass("d-none")
      modalBody.innerHTML = t
    })
  });


  $('#login_form').submit(function () {
    let t = $(this), e = t.find('button')
    $.ajax(t.attr('action'), {
      method: t.attr('method'),
      data: t.serialize(),
      beforeSend: function () {
        e.prop('disabled', true)
        $("#error .modal-title").html(modal_title_send)
        $("#error .lds-ellipsis").removeClass("d-none")
        $("#error .btn").addClass("d-none")
        $("#error .modal-body p").html('')
        // $('#error').attr('data-backdrop', 'static')
        $('#error').modal('show')
      },
      error: function (data) {
        $("#error .lds-ellipsis").addClass("d-none")
        $("#error .btn").removeClass("d-none")
        $("#error .modal-title").html(modal_title_error)
        $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
        e.prop('disabled', false)

      },
      success: function (data) {
        location.assign(data.route)
      },
      complete: function () {
        e.prop('disabled', false)
      }
    });
    return false;
  });

  $('#reset_form').submit(function () {
    let t = $(this), e = t.find('button')
    $.ajax(t.attr('action'), {
      method: t.attr('method'),
      data: t.serialize(),
      beforeSend: function () {
        e.prop('disabled', true)
        $("#error .modal-title").html(modal_title_send_post)
        $("#error .lds-ellipsis").removeClass("d-none")
        $("#error .btn").addClass("d-none")
        $("#error .modal-body p").html('')
        $('#error').modal('show')
        $('#forgpass').modal('hide')
      },
      error: function (data) {
        $("#error .lds-ellipsis").addClass("d-none")
        $("#error .btn").removeClass("d-none")
        $("#error .modal-title").html(modal_title_error)
        $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
        e.prop('disabled', false)
      },
      success: function (data) {
        $("#error .lds-ellipsis").addClass("d-none")
        $("#error .btn").removeClass("d-none")
        $("#error .modal-title").html(modal_title_success)
        $("#error .modal-body p").html(data.msg)
        e.prop('disabled', false)
      },
      complete: function () {
        e.prop('disabled', false)
      }
    });
    return false;
  });


  $('#sms_form').submit(function () {
    let t = $(this), e = t.find('button')
    $.ajax(t.attr('action'), {
      method: t.attr('method'),
      data: t.serialize(),
      beforeSend: function () {
        e.prop('disabled', true)
        $("#error .modal-title").html(modal_title_send_post)
        $("#error .lds-ellipsis").removeClass("d-none")
        $("#error .btn").addClass("d-none")
        $("#error .modal-body p").html('')
        $('#error').modal('show')
      },
      error: function (data) {
        $("#error .lds-ellipsis").addClass("d-none")
        $("#error .btn").removeClass("d-none")
        $("#error .modal-title").html(modal_title_error)
        $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
        e.prop('disabled', false)
      },
      success: function (data) {
        location.assign(data.route)
      },
      complete: function () {
        e.prop('disabled', false)
      }
    });
    return false;
  });


  $('#registration_form').submit(function () {
    let t = $(this), e = t.find('button')

    $("#agreement").modal("show").find("a.btn").off().on("click", function () {
      $.ajax(t.attr('action'), {
        method: t.attr('method'),
        data: t.serialize(),
        beforeSend: function () {
          e.prop('disabled', true)
          $("#error .modal-title").html(modal_title_send)
          $("#error .lds-ellipsis").removeClass("d-none")
          $("#error .btn").addClass("d-none")
          $("#error .modal-body p").html('')
          $('#error').modal('show')
          $('#agreement').modal('hide')

        },
        error: function (data) {
          $("#error .lds-ellipsis").addClass("d-none")
          $("#error .btn").removeClass("d-none")
          $("#error .modal-title").html(modal_title_error)
          $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
          e.prop('disabled', false)

        },
        success: function (data) {
          location.assign(data.route)
        },
        complete: function () {
          e.prop('disabled', false)
        }
      });
      return false;
    });
    return false;
  });


  $('#new-code').click(function () {
    let t = $(this), e = t.find('button')
    $.ajax(t.attr('action'), {
      method: t.attr('method'),
      data: t.serialize(),
      beforeSend: function () {
      },
      error: function (data) {
        $("#error .lds-ellipsis").addClass("d-none")
        $("#error .btn").removeClass("d-none")
        $("#error .modal-title").html(modal_title_error)
        $("#error .modal-body p").html(data.responseJSON.msg || data.responseJSON.message)
        e.prop('disabled', false)
      },
      success: function (data) {
      },
      complete: function () {
      }
    });
    return false;
  });

 
  


});
