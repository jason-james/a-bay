<?php require_once ("../../private/initialise.php") ?>
<?php include("../../private/shared/header.php"); ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">A-Bay</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">My Listings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="account.php">Account</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '<a class="nav-link" href="logout.php">Logout</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php">Login</a>';
                    }?>
                </li>
            </ul>
        </div>
    </div>
</nav>

  <div class="subject new">
    <h1>Create Item</h1>

<form action="" method="post"> <!--// action is where the form will be submitted-->
    <div class="form-group">
    <dt>Item name</dt>
        <textarea type="text" name="item_name"  placeholder="Item Name..." cols = "50" rows = "1" ></textarea>
  </div>
    <div class="form-group">
        <label for="exampleFormControlFile1">Image upload</label>
        <input type="file" class="form-control-file" id="item_image">
    </div>
  <dl>
    <dt>Condition</dt>
    <dd>
      <select name="Condition">
        <option> New </option>
        <option> New (Other) </option>
        <option> Used </option>
      </select>
    </dd>
  </dl>
    <dl>
        <dt>Descirption</dt>
        <textarea type="text" name="decription" placeholder="Description..." rows = "5" cols="100"></textarea>
    </dl>
    <dl>
        <dt>Size</dt>
        <textarea type="text" name="size" cols="40" rows = "1" placeholder="Large, 20cm x 30cm x 10cm, etc..."></textarea>
    </dl>
    <div class="form-group row">
        <label class="col-2 col-form-label">Starting Price</label>
        <dd><input type="text" name="starting_price" /></dd>
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label">Reserve Price</label>
        <dd><input type="text" name="reserve_price" value="" /></dd>
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label">Buy Now Price</label>
        <dd><input type="text" name="buy_now_price" value="" /></dd>
    </div>
    <div class="form-group row">
        <label class="col-2 col-form-label">End Date</label>
            <input  type="datetime-local" >
    </div>
    <div id="operations">
    <input type="submit" value="Create Listing" />
  </div>
</form>

</div>


<?php include('../../private/shared/footer.php'); ?>
