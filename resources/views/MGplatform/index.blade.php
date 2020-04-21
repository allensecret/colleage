@extends('MGplatform.layouts.layout')
@push('script')
    <script>
        $(document).ready(function () {
            $('li[name=dashboard_li]').addClass('active');
        });
    </script>
@endpush
@section('navbar')
    <h3>統計數據</h3>
@endsection
@section('content')
    <div class="row align-items-stretch">

        <div class="col-lg-12 mb-12">
            <!-- Dropdown Card Example -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">依學年度統計學生聽課次數</h6>
                    <!-- Card Header Dropdown -->
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownCardExample" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw ml-1 text-gray-400"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in" aria-labelledby="dropdownCardExample">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    Dropdown menus can be placed in the card header in order to extend the functionality of a basic card. In this dropdown card example, the Font Awesome vertical ellipsis icon in the card header can be clicked on in order to toggle a dropdown menu.
                </div>
            </div>

            <!-- Dropdown Card Example -->
            <div class="card border-0 shadow mb-4">
                <div class="card-header border-0 py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">依學生個人統計聽課次數</h6>
                    <!-- Card Header Dropdown -->
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownCardExample" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw ml-1 text-gray-400"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in" aria-labelledby="dropdownCardExample">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    Dropdown menus can be placed in the card header in order to extend the functionality of a basic card. In this dropdown card example, the Font Awesome vertical ellipsis icon in the card header can be clicked on in order to toggle a dropdown menu.
                </div>
            </div>

        </div>
    </div>
@endsection
