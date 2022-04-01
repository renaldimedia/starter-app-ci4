<?= $this->extend('App\Views\admin-module\skeleton') ?>

<?= $this->section('content') ?>
<header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-database"></i>
                        <?= isset($title) ? $title : 'Users' ?>
                    </h4>
                </div>
            </div>
            <div class="row justify-content-between">
                <ul class="nav nav-material nav-material-white responsive-tab" id="v-pills-tab" role="tablist">
                    <li>
                        <a class="nav-link"  href="panel-page-users.html"><i class="icon icon-home2"></i>All Users</a>
                    </li>
                    <li>
                        <a class="nav-link <?= isset($data_id) ? '' : 'active' ?>"  href="panel-page-users-create.html" ><i class="icon icon-plus-circle"></i> Add New User</a>
                    </li>
                    <?php if(isset($data_id)){ ?>
                        <li>
                        <a class="nav-link active"  href="panel-page-users-create.html" ><?= isset($subtitle) ? $subtitle : "Update User Data" ?></a>
                    </li>
                        <?php } ?>
                </ul>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce">
        <div class="animated fadeInUpShort">
            <div class="row my-3">
                <div class="col-md-12">
                    <!-- <form action="" id="userform" method="post"> -->
                        <div class="card no-b  no-r">
                            <div class="card-body">
                                <h5 class="card-title"><?= isset($subtitle) ? $subtitle : "Tambah Data User" ?></h5>
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <div class="form-group m-0 has-validation">
                                            <label for="name" class="col-form-label s-12">NAMA*</label>
                                            <input id="name" placeholder="Enter User Name" name="name" class="form-control r-0 light s-12 " required type="text" value="<?= isset($data) && isset($data['name']) ? $data['name'] : ""  ?>">
                                        </div>

                                        <!-- <div class="form-row">
                                            <div class="form-group col-6 m-0">
                                                <label for="cnic" class="col-form-label s-12"><i class="icon-fingerprint"></i>CNIC / FORM B</label>
                                                <input id="cnic" placeholder="Enter Form B or CNIC Number" class="form-control r-0 light s-12 date-picker" type="text">
                                            </div>
                                            <div class="form-group col-6 m-0">
                                                <label for="dob" class="col-form-label s-12"><i class="icon-calendar mr-2"></i>DATE OF BIRTH</label>
                                                <input id="dob" placeholder="Select Date of Birth" class="form-control r-0 light s-12" type="text">
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group m-0">
                                            <label for="dob" class="col-form-label s-12">GENDER</label>
                                            <br>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="male" name="gender" class="custom-control-input">
                                                <label class="custom-control-label m-0" for="male">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="female" name="gender" class="custom-control-input">
                                                <label class="custom-control-label m-0" for="female">Female</label>
                                            </div>
                                        </div> -->
                                    </div>
                                    <!-- <div class="col-md-3 offset-md-1">
                                        <input hidden id="file" name="file"/>
                                        <div class="dropzone dropzone-file-area pt-4 pb-4" id="fileUpload">
                                            <div class="dz-default dz-message">
                                                <span>Drop A passport size image of user</span>
                                                <div>You can also click to open file browser</div>
                                            </div>
                                        </div>
                                    </div> -->

                                </div>

                                <div class="form-row mt-1">
                                    <div class="form-group col-6 m-0 has-validation" >
                                        <label for="email" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>EMAIL*</label>
                                        <input value="<?= isset($data) && isset($data['email']) ? $data['email'] : ""  ?>" id="email" required placeholder="user@email.com" class="form-control r-0 light s-12 " type="text" name="email" >
                                    </div>

                                    <!-- <div class="form-group col-4 m-0">
                                        <label for="phone" class="col-form-label s-12"><i class="icon-phone mr-2"></i>Phone</label>
                                        <input id="phone" placeholder="05112345678" class="form-control r-0 light s-12 " type="text">
                                    </div> -->
                                    <div class="form-group col-6 m-0 has-validation">
                                        <label for="mobile" class="col-form-label s-12"><i class="icon-mobile-phone mr-2"></i>MOBILE</label>
                                        <input value="<?= isset($data) && isset($data['phone']) ? $data['phone'] : ""  ?>" id="mobile" name="mobile" placeholder="eg: 3334709643" class="form-control r-0 light s-12 " type="text" >
                                    </div>

                                </div>
                                <div class="form-row mt-1">
                                    <div class="form-group col-6 m-0 has-validation">
                                        <label for="role" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>PRIMARY ROLE*</label>
                                        <select required name="role" id="role" class="form-control r-0 light s-12 ">
                                            <option value="">Pilih Role</option>
                                            <!-- <option value="9999" selected>asdasd</option> -->
                                            <?php if(isset($groups)){
                                                foreach($groups as $group){
                                             ?>
                                             <option value="<?= $group->id ?>" <?php if(isset($data) && isset($data['default_group']) && $data['default_group'] == $group->id){echo "selected='selected'";} ?>><?= $group->display_name ?></option>

                                             <?php }} ?>
                                        </select>
                                    </div>
                                    <div required class="form-group col-6 m-0 has-validation">
                                        <label for="username" class="col-form-label s-12"><i class="icon-envelope-o mr-2"></i>LOGIN DENGAN*</label>
                                        <select name="username" id="username" class="form-control r-0 light s-12 ">
                                        <option value="email" <?php if(isset($data) && isset($data['username']) && $data['username'] == "email"){echo "selected='selected'";} ?>>Email</option>    
                                        <option value="phone" <?php if(isset($data) && isset($data['username']) && $data['username'] == "phone"){echo "selected='selected'";} ?>>No HP</option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <!-- <div class="form-row">
                                    <div class="form-group col-9 m-0">
                                        <label for="address"  class="col-form-label s-12">Address</label>
                                        <input type="text" class="form-control r-0 light s-12" id="address"
                                               placeholder="Enter Address">
                                    </div>

                                    <div class="form-group col-3 m-0">
                                        <label for="inputCity" class="col-form-label s-12">City</label>
                                        <input type="text" class="form-control r-0 light s-12" id="inputCity">
                                    </div>
                                </div> -->
                            </div>
                            <!-- <hr> -->
                            <!-- <div class="card-body">
                                <h5 class="card-title">ENROLLMENT</h5>
                                <div class="form-row">
                                    <div class="form-group col-5 m-0">
                                        <label for="roll1" class="col-form-label s-12"># ID NUMBER</label>
                                        <input id="roll1" placeholder="Enter ID Number" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                    <div class="form-group col m-0">
                                        <label for="roll2" class="col-form-label s-12">CLASS</label>
                                        <input id="roll2" placeholder="Select Class" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                    <div class="form-group col m-0">
                                        <label for="roll4" class="col-form-label s-12">SECTION</label>
                                        <input id="roll4" placeholder="Select Class" class="form-control r-0 light s-12 " type="text">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-4 m-0">
                                        <label for="joining" class="col-form-label s-12"><i class="icon-calendar mr-2"></i>DATE OF JOINING</label>
                                        <input id="joining" placeholder="user@email.com" class="form-control r-0 light s-12 datePicker" data-time-picker="false"
                                               data-format-date='Y/m/d' type="text">
                                    </div>
                                </div>
                            </div> -->
                            <!-- <hr> -->
                            <!-- <div class="card-body">
                                <h5 class="card-title">PARENT / GUARDIAN</h5>
                                <div class="form-row">
                                    <div class="form-group col-5 m-0">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Select A parent</label>
                                        <select class="custom-select my-1 mr-sm-2 form-control r-0 light s-12" id="inlineFormCustomSelectPref">
                                            <option selected>Choose...</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary bg-primary btn-sm mt-2">Add New Guardian</a>
                            </div> -->
                            <!-- <hr> -->
                            <div class="card-body">
                                <button onclick="save()" class="btn btn-primary btn-lg"><i class="icon-save mr-2"></i><?= isset($buttons) && isset($buttons['submit_text']) ? $buttons['submit_text'] : "Simpan Datas" ?></button>
                                <!-- <div > -->
                                                    <span class="border border-danger d-none" id="errorcontainer">asdasd</span>
                                <!-- </div> -->
                                <!-- <input type="submit" value=""> -->
                            </div>
                        </div>
                    <!-- </form> -->
                </div>
            </div>
    </div>
    </div>
    <?= $this->endSection() ?>

    <?= $this->section('footer') ?>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> -->

