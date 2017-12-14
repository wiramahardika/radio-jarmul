$( document ).ready(function() {
  window.setInterval(function(){
    get_song_title()
  }, 3000);
});

function get_song_title(){

  var requestingTitle = send_ajax_request('GET', 'song-title')

  requestingTitle.done(function(responseData, textStatus, xhr) {
    if (responseData == '') {
      $("#song-title").html("Offline");
    }
    else {
      $("#song-title").html(responseData);
    }
  });
  requestingTitle.fail(function(responseData, textStatus, xhr) {
    $("#song-title").html("Failed to get song's information");
  });
}
