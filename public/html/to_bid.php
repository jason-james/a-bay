<?php require_once ("../../private/initialise.php") ?>

<?php include("../../private/shared/header.php")?>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">A-Bay</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
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
<div class="container">
    <!-- Modal -->
    <div class="modal fade" id="bidModal" tabindex="-1" role="dialog" aria-labelledby="bidModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Click to bid</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">£</span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="<?php echo url_for('/html/handle_bid_submit.php'); ?>" method="post">
                        <input type="number" name="Enter bid amount" value=""/>
                        <input type="submit" value="Click to submit bid" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessage" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Contact seller</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name" value="ucabjja">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Send</button>
                </div>
            </div>
        </div>
    </div>

    <div class="input-group my-4">
        <input type="text" class="form-control" aria-label="Text input with segmented dropdown button">
        <div class="input-group-append">
            <a class="btn btn-primary" href="search_results.php">Search</a>

            <button class="btn btn-outline-primary search-bar-dropdown-toggle dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-sm-5">
            <img id="item-display" src="https://media.karousell.com/media/photos/products/2018/10/06/corsair_gs600_80plus_psu_1538780922_81e254d1.jpg" height="375" width="450" alt=""></img>
        </div>

        <div class="col-sm-7">
            <div class="h5">Corsair GS600 600 Watt PSU</div>
            <div class=>The Corsair Gaming Series GS600 is the ideal price/performance choice for mid-spec gaming PC</div>
            <hr>
            <div class="product-price">Current bid: <span><strong>$ 1234.00</strong></span></div>
            <div class="product-price">Buy it now: <span><strong>$ 2145.00</strong></span></div>
            <div class="btn-group cart">
                <button type="button" class="btn btn-success">
                    Buy now
                </button>
            </div>
            <div class="btn-group cart">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#bidModal">
                    Make bid
                </button>
            </div>
            <div class="btn-group wishlist my-2">
                <button type="button" class="btn btn-outline-dark">
                    Add to wishlist
                </button>
            </div>
            <!-- Card -->

            <div class="card h-40 my-2">

                <!-- Card content -->
                <div class="card-body">
                    <!-- Title -->
                    <h5 class="card-subtitle"><a>Ucabjja</a></h5>
                    <!-- Data -->
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>

                    <p class="mb-2">Seller • London, UK</p>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendMessage">Contact</button>
                    <button type="button" class="btn btn-primary">Feedback</button>

                </div>

            </div>
            <!-- Card -->
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Product Description</h4>
                    The Corsair Gaming Series GS600 power supply is the ideal price-performance solution for building or upgrading a Gaming PC.
                    A single +12V rail provides up to 48A of reliable, continuous power for multi-core gaming PCs with multiple graphics cards.
                    The ultra-quiet, dual ball-bearing fan automatically adjusts its speed according to temperature, so it will never intrude on your music and games.
                    Blue LEDs bathe the transparent fan blades in a cool glow. Not feeling blue? You can turn off the lighting with the press of a button.
                    <br></br>

                    <li>It supports the latest ATX12V v2.3 standard and is backward compatible with ATX12V 2.2 and ATX12V 2.01 systems</li>
                    <li>An ultra-quiet 140mm double ball-bearing fan delivers great airflow at an very low noise level by varying fan speed in response to temperature</li>
                    <li>80Plus certified to deliver 80% efficiency or higher at normal load conditions (20% to 100% load)</li>
                    <li>0.99 Active Power Factor Correction provides clean and reliable power</li>
                    <li>Universal AC input from 90~264V — no more hassle of flipping that tiny red switch to select the voltage input!</li>
                    <li>Extra long fully-sleeved cables support full tower chassis</li>
                    <li>A three year warranty and lifetime access to Corsair’s legendary technical support and customer service</li>
                    <li>Over Current/Voltage/Power Protection, Under Voltage Protection and Short Circuit Protection provide complete component safety</li>
                    <li>Dimensions: 150mm(W) x 86mm(H) x 160mm(L)</li>
                    <li>MTBF: 100,000 hours</li>
                    <li>Safety Approvals: UL, CUL, CE, CB, FCC Class B, TÜV, CCC, C-tick</li>
                </div>
            </div>
        </div>
    </div>

    <h4>Recommendations</h4>
    <!-- /.row -->
    <div class="row my-4">

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Two</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Three</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Four</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card h-50">
                <a href="#"><img class="card-img-top" src="http://placehold.it/250x125" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#">Item Four</a>
                    </h4>
                    <h5>$24.99</h5>
                    <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet numquam aspernatur!</p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>


