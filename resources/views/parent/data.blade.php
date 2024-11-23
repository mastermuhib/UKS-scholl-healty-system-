@if(count($data) > 0)
<div class="row">
	@foreach($data as $d)
	<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 mt-3">
		<!--begin::Card-->
		<div class="card card-custom gutter-b card-stretch">
			<!--begin::Body-->
			<div class="card-body pt-4">
				<!--begin::Toolbar-->
				<div class="d-flex justify-content-end">
					<div class="dropdown dropdown-inline" data-toggle="tooltip" title="" data-placement="left" data-original-title="Quick actions">
						<a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="ki ki-bold-more-hor"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="">
							<!--begin::Navigation-->
							<ul class="navi navi-hover">
								<li class="navi-header font-weight-bold py-4">
									<span class="font-size-lg">Action:</span>
									<i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="" data-original-title="Click to learn more..."></i>
								</li>
								<li class="navi-separator mb-3 opacity-70"></li>
								<li class="navi-item">
									<a href="/user/parent/{{base64_encode($d->id)}}" class="navi-link">
										<span class="navi-text">
											<span class="label label-xl label-inline label-light-success"><i class="fas fa-edit text-success mr-2"></i> Edit</span>
										</span>
									</a>
								</li>
								<li class="navi-item">
									<a href="javascript:void(0)" class="navi-link" onclick="Delete('{{$d->id}}')">
										<span class="navi-text">
											<span class="label label-xl label-inline label-light-danger"><i class="fas fa-trash text-danger mr-2"></i> Hapus</span>
										</span>
									</a>
								</li>
							</ul>
							<!--end::Navigation-->
						</div>
					</div>
				</div>
				<!--end::Toolbar-->
				<!--begin::User-->
				<div class="d-flex align-items-end mb-7">
					<!--begin::Pic-->
					<div class="d-flex align-items-center">
						<!--begin::Pic-->
						<div class="flex-shrink-0 mr-4 mt-lg-0 mt-3">
							@if ($d->image != null)
							<div class="symbol symbol-circle symbol-lg-75">
								<img src="{{env('BASE_IMG')}}{{$d->image}}" alt="image">
							</div>
                            @else
                            <div class="d-flex align-items-center">
                            	<div class="symbol symbol-60 symbol-circle symbol-light-warning flex-shrink-0">
                            		<span class="symbol-label font-size-h4 font-weight-bold">{{substr($d->student_parent_name, 0, 1)}}</span>
                            	</div>
                            </div>
                            @endif
						</div>
						<!--end::Pic-->
						<!--begin::Title-->
						<div class="d-flex flex-column">
							<a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">{{$d->student_parent_name}}</a>
							<span class="text-muted font-weight-bold">{{$d->parent_type}}</span>
						</div>
						<!--end::Title-->
					</div>
					<!--end::Title-->
				</div>
				<!--end::User-->
				<!--begin::Desc-->
				<p class="mb-7">Orang tua dari :
				<a href="#" class="text-primary pr-1">{{$d->student}} </a></p>
				<!--end::Desc-->
				<!--begin::Info-->
				<div class="mb-7">
					<div class="d-flex justify-content-between align-items-center">
						<span class="text-dark-75 font-weight-bolder mr-2">Email:</span>
						<a href="#" class="text-muted text-hover-primary">{{$d->email}}</a>
					</div>
					<div class="d-flex justify-content-between align-items-cente my-1">
						<span class="text-dark-75 font-weight-bolder mr-2">Phone:</span>
						<a href="#" class="text-muted text-hover-primary">{{$d->phone}}</a>
					</div>
					<div class="d-flex justify-content-between align-items-center">
						<span class="text-dark-75 font-weight-bolder mr-2">Domisili:</span>
						<span class="text-muted font-weight-bold">{{$d->name}}</span>
					</div>
				</div>
				<!--end::Info-->
                @if($d->status == 1)
				<a href="javascript:void(0)" class="btn aksi_status btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4" id="{{$d->id}}" aksi="nonaktif" tujuan="parent" data="">Aktif</a>
				@else
				<a href="javascript:void(0)" class="btn aksi_status btn-block btn-sm btn-light-danger font-weight-bolder text-uppercase py-4" id="{{$d->id}}" aksi="aktif" tujuan="parent" data="">Tidak Aktif</a>
				@endif
			</div>
			<!--end::Body-->
		</div>
		<!--end::Card-->
	</div>
	@endforeach
</div>
@else
Belum ada data
@endif
<script type="text/javascript">
	$(document).off('click', '.aksi_status').on('click', '.aksi_status', function() {
        $("#modal_detail").remove();
        $('#title-modal').html('Warning !!!');
        $('#aksi_kirim_status').html('Ok');
        var id = $(this).attr('id');
        $("#id_data_status").val(id);
        var aksi = $(this).attr('aksi');
        //alert(aksi);
        $("#id_aksi_status").val(aksi);
        //alert(aksi);
        var tujuan = $(this).attr('tujuan');
        $("#id_tujuan_status").val(tujuan);
        
        if (aksi == 'aktif') {
            var kata = "Apakah Anda Akan Mengaktifkan Data Ini ??";
        } else {
            var kata = "Apakah Anda Akan Menon aktifkan Data Ini ??";
        } 
        var app = '<span id="modal_detail_status" style="color:red;font-weight:bold;font-size:12px;">' + kata + '</span>';
        
        $(".modal_aksi_status").html(app);
        $("#modal_aksi_status").modal('show');

    });

    $(document).off('click', '#aksi_kirim_status').on('click', '#aksi_kirim_status', function() {
        //alert("coba")
        id = $("#id_data_status").val();
        //alert(id);
        aksi = $("#id_aksi_status").val();
        tujuan = $("#id_tujuan_status").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/' + aksi + '/' + tujuan,
            dataType: 'json',
            data: new FormData($("#form_aksi_status")[0]),
            processData: false,
            contentType: false,
            success: function(data) {
                if (data.code == 200) {
                    show_toast(data.message, 1);
                    DataTable()
                } else {
                    show_toast(data.message, 2);
                }
            }
        });
    });

    function Delete(id){
    	$("#modal_delete_data").modal('show');
    	$("#aksi_delete").attr('no',id);
    }

    $(document).off('click', '#aksi_delete').on('click', '#aksi_delete', function() {
    	id = $(this).attr('no');
    	$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ //line 28
            type: 'POST',
            url: '/delete/parent',
            dataType: 'json',
            data: { id:id },
            success: function(data) {
                if (data.code == 200) {
                    show_toast(data.message, 1);
                    DataTable()
                } else {
                    show_toast(data.message, 2);
                }
            }
        });
    });
</script>