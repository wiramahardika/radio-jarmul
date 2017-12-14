$(document).ready(function() {

  if (check_session()) {
    logged_in();
  }
  else {
    $("#requested-song").hide();
    $("#login-panel").fadeIn();
  }

  $("#login-form").submit(function(e){
    e.preventDefault();
    show_capthca_prompt('login');
  });

  $("#request-form").submit(function(e){
    e.preventDefault();
    if ($(this).find("input[name='song']").val() == '' && $(this).find("input[name='artist']").val() == '') {
      alert("Please specify song's title or artist!")
    }
    else {
      show_capthca_prompt('insert_request');
    }
  });

  $("#logout-btn").click(function(){
    document.cookie = "";
    $("#requested-song").hide();
    $("#login-panel").fadeIn();
  });

});
