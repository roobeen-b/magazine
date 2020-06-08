
  
<?php 
$header = "Contact";
include 'inc/header.php'; ?>
<?php include 'inc/checklogin.php'; ?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <?php flashMessage(); ?>
            <div class="page-title">
              <div class="title_left">
                <h3>Contact</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of Contacts</h2>
<!--                     <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:;" class="btn btn-primary" onclick="addContact();">Add Contact</a>
                    </ul> -->
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <th>S.N</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Time</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php 
                          $Contact = new contact();
                          $Contacts = $Contact->getAllContact();
                          // debugger($Contacts);
                          if ($Contacts) {
                            foreach ($Contacts as $key => $contact) {
                        ?>
                        <tr>
                          <td><?php echo $key+1; ?></td>
                          <td><?php echo $contact->email; ?></td>
                          <td><?php echo html_entity_decode($contact->subject); ?></td>
                          <td><?php echo html_entity_decode($contact->message); ?></td>
                          <td><?php echo date("M d, Y h:i:s a",strtotime($contact->created_date)); ?></td>
                          <td>

                            <a href="process/contact?id=<?php echo($contact->id) ?>&amp;act=<?php echo substr(md5("Delete-Message-".$contact->id.$_SESSION['token']), 3,15) ?>" class="btn btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                          </td>
                        </tr>
                        <?php
                            }
                          }
                        ?>
                      </tbody>
                    </table>
                 </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
  <?php include 'inc/footer.php'; ?>
  <script src="assets/js/datatable.js"></script>
 