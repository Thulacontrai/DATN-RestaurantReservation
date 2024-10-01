

<div class="modal fade modal-default" id="payment-completed" aria-labelledby="payment-completed">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos.html">
                    <div class="icon-head">
                        <a href="javascript:void(0);">
                            <i data-feather="check-circle" class="feather-40"></i>
                        </a>
                    </div>
                    <h4>Payment Completed</h4>
                    <p class="mb-0">Do you want to Print Receipt for the Completed Order</p>
                    <div class="modal-footer d-sm-flex justify-content-between">
                        <button type="button" class="btn btn-primary flex-fill" data-bs-toggle="modal"
                            data-bs-target="#print-receipt">Print Receipt<i
                                class="feather-arrow-right-circle icon-me-5"></i></button>
                        <button type="submit" class="btn btn-secondary flex-fill">Next Order<i
                                class="feather-arrow-right-circle icon-me-5"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-default" id="print-receipt" aria-labelledby="print-receipt">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="d-flex justify-content-end">
                <button type="button" class="close p-0" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="icon-head text-center">
                    <a href="javascript:void(0);">
                        <img src="https://img.freepik.com/premium-vector/steak-house-logo-template_86683-92.jpg"
                            width="100" height="30" alt="Receipt Logo">
                    </a>
                </div>
                <div class="text-center info text-center">
                    <h6>Steak House</h6>
                    <p class="mb-0">Phone Number: +1 5656665656</p>
                    <p class="mb-0">Email: <a
                            href="https://dreamspos.dreamstechnologies.com/cdn-cgi/l/email-protection#98fde0f9f5e8f4fdd8fff5f9f1f4b6fbf7f5"><span
                                class="__cf_email__"
                                data-cfemail="f5908d9498859990b59298949c99db969a98">[email&#160;protected]</span></a>
                    </p>
                </div>
                <div class="tax-invoice">
                    <h6 class="text-center">Tax Invoice</h6>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="invoice-user-name"><span>Name: </span><span>John Doe</span></div>
                            <div class="invoice-user-name"><span>Invoice No: </span><span>CS132453</span></div>
                            <div class="invoice-user-name"><span>Date: </span><span>01.07.2022</span></div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="invoice-user-name"><span>Customer Id: </span><span>#LL93784</span></div>
                            <div class="invoice-user-name"><span>Tables: </span><span>#LL93784</span></div>

                        </div>
                    </div>
                </div>
                <table class="table-borderless w-100 table-fit">
                    <thead>
                        <tr>
                            <th># Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. Salad trái cây</td>
                            <td>$50</td>
                            <td>3</td>
                            <td class="text-end">$150</td>
                        </tr>
                        <tr>
                            <td>2. Sous Vide Steak</td>
                            <td>$50</td>
                            <td>2</td>
                            <td class="text-end">$100</td>
                        </tr>

                        <tr>
                            <td colspan="4">
                                <table class="table-borderless w-100 table-fit">
                                    <tr>
                                        <td>Temporarily calculated :</td>
                                        <td class="text-end">$700.00</td>
                                    </tr>
                                    <tr>
                                        <td>Discount :</td>
                                        <td class="text-end">-$50.00</td>
                                    </tr>

                                    <tr>
                                        <td>Tax (5%) :</td>
                                        <td class="text-end">$5.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total Bill :</td>
                                        <td class="text-end">$655.00</td>
                                    </tr>
                                    <tr>
                                        <td>Due :</td>
                                        <td class="text-end">$0.00</td>
                                    </tr>
                                    <tr>
                                        <td>Total Payable :</td>
                                        <td class="text-end">$655.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center invoice-bar">
                    <p>**VAT against this challan is payable through central registration. Thank you for your
                        business!</p>
                    <a href="javascript:void(0);">
                        <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/barcode/barcode-03.jpg"
                            alt="Barcode">
                    </a>
                    <p>Sale 31</p>
                    <p>Thank You For Shopping With Us. Please Come Again</p>
                    <a href="javascript:void(0);" class="btn btn-primary">Print Receipt</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-default pos-modal" id="products" aria-labelledby="products">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <h5 class="me-4">Products</h5>
                    <span class="badge bg-info d-inline-block mb-0">Order ID : #666614</span>
                </div>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos.html">
                    <div class="product-wrap">
                        <div class="product-list d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-fill">
                                <a href="javascript:void(0);" class="img-bg me-2">
                                    <img src="https://cdn.tgdd.vn/2020/11/CookProduct/1-1200x676-22.jpg"
                                        alt="Products">
                                </a>
                                <div class="info d-flex align-items-center justify-content-between flex-fill">
                                    <div>
                                        <span>PT0005</span>
                                        <h6><a href="javascript:void(0);">Sous Vide Steak</a></h6>
                                    </div>
                                    <p>$2000</p>
                                </div>
                            </div>
                        </div>
                        <div class="product-list d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center flex-fill">
                                <a href="javascript:void(0);" class="img-bg me-2">
                                    <img src="https://cdn.tgdd.vn/Files/2017/01/12/936951/giai-ngan-ngay-tet-voi-mon-salad-hoa-qua-kieu-han-quoc-202205241325570525.jpg"
                                        alt="Products">
                                </a>
                                <div class="info d-flex align-items-center justify-content-between flex-fill">
                                    <div>
                                        <span>PT0235</span>
                                        <h6><a href="javascript:void(0);">Salad trái cây</a></h6>
                                    </div>
                                    <p>$3000</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer d-sm-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="table" tabindex="-1" aria-labelledby="table" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Table layout</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div>
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app b1" viewBox="0 0 16 16">
                    <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                    <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 1</text>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                    <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                    <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 2</text>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                    <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                    <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 3</text>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                    <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                    <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 4</text>
                  </svg>
                  <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                    <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                    <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 5</text>
                  </svg>
                </div>

                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app b1" viewBox="0 0 16 16">
                        <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                        <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 6</text>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                        <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                        <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 7</text>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                        <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                        <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 8</text>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                        <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                        <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 9</text>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                        <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                        <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 10</text>
                      </svg>
                    </div>

                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app b1" viewBox="0 0 16 16">
                            <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                            <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 11</text>
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                            <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                            <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 12</text>
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                            <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                            <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 13</text>
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                            <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                            <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 14</text>
                          </svg>
                          <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                            <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                            <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 15</text>
                          </svg>
                        </div>

                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app b1" viewBox="0 0 16 16">
                                <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                                <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 16</text>
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                                <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                                <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 17</text>
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                                <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                                <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 18</text>
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                                <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                                <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 19</text>
                              </svg>
                              <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-app" viewBox="0 0 16 16">
                                <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
                                <text x="8" y="10" font-size="3" text-anchor="middle" fill="black">Bàn 20</text>
                              </svg>
                            </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create" tabindex="-1" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos.html">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Customer Name</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Email</label>
                                <input type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Number of people</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks">
                                <label>Table</label>
                                <input type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-sm-flex justify-content-end">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit me-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-default pos-modal" id="hold-order" aria-labelledby="hold-order">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5>Hold order</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos.html">
                    <h2 class="text-center p-4">4500.00</h2>
                    <div class="input-block">
                        <label>Order Reference</label>
                        <input class="form-control" type="text" value placeholder>
                    </div>
                    <p>The current order will be set on hold. You can retreive this order from the pending order
                        button. Providing a reference to it might help you to identify the order more quickly.</p>
                    <div class="modal-footer d-sm-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-default pos-modal" id="edit-product" aria-labelledby="edit-product">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5>Red Nike Laser</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <form action="https://dreamspos.dreamstechnologies.com/html/template/pos.html">
                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Product Name <span>*</span></label>
                                <input type="text" placeholder="45">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Tax Type <span>*</span></label>
                                <select class="select">
                                    <option>Exclusive</option>
                                    <option>Inclusive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Tax <span>*</span></label>
                                <input type="text" placeholder="% 15">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Discount Type <span>*</span></label>
                                <select class="select">
                                    <option>Percentage</option>
                                    <option>Early payment discounts</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Discount <span>*</span></label>
                                <input type="text" placeholder="15">
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12 col-12">
                            <div class="input-blocks add-product">
                                <label>Sale Unit <span>*</span></label>
                                <select class="select">
                                    <option>Kilogram</option>
                                    <option>Grams</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-sm-flex justify-content-end">
                        <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade pos-modal" id="recents" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Recent Transactions</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="tabs-sets">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="purchase-tab" data-bs-toggle="tab"
                                data-bs-target="#purchase" type="button" aria-controls="purchase"
                                aria-selected="true" role="tab">Purchase</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab"
                                data-bs-target="#payment" type="button" aria-controls="payment"
                                aria-selected="false" role="tab">Payment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="return-tab" data-bs-toggle="tab"
                                data-bs-target="#return" type="button" aria-controls="return"
                                aria-selected="false" role="tab">Return</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="purchase" role="tabpanel"
                            aria-labelledby="purchase-tab">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-input">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Pdf"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/pdf.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Excel"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Print"><i data-feather="printer"
                                                    class="feather-rotate-ccw"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Customer</th>
                                            <th>Amount </th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0101</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0102</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0103</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0104</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0105</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0106</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0107</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="payment" role="tabpanel">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-input">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Pdf"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/pdf.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Excel"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-items-center justify-content-center"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Print"><i data-feather="printer"
                                                    class="feather-rotate-ccw"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Customer</th>
                                            <th>Amount </th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0101</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="return" role="tabpanel">
                            <div class="table-top">
                                <div class="search-set">
                                    <div class="search-input">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                                <div class="wordset">
                                    <ul>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Pdf"
                                                class="d-flex align-items-center justify-content-center"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/pdf.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Excel"
                                                class="d-flex align-items-center justify-content-center"><img
                                                    src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/excel.svg"
                                                    alt="img"></a>
                                        </li>
                                        <li>
                                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print"
                                                class="d-flex align-items-center justify-content-center"><i
                                                    data-feather="printer" class="feather-rotate-ccw"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table datanew">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Reference</th>
                                            <th>Customer</th>
                                            <th>Amount </th>
                                            <th class="no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>19 Jan 2023</td>
                                            <td>INV/SL0101</td>
                                            <td>Walk-in Customer</td>
                                            <td>$1500.00</td>
                                            <td class="action-table-data">
                                                <div class="edit-delete-action">
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="eye" class="feather-eye"></i></a>
                                                    <a class="me-2 p-2" href="javascript:void(0);"><i
                                                            data-feather="edit" class="feather-edit"></i></a>
                                                    <a class="p-2 confirm-text" href="javascript:void(0);"><i
                                                            data-feather="trash-2"
                                                            class="feather-trash-2"></i></a>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade pos-modal" id="orders" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Orders</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="tabs-sets">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="table-order-tab" data-bs-toggle="tab"
                                data-bs-target="#table-order" type="button" aria-controls="table-order"
                                aria-selected="true" role="tab">Table order</button>
                        </li>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="onhold" role="tabpanel"
                            aria-labelledby="onhold-tab">
                            <div class="table-top">
                                <div class="search-set w-100 search-order">
                                    <div class="search-input w-100">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666659</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Customer</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Botsford</td>
                                                </tr>
                                                <tr>
                                                    <td>Table</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Bàn 5</td>
                                                </tr>
                                                <tr class="mb-3">
                                                    <td>People</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">5</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Prepayment</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">$900</td>
                                                </tr>

                                                <tr>
                                                    <td>Date</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">29-08-2023 13:39:11</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="p-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-sm-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill" data-bs-toggle="modal" data-bs-target="#open">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666660</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Customer</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Botsford</td>
                                                </tr>
                                                <tr>
                                                    <td>Table</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Bàn 5</td>
                                                </tr>
                                                <tr class="mb-3">
                                                    <td>People</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">5</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Prepayment</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">$900</td>
                                                </tr>

                                                <tr>
                                                    <td>Date</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">29-08-2023 13:39:11</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="p-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                                <div class="default-cover p-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666661</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Customer</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Botsford</td>
                                                </tr>
                                                <tr>
                                                    <td>Table</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Bàn 5</td>
                                                </tr>
                                                <tr class="mb-3">
                                                    <td>People</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">5</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Prepayment</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">$900</td>
                                                </tr>

                                                <tr>
                                                    <td>Date</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">29-08-2023 13:39:11</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="p-4 mb-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="unpaid" role="tabpanel">
                            <div class="table-top">
                                <div class="search-set w-100 search-order">
                                    <div class="search-input">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-info d-inline-block mb-4">Order ID : #666662</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Customer</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Botsford</td>
                                                </tr>
                                                <tr>
                                                    <td>Table</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Bàn 5</td>
                                                </tr>
                                                <tr class="mb-3">
                                                    <td>People</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">5</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Prepayment</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">$900</td>
                                                </tr>

                                                <tr>
                                                    <td>Date</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">29-08-2023 13:39:11</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="p-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>

                                    </div>
                                    <p class="p-4 mb-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade pos-modal" id="booking" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Orders</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="tabs-sets">
                    <ul class="nav nav-tabs" id="myTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="table-order-tab" data-bs-toggle="tab"
                                data-bs-target="#table-order" type="button" aria-controls="table-order"
                                aria-selected="true" role="tab">Sắp đến</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="Pre-order-tab" data-bs-toggle="tab"
                                data-bs-target="#Pre-order" type="button" aria-controls="Pre-order"
                                aria-selected="true" role="tab">Quá giờ</button>
                        </li>

                      <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill" data-bs-toggle="modal" data-bs-target="#booking-new">Thêm mới</a>


                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="onhold" role="tabpanel"
                            aria-labelledby="onhold-tab">
                            <div class="table-top">
                                <div class="search-set w-100 search-order">
                                    <div class="search-input w-100">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666659</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Customer</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Botsford</td>
                                                </tr>
                                                <tr>
                                                    <td>Table</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">Bàn 5</td>
                                                </tr>
                                                <tr class="mb-3">
                                                    <td>People</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">5</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <table>
                                                <tr>
                                                    <td>Prepayment</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">$900</td>
                                                </tr>

                                                <tr>
                                                    <td>Date</td>
                                                    <td class="colon">:</td>
                                                    <td class="text">29-08-2023 13:39:11</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <p class="p-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-sm-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill" data-bs-toggle="modal" data-bs-target="#open">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                                    <p class="p-4 mb-4">Customer need to recheck the product once</p>
                                    <div class="btn-row d-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Open</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Products</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-default pos-modal" id="booking-new" tabindex="-1" aria-labelledby="booking-new">
    <div class="modal-dialog modal-xl modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Thêm mới đơn</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="tabs-sets">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="booking-onhold" role="tabpanel"
                            aria-labelledby="onhold-tab">
                            <div class="table-top">
                                <div class="search-set w-100 search-order">
                                    <div class="search-input w-100">
                                        <a class="btn btn-searchset d-flex align-items-center h-100"><img
                                                src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg"
                                                alt="img"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666659</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <form>
                                                <label>Thời gian nhận bàn</label>
                                                <input type="date" class="form-control">
                                                <br>
                                                <label >Số điện thoại</label>
                                                <input type="string" class="form-control">
                                                <label >Bàn</label>
                                                <input type="text" class="form-control">
                                                <label >Cọc trước</label>
                                                <input type="number" class="form-control">
                                            </form>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <form>
                                                <label>Số khách</label>
                                                <input type="number" class="form-control">
                                                <br>
                                                <label >Khách hàng</label>
                                                <input type="string" class="form-control">
                                                <label >Ghi chú</label>
                                                <input type="text" class="form-control">
                                            </form>
                                        </div>
                                    </div>

                                    <div class="btn-row d-sm-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);"
                                            class="btn btn-info btn-icon flex-fill">Hủy đơn</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-danger btn-icon flex-fill">Xác nhận</a>
                                        <a href="javascript:void(0);"
                                            class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-default pos-modal" id="open" tabindex="-1" aria-labelledby="open">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header p-4">
                <h5 class="modal-title">Orders detail</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="tabs-sets">
                    <div class="tab-content">
                        <!-- Unique ID for 'Open' modal -->
                        <div class="tab-pane fade show active" id="open-order-onhold" role="tabpanel"
                            aria-labelledby="open-order-onhold-tab">
                            <div class="table-top">
                                <div class="search-set w-100 search-order">
                                    <div class="search-input w-100">
                                        <a class="btn btn-searchset d-flex align-items-center h-100">
                                            <img src="https://dreamspos.dreamstechnologies.com/html/template/assets/img/icons/search-white.svg" alt="img">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="order-body">
                                <!-- Order details for 'Open' -->
                                <div class="default-cover p-4 mb-4">
                                    <span class="badge bg-secondary d-inline-block mb-4">Order ID : #666659</span>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <form>
                                                <label>Thời gian nhận bàn</label>
                                                <input type="date" class="form-control">
                                                <br>
                                                <label>Số điện thoại</label>
                                                <input type="string" class="form-control">
                                                <label>Bàn</label>
                                                <input type="text" class="form-control">
                                                <label>Cọc trước</label>
                                                <input type="number" class="form-control">
                                            </form>
                                        </div>
                                        <div class="col-sm-12 col-md-6 record mb-3">
                                            <form>
                                                <label>Số khách</label>
                                                <input type="number" class="form-control">
                                                <br>
                                                <label>Khách hàng</label>
                                                <input type="string" class="form-control">
                                                <label>Ghi chú</label>
                                                <input type="text" class="form-control">
                                            </form>
                                        </div>
                                    </div>
                                    <div class="btn-row d-sm-flex align-items-center justify-content-between">
                                        <a href="javascript:void(0);" class="btn btn-info btn-icon flex-fill">Hủy đơn</a>
                                        <a href="javascript:void(0);" class="btn btn-danger btn-icon flex-fill">Xác nhận</a>
                                        <a href="javascript:void(0);" class="btn btn-success btn-icon flex-fill">Print</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="customizer-links" id="setdata">
    <ul class="sticky-sidebar">
        <li class="sidebar-icons">
            <a href="#" class="navigation-add" data-bs-toggle="tooltip" data-bs-placement="left"
                data-bs-original-title="Theme">
                <i data-feather="settings" class="feather-five"></i>
            </a>
        </li>
    </ul>
</div>
