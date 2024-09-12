  
  
  
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>แก้ไขข้อมูลสมาชิก</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Text Editors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- form start -->
      <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="mb-3">
          <label for="firstname" class="form-label">First name</label>
          <input type="text" class="form-control" name="fname" value="<?php echo $user['fname'] ?>" id="firstname" aria-describedby="firstname">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Last name</label>
          <input type="text" class="form-control" name="lname" id="lastname" value="<?php echo $user['lname'] ?>" aria-describedby="lastname">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" name="email" id="email" value="<?php echo $user['email'] ?>" aria-describedby="email">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" value="<?php echo $user['password'] ?>" aria-describedby="password">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Role : </label>
          <input type="radio" class="form-check-input" name="role" id="admin" <?php echo $user['role'] == 1 ? 'checked' : '' ?> value="1">
          <label for="admin" class="form-label">Admin</label>
          <input type="radio" class="form-check-input" name="role" id="user" <?php echo $user['role'] == 0 ? 'checked' : '' ?> value="0">
          <label for="user" class="form-label">User</label>
        </div>

        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
  </div>

  </div>

  </div>
  </div>
  <!-- /.col-->
  </div>
  <!-- ./row -->

  <!-- ./row -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->