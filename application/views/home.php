<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Radio Jarmul (Group 5)</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <script src='https://www.google.com/recaptcha/api.js'></script>

  </head>
  <body style="background-image:url(<?php echo base_url(); ?>assets/images/bg.jpg);background-size: 100% auto;">

    <div class="container" style="padding-top: 2em;">
      <div class="col-xs-12 col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">Request a Song</div>
          <div class="panel-body">
            <form id="request-form">
              <div class="form-group">
                <label>Your name:</label>
                <input type="text" class="form-control" name="nama" required>
              </div>
              <div class="form-group">
                <label>Song:</label>
                <input type="text" class="form-control" name="song">
              </div>
              <div class="form-group">
                <label>Artist:</label>
                <input type="text" class="form-control" name="artist">
              </div>
              <div class="form-group">
                <label>Message:</label>
                <textarea class="form-control" rows="3" name="message"></textarea>
              </div>
              <button type="submit" class="btn btn-default">Submit</button>
            </form>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">Radio Player</div>
          <div class="panel-body">
            <p><b>Now Playing:</b> <span id="song-title">Loading ...</span></p>
            <audio controls="controls" src="http://<?php echo $this->input->ip_address() ?>:8000/;" autoplay></audio>
          </div>
        </div>

        <div id="login-panel" class="panel panel-default">
          <div class="panel-heading">Login as broadcaster</div>
          <div class="panel-body">
            <form id="login-form">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input type="text" class="form-control" name="username" placeholder="Username" required>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>

        <div id="requested-song" class="panel panel-default">
          <div class="panel-heading" style="padding-bottom:1em;">
            <span>Requested Song</span>
            <button id="logout-btn" type="button" class="btn btn-sm btn-default" style="float:right;" data-placement="top" title="Logout">
              <span class="glyphicon glyphicon-log-out"></span>
            </button>
          </div>
          <div class="panel-body">
            <p id="loading-request-list">Loading request list...</p>
            <p id="error-request-list" style="display:none;">Unable to load request list</p>
            <table id="loaded-request-list" class="table table-striped">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Requested Songs</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="request-list-container">
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="col-xs-12 col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">Chat</div>
          <div class="panel-body" style="height:400px;">
            <script id="cid0020000173655683736" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 100%;height: 100%;">{"handle":"radiojarmul","arch":"js","styles":{"a":"C8C8C8","b":100,"c":"000000","d":"000000","k":"C8C8C8","l":"C8C8C8","m":"C8C8C8","p":"10","q":"C8C8C8","r":100}}</script>
          </div>
        </div>
      </div>
    </div>

    <div id="template-request-modal" class="hide">
      <div class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Request Details</h4>
            </div>
            <div class="modal-body">
              <p>
                <h4><b>REQUEST BY</b></h4>
                <span class="name">n/a</span>
              </p>
              <hr>
              <p>
                <h4><b>SONG</b></h4>
                <span class="song">n/a</span>
              </p>
              <hr>
              <p>
                <h4><b>ARTIST</b></h4>
                <span class="artist">n/a</span>
              </p>
              <hr>
              <p>
                <h4><b>MESSAGE</b></h4>
                <span class="message">n/a</span>
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="request-modal-container"></div>

    <div id="request-list-template" class="hide">
      <table>
        <tr>
          <td class="datetime">n/a</td>
          <td class="title">n/a</td>
          <td class="text-right">
            <button type="button" class="btn btn-default btn-sm modal-trigger" data-toggle="modal">
              <span class="glyphicon glyphicon-list-alt"></span>
            </button>
            <button type="button" class="btn btn-danger btn-sm delete-request">
              <span class="glyphicon glyphicon-trash"></span>
            </button>
          </td>
        </tr>
      </table>
    </div>

    <div id="captcha-prompt" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are you a robot or something?</h4>
          </div>
          <div class="modal-body">
            <div class="g-recaptcha" data-sitekey="6LdqsTwUAAAAAJLgEAWVRb4_ctCmFxf3-JJBoyH4"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel, I am a robot</button>
            <button type="button" class="btn btn-primary continue-btn">Continue</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/function.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/player.js"></script>

  </body>
</html>
