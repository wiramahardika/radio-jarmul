$(document).ready(function() {
  // Listener to form submit
    $("#login-form").submit(function(e){

      // Collecting form data
      var form = new FormData();
      var data = $(this).serializeArray();
      $.each(data,function(key,input){
        form.append(input.name,input.value);
        alert(input.name)
      });
    });
});
