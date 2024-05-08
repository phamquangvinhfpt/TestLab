<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
	<div class="pcoded-wrapper">
		<div class="pcoded-content">
			<div class="pcoded-inner-content">
				<!-- [ breadcrumb ] start -->
				<div class="page-header">
					<div class="page-block">
						<div class="row align-items-center">
							<div class="col-md-12">
								<div class="page-header-title">
									<h5 class="m-b-10">Tin nhắn</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="trang-ca-nhan">Tin nhắn của tôi</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<div class="row">
								<!-- [ message ] start -->
								<div class="col-sm-12">
										<div class="card msg-card mb-0">
												<div class="card-body msg-block">
														<div class="row">
																<div class="col-lg-3 col-md-12">
																		<div class="message-mobile">
																				<div class="task-right-header-status">
																						<span class="f-w-400" data-toggle="collapse">Danh sách người dùng</span>
																						<i class="fas fa-times float-right m-t-10"></i>
																				</div>
																				<div class="taskboard-right-progress">
																						<button id="new_messenger" data-toggle="modal" data-target=".new_messenger" type="button" class="btn btn-sm btn-outline-primary"><i class="feather icon-message-square"></i>Tin nhắn mới</button>
																						<div class="h-list-header">
																								<div class="input-group">
																										<input type="text" id="msg-friends" class="form-control" placeholder="Tìm kiếm . . .">
																										<div class="input-group-append">
																												<span class="input-group-text"><i class='feather icon-search'></i></span>
																										</div>
																								</div>
																						</div>
																						<div class="h-list-body">
																								<div class="msg-user-list scroll-div">
																										<div class="main-friend-list">
																										</div>
																								</div>
																						</div>
																				</div>
																		</div>
																</div>
																<div class="col-lg-9 col-md-12">
																		<div class="ch-block">
																				<div class="h-list-body">
																						<div class="msg-user-chat scroll-div">
																								<div class="main-friend-chat">
																								</div>
																						</div>
																				</div>
																				<hr>
																				<div class="msg-form">
																						<div class="input-group mb-0">
																								<input type="text" class="form-control msg-send-chat" placeholder="Text . . .">
																								<div class="input-group-append">
																										<input onchange="upload_file_data(this)" name="file" type="file" id="imgupload" style="display:none" />
																										<button id="OpenImgUpload" class="btn btn-secondary btn-icon" type="button" data-toggle="tooltip" title="file attachment"><i class="feather icon-paperclip"></i></button>
																								</div>
																								<div class="input-group-append">
																										<button class="btn btn-theme btn-icon btn-msg-send" type="button"><i class="feather icon-play"></i></button>
																								</div>
																						</div>
																				</div>
																		</div>
																</div>
														</div>
												</div>
										</div>
								</div>
								<!-- [ message ] end -->
						</div>
						<div class="modal fade new_messenger" tabindex="-1" role="dialog" aria-labelledby="new_messenger" aria-hidden="true">
								<div class="modal-dialog modal-lg">
										<div class="modal-content">
												<div class="modal-header">
														<h5 class="modal-title h4" id="myLargeModalLabel">Tìm kiếm người dùng</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
												</div>
												<div class="modal-body">
													<div class="input-group">
															<input type="text" id="search_new_user" class="form-control" placeholder="Tìm kiếm . . .">
															<div class="input-group-append">
																	<span class="input-group-text"><i class='feather icon-search'></i></span>
															</div>
													</div>
												        <div class="card text-left">
												            <div class="card-body new_messenger_scroll">
																			<div class="row" id="list_new_users">

												            </div>
												        </div>
												    </div>
												</div>
												</div>
										</div>
								</div>
						</div>
						<!-- [ Main Content ] end -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Required Js -->
<script src="assets/js/vendor-all.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/pcoded.min.js"></script>
<!-- datatable Js -->
<script src="assets/plugins/data-tables/js/datatables.min.js"></script>
<!-- jquery-validation Js -->
<script src="assets/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<!-- notification Js -->
<script src="assets/plugins/notification/js/bootstrap-growl.min.js"></script>
<!-- sweet alert Js -->
<script src="assets/plugins/sweetalert/js/sweetalert.min.js"></script>
<!-- custom js -->
<script src="res/js/messenger.js"></script>

<script src="res/js/profiles.js"></script>
