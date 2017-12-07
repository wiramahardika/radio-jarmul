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

  </head>
  <body style="background-image:url(<?php echo base_url(); ?>assets/images/bg.jpg);background-size: 100% auto;">

    <div class="container" style="padding-top: 2em;">
      <div class="col-xs-12 col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading">Request a Song</div>
          <div class="panel-body">
            <form>
              <div class="form-group">
                <label>Your name:</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Song:</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Artist:</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Message:</label>
                <textarea name="name" class="form-control" rows="3"></textarea>
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

        <div class="panel panel-default">
          <div class="panel-heading">Requested Song</div>
          <div class="panel-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Time</th>
                  <th>Requested Songs</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>08/12/2017 - 08:00</td>
                  <td>Hymne ITS</td>
                  <td class="text-right">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#request-details">
                      <span class="glyphicon glyphicon-list-alt"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>08/12/2017 - 08:00</td>
                  <td>Gereja Tua</td>
                  <td class="text-right">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#request-details">
                      <span class="glyphicon glyphicon-list-alt"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>08/12/2017 - 08:00</td>
                  <td>Antara Benci dan Rindu</td>
                  <td class="text-right">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#request-details">
                      <span class="glyphicon glyphicon-list-alt"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>

                <tr>
                  <td>08/12/2017 - 08:00</td>
                  <td>Gelas-gelas Kaca</td>
                  <td class="text-right">
                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#request-details">
                      <span class="glyphicon glyphicon-list-alt"></span>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm">
                      <span class="glyphicon glyphicon-trash"></span>
                    </button>
                  </td>
                </tr>

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

    <div id="request-details" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Request Details</h4>
          </div>
          <div class="modal-body">
            <p>
              <h4><b>REQUEST BY</b></h4>
              <span>Wira Mahardika</span>
            </p>
            <hr>
            <p>
              <h4><b>SONG</b></h4>
              <span>Hymne ITS</span>
            </p>
            <hr>
            <p>
              <h4><b>ARTIST</b></h4>
              <span>ITS</span>
            </p>
            <hr>
            <p>
              <h4><b>MESSAGE</b></h4>
              <span>Salam buat temen-temen di kampus :)</span>
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/function.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/player.js"></script>

  </body>
</html>