<script>
    // set
    // flatpickr("#dob", {
    //     altFormat: "d-m-Y",
    //     altInput: true,
    //     dateFormat:  "Y-m-d"
    // });
    // $("#dob").flatpickr();
    function save() {
        let urls = "<?= $submit_url ?>";
        $.post(urls, {
                name: $('#name').val(),
                role: $('#role').val(),
                email: $('#email').val(),
                mobile: $('#mobile').val(),
                username: $('#username').val()
            }).done(function(res){
                // console.log(res);
                
                if(res.error == 1){
                    toastr.error(res.message)
                }else if(res.error == 0){
                    toastr.success(res.message);
                    $('#loader').removeClass('loader-fade');
                    setTimeout(() => {
                        window.location.replace = `${res.redirect}`;
                    }, 1500);
                }
            }).fail(function(e){
                console.log(e);
                if(e.responseJSON.error == 400){
                    let errorlist = JSON.parse(e.responseJSON.messages.error);
                    let msgs = ``;
                    for (const [key, value] of Object.entries(errorlist)) {
                        msgs += `<p style="color:red;">${value}</p>`
                    }
                    // console.log(errorlist)
                    $('#errorcontainer').removeClass('d-none');
                    document.querySelector('#errorcontainer').innerHTML = msgs;
                }
            });
        // $.ajax({
        //     type: "POST",
        //     url: url,
        //     data: ,
        //     success: function(res){
        //         toastr('Success');
        //     }
        //     dataType: dataType
        // });
    }

</script>
<?= $this->endSection() ?>