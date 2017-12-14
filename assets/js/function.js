// Send Jquery AJAX request
function send_ajax_request(method, url, data, loaderButton){

  // Set default value
  if (loaderButton === undefined) {
    loaderButton = false
  }
  if (data === undefined) {
    data = null
  }

  // Prepare ajax settings
  var settings = {
    "async": true,
    "url": url,
    "method": method,
    "processData": false,
    "contentType": false,
    "mimeType": "multipart/form-data",
    "data": data,
    error: function (xhr, responseData, textStatus) {
      if (loaderButton) {
        loaderButton.button('reset')
      }
      $('.hide-on-ajax-done').addClass('hide')
      $('.show-on-ajax-done').removeClass('hide')
      $('.enable-on-ajax-done').prop("disabled", false)
    }
  }
  if (loaderButton) {
    loaderButton.button('loading')
  }
  return $.ajax(settings)
}

function check_session(){
  if (document.cookie == "logged_in") {
    return true;
  }
  else {
    return false;
  }
}

function show_capthca_prompt(state){
  grecaptcha.reset();
  $("#captcha-prompt").modal('show');
  $("#captcha-prompt").find(".continue-btn").off('click').click(function(){
    switch (state) {
      case 'login':
        login();
        break;
      case 'insert_request':
        insert_request();
        break;
      default:
        alert('State undefined')
    }
  })
}

function login() {
  // Collecting form data
  var form = new FormData();
  var data = $("#login-form").serializeArray();
  $.each(data,function(key,input){
    form.append(input.name,input.value);
  });

  if ($("#captcha-prompt").find("textarea[name='g-recaptcha-response']").val() == '') {
    alert("LOGIN FAILED! You are a robot!");
  }
  else {
    form.append('captcha', $("#captcha-prompt").find("textarea[name='g-recaptcha-response']").val());
    var loggingIn = send_ajax_request('POST', 'api/auth/login', form)

    loggingIn.done(function(responseData, textStatus, xhr) {
      var response = JSON.parse(responseData)

      if (response.status == 'success') {
        $("#captcha-prompt").find("button[data-dismiss='modal']").trigger('click');
        document.cookie = "logged_in;";
        logged_in();
      }
      else {
        alert('Username or password incorrect!');
        $("#requested-song").hide()
        $("#login-panel").fadeIn()
      }
    });
    loggingIn.fail(function(responseData, textStatus, xhr) {
      alert('LOGIN FAILED!');
      $("#requested-song").hide()
      $("#login-panel").fadeIn()
    });
  }
}

function logged_in(){
  $("#login-panel").hide();
  $("#requested-song").fadeIn();
  $("#login-form").find('input').val('');

  update_request_list(true);
}

function insert_request() {
  // Collecting form data
  var form = new FormData();
  var data = $("#request-form").serializeArray();
  $.each(data,function(key,input){
    if (input.name == 'g-recaptcha-response') {
      form.append('captcha',input.value);
    }
    else {
      form.append(input.name,input.value);
    }
  });
  form.append('message', $("#request-form").find("textarea[name='message']").val());

  if ($("#captcha-prompt").find("textarea[name='g-recaptcha-response']").val() == '') {
    alert("FAILED TO SEND REQUEST! You are a robot!");
  }
  else {
    form.append('captcha', $("#captcha-prompt").find("textarea[name='g-recaptcha-response']").val());
    var sendingRequest = send_ajax_request('POST', 'api/userrequest/tambahrequest', form)

    sendingRequest.done(function(responseData, textStatus, xhr) {
      var response = JSON.parse(responseData)

      if (response.status == 'success') {
        alert('Your request has been sent to broadcaster.')
        $("#captcha-prompt").find("button[data-dismiss='modal']").trigger('click');
        if (check_session()) {
          update_request_list();
        }

        $("#request-form").find("input").val('');
        $("#request-form").find("textarea").val('');
      }
      else {
        alert('Unable to send request');
      }
    });
    sendingRequest.fail(function(responseData, textStatus, xhr) {
      alert('Unable to send request');
    });
  }
}

function update_request_list(loadingMessage){
  $("#loaded-request-list").hide();
  $("#error-request-list").hide();
  if (loadingMessage == undefined) {
    loadingMessage = false;
  }
  if (loadingMessage) {
    $("#loading-request-list").fadeIn();
  }
  var getRequestList = send_ajax_request('POST', 'api/userrequest/getallrequest');

  getRequestList.done(function(responseData, textStatus, xhr) {
    var response = JSON.parse(responseData)
    $("#loading-request-list").hide();

    if (response.status == 'success') {
      $("#request-list-container").empty();
      $("#request-modal-container").empty();
      $.each(response.data, function(index, item){
        var listMarkup = $("#request-list-template")
        .find('tr')
        .clone();

        listMarkup.find(".datetime").html(item.time);
        listMarkup.find(".title").html(item.song);
        listMarkup.find(".modal-trigger").attr('data-target', '#request-details-' + item.id);
        listMarkup.find(".delete-request").off('click').click(function(){
          delete_request(item.id);
        })

        $("#request-list-container").append(listMarkup);

        var modalMarkup = $("#template-request-modal")
        .find('.modal')
        .clone();

        modalMarkup.attr('id', 'request-details-' + item.id);
        modalMarkup.find('.name').html(item.nama);
        modalMarkup.find('.song').html(item.song);
        modalMarkup.find('.artist').html(item.artist);
        modalMarkup.find('.message').html(item.message);

        $("#request-modal-container").append(modalMarkup);

      });

      $("#error-request-list").hide();
      $("#loaded-request-list").fadeIn();
    }
    else {
      $("#loaded-request-list").hide();
      $("#error-request-list").fadeIn();
    }

  });
}

function delete_request(requestId){
  var form = new FormData();
  form.append('id', requestId);

  var deleteingRequest = send_ajax_request('POST', 'api/userrequest/hapus', form);

  deleteingRequest.done(function(responseData, textStatus, xhr) {
    var response = JSON.parse(responseData)

    if (response.status == 'success') {
      update_request_list();
    }
    else {
      alert('Unable to delete request');
    }
  });
  deleteingRequest.fail(function(responseData, textStatus, xhr) {
    alert('Unable to delete request');
  });
}
