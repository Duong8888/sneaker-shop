@extends('client.templates.layout')
@section('content')
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list" id="nav-tab">
                                <li><a href="#dashboard" data-toggle="tab" class="nav-link" aria-selected="true"
                                       role="tab" tabindex="-1">Dashboard</a></li>
                                <li><a href="#orders" data-toggle="tab" class="nav-link active" aria-selected="false"
                                       role="tab">Orders</a></li>
                                <li><a href="#downloads" data-toggle="tab" class="nav-link" aria-selected="false"
                                       role="tab" tabindex="-1">Downloads</a></li>
                                <li><a href="#address" data-toggle="tab" class="nav-link" aria-selected="false"
                                       role="tab" tabindex="-1">Addresses</a></li>
                                <li><a href="#account-details" data-toggle="tab" class="nav-link" aria-selected="false"
                                       tabindex="-1" role="tab">Account details</a></li>
                                <li><a href="login.html" class="nav-link" aria-selected="false" role="tab"
                                       tabindex="-1">logout</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade " id="dashboard" role="tabpanel">
                                <h3>Dashboard </h3>
                                <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                                        orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                                        href="#">Edit your password and account details.</a></p>
                            </div>
                            <div class="tab-pane fade active show" id="orders" role="tabpanel">
                                <h3>Orders</h3>
                                <div class="table-responsive">
                                    @if(count($data['orderList']) > 0)
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data['orderList'] as $key => $value)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$value->created_at}}</td>
                                                    <td><span
                                                            class="success">{{$value->delivery_status == 1 ? 'Chờ sử lý' : ($value->delivery_status == 2? 'Đang giao hàng' : 'Giao hàng thành công')}}</span>
                                                    </td>
                                                    <td>{{number_format($value->total)}} VND</td>
                                                    <td><a href="" class="view">view</a></td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="downloads" role="tabpanel">
                                <h3>Downloads</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Downloads</th>
                                            <th>Expires</th>
                                            <th>Download</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Shopnovilla - Free Real Estate PSD Template</td>
                                            <td>May 10, 2018</td>
                                            <td><span class="danger">Expired</span></td>
                                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                        </tr>
                                        <tr>
                                            <td>Organic - ecommerce html template</td>
                                            <td>Sep 11, 2018</td>
                                            <td>Never</td>
                                            <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="address" role="tabpanel">
                                <p>The following addresses will be used on the checkout page by default.</p>
                                <h4 class="billing-address">Billing address</h4>
                                <a href="#" class="view">Edit</a>
                                <p><strong>Bobby Jackson</strong></p>
                                <address>
                                    House #15<br>
                                    Road #1<br>
                                    Block #C <br>
                                    Banasree <br>
                                    Dhaka <br>
                                    1212
                                </address>
                                <p>Bangladesh</p>
                            </div>
                            <div class="tab-pane fade" id="account-details" role="tabpanel">
                                <h3>Account details </h3>
                                <div class="login">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form action="#">
                                                <p>Already have an account? <a href="#">Log in instead!</a></p>
                                                <div class="input-radio">
                                                    <span class="custom-radio"><input type="radio" value="1"
                                                                                      name="id_gender"> Mr.</span>
                                                    <span class="custom-radio"><input type="radio" value="1"
                                                                                      name="id_gender"> Mrs.</span>
                                                </div>
                                                <br>
                                                <label>First Name</label>
                                                <input type="text" name="first-name" fdprocessedid="21prsi">
                                                <label>Last Name</label>
                                                <input type="text" name="last-name" fdprocessedid="6lpini">
                                                <label>Email</label>
                                                <input type="text" name="email-name" fdprocessedid="xmntv">
                                                <label>Password</label>
                                                <input type="password" name="user-password" fdprocessedid="h0ssrc">
                                                <label>Birthdate</label>
                                                <input type="text" placeholder="MM/DD/YYYY" value="" name="birthday"
                                                       fdprocessedid="vopgam">
                                                <span class="example">
                                                  (E.g.: 05/31/1970)
                                                </span>
                                                <br>
                                                <span class="custom_checkbox">
                                                    <input type="checkbox" value="1" name="optin">
                                                    <label>Receive offers from our partners</label>
                                                </span>
                                                <br>
                                                <span class="custom_checkbox">
                                                    <input type="checkbox" value="1" name="newsletter">
                                                    <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                                </span>
                                                <div class="save_button primary_btn default_button">
                                                    <button type="submit" fdprocessedid="fbayn8">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
