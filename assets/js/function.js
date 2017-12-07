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
