<?php
  $this->setSiteTitle('Users');
  $this->start('body');?>
          <div class="card shadow mb-4">
            <div class="card-header py-3 ">
              <h6 class="m-0 font-weight-bold text-primary float-left">All Users</h6>
              <a class="btn btn-submit btn-sm d-inline text-dark float-right" data-toggle="tooltip" data-placement="top" tabindex="0" title="Details" href="<?=PROOT?>admin/users/add"><i class="fas fa-plus"></i> Add User</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Profile</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Username</th>
                      <th scope="col">Account Level</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Profile</th>
                      <th scope="col">First Name</th>
                      <th scope="col">Last Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Username</th>
                      <th scope="col">Account Level</th>
                      <th scope="col">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                      <td><?=$user->id?></td>
                      <td class="text-center" style="width: 40px!important"><img class="img-table rounded-circle" src="<?=PROOT?>images/users/<?=$user->image?>"></td>
                      <td><?=$user->fname?></td>
                      <td><?=$user->lname?></td>
                      <td><?=$user->email?></td>
                      <td><a href="<?=PROOT?>admin/users/details/<?=$user->id?>"><?=$user->username?></a></td>
                      <td>
                        <?php
                        $level = '';
                          foreach ($user->acls() as $l) {
                            $level .= ($level == '')? '"'.$l.'"' : ', "'.$l.'"';
                          }
                          echo($level);
                        ?>
                      </td>
                      <td class="text-center">
                        <a class="btn btn-details btn-sm d-inline text-dark" data-toggle="tooltip" data-placement="top" tabindex="0" title="Details" href="<?=PROOT?>admin/users/details/<?=$user->id?>"><i class="fas fa-info-circle"></i></a>
                      </td>
                    </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        <?php $this->end();?>