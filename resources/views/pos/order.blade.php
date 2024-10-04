@extends('pos.layouts.master')

@section('title', 'order')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card card-block card-stretch card-height">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-header-toolbar d-flex align-items-center">
                    <button class="btn btn-warning">View All</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="" placeholder="" aria-controls="DataTables_Table_0"></label></div><table class="table mb-0 table-borderless data-table dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead class="order-resto">
                            <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Order ID: activate to sort column descending" style="width: 84.6875px;">Order ID</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Order Name: activate to sort column ascending" style="width: 154.65px;">Order Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Customer Name: activate to sort column ascending" style="width: 171.238px;">Customer Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Date &amp;amp; Time: activate to sort column ascending" style="width: 171.875px;">Date &amp; Time</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 75.95px;">Amount</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Ph No.: activate to sort column ascending" style="width: 180.25px;">Ph No.</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Quantity: activate to sort column ascending" style="width: 82.125px;">Quantity</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Location: activate to sort column ascending" style="width: 80.125px;">Location</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 76.025px;">Status</th><th scope="col" class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 77.075px;">Action</th></tr>
                        </thead>
                        <tbody class="odr-tble">



                        <tr role="row" class="odd">
                                <td class="sorting_1">
                                    #12345
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Mario Speedwagon
                                </td>
                                <td>
                                    09/09/2020 , 09:30
                                </td>
                                <td>
                                    $85
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    05
                                </td>
                                <td>
                                    Canada
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr><tr role="row" class="even">
                                <td class="sorting_1">
                                    #56565
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Petey Cruiser
                                </td>
                                <td>
                                    08/09/2020 , 11:30
                                </td>
                                <td>
                                    $21
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    15
                                </td>
                                <td>
                                    England
                                </td>
                                <td>
                                    <span class="badge badge-danger">Pending</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr><tr role="row" class="odd">
                                <td class="sorting_1">
                                    #766768
                                </td>
                                <td>Lorem Ipsum Idor
                                </td>
                                <td>
                                    Anna Sthesia
                                </td>
                                <td>
                                    05/09/2020 , 07:30
                                </td>
                                <td>
                                    $65
                                </td>
                                <td>
                                    + 114 12345 67891
                                </td>
                                <td>
                                    08
                                </td>
                                <td>
                                    London
                                </td>
                                <td>
                                    <span class="badge badge-success">Paid</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge bg-success-light mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit" href="#"><i class="ri-pencil-line"></i></a>
                                        <a class="badge bg-danger-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" href="#"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr></tbody>
                    </table><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 1 to 3 of 3 entries</div><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0" id="DataTables_Table_0_previous">Previous</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a></span><a class="paginate_button next disabled" aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0" id="DataTables_Table_0_next">Next</a></div></div>
                </div>
            </div>
        </div>
    </div>

@endsection
