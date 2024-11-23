@extends('layout.app')
@section('asset')
<link rel="stylesheet" type="text/css" href="{{URL::asset('assets')}}/vendors/css/forms/select/select2.min.css">
@endsection
@section('title', 'Menu')
@section('content')
<div id="show_edit">
</div>
<div class="row" id="show_add" style="display: none;">
    <div class="col-lg-12 col-xxl-4">
        <section class="multiple-validation">
            <div class="card mb-3">
                <div class="card-content">
                    <div class="card-body">
                        <form method="POST" class="form-horizontal p-3" id="form_add">@csrf
                            <div class="form-row mb-5">
                                <div class="form-group col-md-6">
                                    <label class="control-label">Nama Menu</label>
                                    <input type="text" name="name" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label">Parent Menu</label>
                                    <select class="select2 form-control parent_menu_id" name="parent_menu_id">
                                        <option value="">Select Parent Menu</option>
                                        @foreach($parents as $v)
                                        <option value="{{$v->menu_id}}">{{$v->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 form-group form-logo">
                                    <label class="control-label">Logo</label>
                                    <select class="select-icon form-control select2" name="icon">
                                        <option value="">Select Logo</option>
                                        @foreach($icons as $v)
                                        <option value="{{$v}}" data-icon="{{$v}}">{{$v}} </option>
                                        @endforeach
                                    </select>
                                    <div class="p-2 w-25">
                                        <span><i class="icon-show"></i></span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 urutan-menu">
                                    <label class="control-label">Urutan Menu</label>
                                    <input type="number" min="1" max="{{ $max_serial_menu }}" name="serial_menu" class="form-control form-control-lg" value="{{ $max_serial_menu }}">
                                    <input type="hidden" name="max_serial_menu" value="{{ $max_serial_menu }}">
                                </div>
                                <div class="form-group col-md-6 urutan-sub-menu">
                                    <label class="control-label">Urutan Sub Menu</label>
                                    <input type="number" min="1" max="10" name="serial_sub_menu" value="" class="form-control form-control-lg urutan-sub">
                                    <input type="hidden" class="max-serial-sub" name="max_serial_sub_menu" value="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-xs-12">
                                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                                    <button type="button" class="btn btn-danger mr-2 float-right" id="batalkan">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-xxl-4">
        <!--begin::List Widget 9-->
        <div class="card card-custom card-stretch gutter-b">
            <!--begin::Header-->
            <div class="card-header align-items-center border-0">
                <h5 class="text-dark font-weight-bold ml-3">List Menu</h5>
                <a class="btn btn-primary font-weight-bolder mr-3" id="tambah">Add Menu</a>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body" style="margin-top: -25px;">
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h4 class="card-title">List Admin</h4>
                                </div> -->
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Menu</th>
                                                        <th>Parent Menu</th>
                                                        <th>Logos</th>
                                                        <th>Urutan Menu</th>
                                                        <th>Urutan Sub Menu</th>
                                                        <!-- <th>Status</th> -->
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: Card-->
        <!--end: List Widget 9-->
        <!-- </div> -->
    </div>
</div>
    @endsection
    @section('js')
    <!-- scipt js -->
    @include('components/componen_crud')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/js-yaml/3.6.0/js-yaml.min.js'></script>
    <style>
        label.error {
        color: red;
    }

    </style>
    <script type="text/javascript">
    //global variable
    var url_post = '/post-menu'
    var url_data = '/list-menu'
    var tujuan_aksi = 'menu'

    $(function() {
        //$('#myTable').DataTable();
        data_tabel()
        $('.urutan-sub-menu').hide()
        $(".select2-container--default").css('width', '100%');

    });

    function data_tabel() {
        var xin_table = $('#myTable').DataTable({
            "bDestroy": true,
            "ajax": {
                url: url_data,
                type: 'GET'
            }
        });
    }

    $('.select-icon').change(function() {
        $('.icon-show').attr('class', 'icon-show ' + this.value + ' fa-3x')
    });

    function parent_change(value) {
        if (value != '') {
            $('.urutan-menu').hide()
            $('.form-logo').hide()
            $('.urutan-sub-menu').show()
            $.ajax({ //line 28
                type: 'GET',
                url: '/get-max-serial/' + value,
                success: function(max_serial) {
                    $('.urutan-sub').attr('max', max_serial).val(max_serial)
                    $('.max-serial-sub').val(max_serial)
                }
            });
        } else {
            $('.urutan-menu').show()
            $('.form-logo').show()
            $('.urutan-sub-menu').hide()
        }
    }

    $('.parent_menu_id').change(function() {
        parent_change(this.value)
    });

    $('.select2').on('change', function() { // when the value changes
        $(this).valid(); // trigger validation on this element
    });

    $('#tambah').on("click", function() {
        // alert('tes')
        $("#hide_add").css('display', 'none');
        $("#show_add").css('display', '');
    });
    $('#batalkan').on("click", function() {
        $("#hide_add").css('display', '');
        $("#show_add").css('display', 'none');
    });

    // batalkan edit
    $(document).off('click', '#batalkan3').on('click', '#batalkan3', function() {
        $("#hide_add").css('display', '');
        $("#show_edit").css('display', 'none');
    });

    $("#form_add").validate({
        submitHandler: function(form) {
            $.ajax({ //line 28
                type: 'POST',
                url: url_post,
                dataType: 'json',
                data: new FormData($("#form_add")[0]),
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.code == 200) {
                        document.getElementById("form_add").reset();
                        $("#hide_add").css('display', '');
                        $("#show_add").css('display', 'none');
                        $("#message").remove();
                        show_toast(data.message, 1);

                            location.reload();

                        data_tabel()
                    }
                }
            });
        }
    });

    $(document).off('click', '.edit_data').on('click', '.edit_data', function() {
        console.log('Ok')
        var id = $(this).attr('id');

        $("#detail_edit").remove();
        //alert("sini kan")
        $("#hide_add").css('display', 'none');
        $("#show_add").css('display', 'none');
        // $("#titel_head").remove();
        // $("#head_modul").append('<span id="titel_head">Edit Data Admin</span>');

        $.ajax({
            url: '/detail/' + tujuan_aksi + '/' + id,
            type: "GET",
            success: function(response) {
                console.log(response);
                $(window).scrollTop(0);

                if (response) {
                    $("#show_edit").html(response);
                    $("#show_edit").css('display', '');
                }
                $('.select2').select2();
                $(".select2-container--default").css('width', '100%');
            }
        });
    });

    function setup_ajax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    $(document).off('click', '#kirim_edit').on('click', '#kirim_edit', function() {
        setup_ajax()

        $.ajax({ //line 28
            type: 'POST',
            url: '/update/' + tujuan_aksi,
            dataType: 'json',
            data: new FormData($("#form_edit")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                $(".edit-modal-data").modal('hide');
                if (data.code == 200) {
                    document.getElementById("form_edit").reset();
                    $("#message").remove();
                    show_toast(data.message, 1);

                    $("#hide_add").css('display', '');
                    $("#show_edit").css('display', 'none');

                        location.reload();
                }
            }
        });

    });

    function select_gambar(input) {
        //alert("okey");
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('.gambar')
                    .attr('src', e.target.result)
                    .css('width', '150px').show()
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    </script>
    @endsection
