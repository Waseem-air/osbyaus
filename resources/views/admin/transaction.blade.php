@extends("admin.layout.main")
@section('content')
  <div class="main-content">
        <div class="main-content-inner">
            <div class="main-content-wrap">
                <div class="flex items-center flex-wrap justify-between gap20 mb-30">
                    <h3>Transaction History</h3>
                </div>

                <!-- Table version -->
                <div class="wg-box mt-5">
                    <div class="table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#5089</td>
                                    <td>Joseph Wheeler</td>
                                    <td>6 April, 2023</td>
                                    <td>RS. 2,564</td>
                                    <td>Bank Transfer</td>
                                    <td><span class="block-stock bg-1 fw-7">Paid</span></td>
                                    <td>View Details</td>
                                </tr>
                                <tr>
                                    <td>#5090</td>
                                    <td>Joseph Wheeler</td>
                                    <td>6 April, 2023</td>
                                    <td>RS. 2,564</td>
                                    <td>Bank Transfer</td>
                                    <td><span class="block-stock bg-1 fw-7">Paid</span></td>
                                    <td>View Details</td>
                                </tr>
                                <tr>
                                    <td>#5091</td>
                                    <td>Joseph Wheeler</td>
                                    <td>6 April, 2023</td>
                                    <td>RS. 2,564</td>
                                    <td>Bank Transfer</td>
                                    <td><span class="block-stock bg-1 fw-7">Paid</span></td>
                                    <td>View Details</td>
                                </tr>
                                <tr>
                                    <td>#5092</td>
                                    <td>Joseph Wheeler</td>
                                    <td>6 April, 2023</td>
                                    <td>RS. 2,564</td>
                                    <td>Bank Transfer</td>
                                    <td><span class="block-stock bg-1 fw-7">Paid</span></td>
                                    <td>View Details</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10">
                        <div class="text-tiny">Showing 10 entries</div>
                        <ul class="wg-pagination">
                            <li><a href="#"><i class="icon-chevron-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#"><i class="icon-chevron-right"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /table version -->
            </div>
        </div>
    </div>
@endsection
