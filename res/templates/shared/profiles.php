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
									<h5 class="m-b-10">Thông tin cá nhân</h5>
								</div>
								<ul class="breadcrumb">
									<li class="breadcrumb-item"><a href="/"><i class="feather icon-home"></i></a></li>
									<li class="breadcrumb-item"><a href="trang-ca-nhan">thông tin cá nhân</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!-- [ breadcrumb ] end -->
				<div class="main-body">
					<div class="page-wrapper">
						<!-- [ Main Content ] start -->
						<div class="card">
						    <div class="card-header">
						        <h5>Thông tin của bạn</h5>
						    </div>
						    <div class="card-body">
						        <div class="row">
											<div class="col-sm-6 col-md-3 col-xl-3">
												<img class="shadow-sm bg-light d-inline-block mr-2 border border-secondary rounded" src="upload/avatar/<?=$profile->avatar?>" alt="Avatar" width="200px" height="200px" id="profiles-avatar">
												<div class="input-group mt-3">
				                    <div class="input-group-prepend">
				                    </div>
				                    <div class="custom-file">
				                        <input type="file" id="file" onchange="update_avatar(this)" class="custom-file-input" id="inputGroupFile01">
				                        <label class="custom-file-label" for="inputGroupFile01">Thay ảnh</label>
				                    </div>
				                </div>
											</div>
						            <div class="col-md-4">
						                <form>
																<div class="form-group">
																		<label>Họ Tên</label>
																		<input name="name" type="text" class="form-control" value="<?=$profile->name?>" required>
																</div>
																<div class="form-group">
																		<label>Tài khoản</label>
																		<input name="username" type="text" class="form-control" value="<?=$profile->username?>" readonly>
																</div>
						                    <div class="form-group">
						                        <label for="Password">Mật khẩu</label>
						                        <input name="password" type="password" class="form-control" id="Password" placeholder="Mật khẩu" required>
						                    </div>
						                    <button id="upload_profiles" type="submit" class="btn btn-primary">Cập nhật</button>
						                </form>
						            </div>
						            <div class="col-md-4">
						                <form>
																<div class="form-group">
																		<label for="Email">Địa chỉ Email</label>
																		<input name="email" type="email" class="form-control" id="Email" value="<?=$profile->email?>" required>
																</div>
						                    <div class="form-group">
																		<label for="exampleInputEmail1">Ngày sinh</label>
											              <input name="birthday" type="date" class="form-control" value="<?=$profile->birthday?>" required>
						                    </div>
																<div class="form-group">
																	<label for="gioi-tinh">Giới tính</label>
																	<select name="gender" id="gioi-tinh" class="form-control" >
																		<?php
																		if($profile->gender_id == 1)
																			echo '<option value="1" selected>Không Xác Định</option>';
																		else
																			echo '<option value="1">Không Xác Định</option>';
																		if($profile->gender_id == 2)
																			echo '<option value="2" selected>Nam</option>';
																		else
																			echo '<option value="2">Nam</option>';
																		if($profile->gender_id == 3)
																			echo '<option value="3" selected>Nữ</option>';
																		else
																			echo '<option value="3">Nữ</option>';
																		?>
																	</select>
																</div>
						                </form>
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
<script src="res/js/profiles.js"></script>
