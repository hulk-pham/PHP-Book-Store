<?php include_once("./layouts/header.php") ?>
<?php
session_start();
include_once("./models/Users.php");
include_once("./provider/UserProvider.php");
$error_msg = isset($_REQUEST['error']) ? $_REQUEST['error'] : "";
$success_msg = isset($_REQUEST['success']) ? $_REQUEST['success'] : "";
// Redirect if logged in
if (!isset($_SESSION['user']))
  header("Location:login.php");

$keyword = "";
$first_c = "";
$error = "";
$user = null;
$contacts = null;

if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
  $keyword = trim($_GET['keyword']);
}
if (isset($_GET['first_c']) && !empty(trim($_GET['first_c']))) {
  $first_c = trim($_GET['first_c']);
}
try {
  $provider = new UserProvider();

  $user = $provider->getUserById($_SESSION['user']['id']);

  $condition = "";
  if (!empty($keyword)) $condition .= "name like \"%$keyword%\" ";
  if (!empty($first_c)) {
    if (!empty($keyword)) $condition .= " and ";
    $first_c = strtolower($first_c);
    $condition .= " STRCMP(LOWER(SUBSTR(name, 1, 1)),'$first_c') = 0";
  }

  $user->contacts = $provider->getContactWithCondition($user->id, $condition);

  $contacts = $user->contacts;
  $listC = [];
  foreach ($contacts as $contact) {
    $listC[substr($contact->name, 0, 1)] = substr($contact->name, 0, 1);
  }
} catch (\Throwable $e) {
  $error = $e;
  echo $e;
  # code...
}

?>

<body id="page-top">

  </div>
  <!-- /.container-fluid -->

  <div class="index-page h-100 ">
    <header>
      <nav class="bg-light bg-white border-bottom navbar navbar-light">
        <a class="font-weight-bold navbar-brand px-1 rounded " href="index.php">

          <span class="bg-primary fa fa-user-alt p-2 mr-3 rounded rounded-pill text-white"></span>
          <span class="text-secondary">
            Contact App
          </span>
        </a>
        <a>
          <span class="fa fa-refresh"></span>
        </a>
        <form class="form-inline w-50" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">

          <input name="keyword" class="rounded-pill form-control mr-sm-2 w-100" type="search" value="<?php echo $keyword ? $keyword : "" ?>" placeholder="Search contacts" aria-label="Search">
          <button class="rounded-pill active btn btn-outline-warning fa fa-search my-2 my-sm-0 p-2 position-absolute" style="right:26px" type="submit"></button>
        </form>
      </nav>
    </header>
    <main class="row">
      <?php include_once("./layouts/sidebar.php") ?>
      <div class="sidebar col-md-9 p-4">
        <div class="bg-white p-3 rounded" style="min-height: calc(100vh - 100px);">
          <?php
          if (!empty($error_msg)) {
            echo "
            <div class='text-center alert alert-danger' role='alert'>
                $error_msg
              </div>
            ";
          }
          ?>
          <?php
          if (!empty($success_msg)) {
            echo "
            <div class='alert text-center alert-success' role='alert'>
                $success_msg
              </div>
            ";
          }
          ?>
          <?php
          if (!empty($first_c) || !empty($keyword)) {
            echo "
                <a href='index.php' class='btn btn-outline-info'>
                    Clear
                  </a>
                ";
          }
          ?>
          <div class="row">
            <div class="col-11">

              <table class="table table-contact table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($user->contacts as $contact) {
                    $fist_st = substr($contact->name, 0, 1);
                    ?>
                    <tr>
                      <td>
                        <span class="avatar-icon"><?php echo $fist_st ?></span>
                        <?php echo $contact->name ?>
                      </td>
                      <td><?php echo $contact->email ?></td>
                      <td><?php echo $contact->phone ?></td>
                      <td>
                        <!-- <input class="btn btn-sm edit-btn" type="checkbox" /> -->
                        <button class="btn btn-sm text-secondary bg-transparent edit-btn">
                          <a class=" text-secondary" href="edit.php?id=<?php echo $contact->id ?>">
                            <span class="fa fa-pen-alt"></span>
                          </a>
                        </button>
                        <form action="handles/delete-contact.php" id="<?php echo $contact->id ?>-remove" method="post" class="d-none">
                          <input name="id" value="<?php echo $contact->id ?>">
                        </form>
                        <button stype="submit" form="<?php echo $contact->id ?>-remove" class="btn btn-sm text-secondary bg-transparent edit-btn">
                          <span class="fa fa-trash-alt"></span>
                        </button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="col-1">
              <table class="table table-first-char table-contact table-borderless">
                <tbody>
                  <?php foreach ($listC as $c ){?>
                    <tr>
                      <td>
                        <a class="text-info" href="index.php?first_c=<?php echo $c ?>">
                          <?php echo $c ?>
                        </a>

                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="handles/add-contact.php" method="post" id="form-add">
              <div class="form-group">
                <label>Contact Name</label>
                <input name="name" type="text" class="form-control" placeholder="Username" required>
              </div>
              <div class="form-group">
                <label>Email address</label>
                <input name="email" type="email" class="form-control" placeholder="email@gmail.com" required </div> <div class="form-group">
                <label>Phone number</label>
                <input name="phone" type="phone" class="form-control" placeholder="+8477420121" required>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" form="form-add" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php include_once("./layouts/footer.php") ?>