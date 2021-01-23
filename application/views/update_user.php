<section class="parallax">
    <div class="container container-fullscreen">
        <div class="text-middle">
            <div class="row">
                <form id="frm_reg" name="frm_reg" method="post" action="<?= base_url() ?>register/update_user" enctype="multipart/form-data">
                    <div class="col-md-12 background-white" style="border-radius: 10px; padding: 0px 60px 20px 60px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-1 form-group">
                                    <?php
                                    if ($myprofile->profile && $myprofile->profile != '')
                                    {
                                    ?>
                                        <img src="<?= base_url() ?>uploads/customer_profile/<?=$myprofile->profile?>" width="100%">
                                    <?php
                                    }else{
                                    ?>
                                        <img src="<?= base_url() ?>assets/images/Avatar.png" width="100%">
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3 form-group" style="margin-top: 15px;">
                                    <label><?= (isset($myprofile)) ? $myprofile->first_name : ''; ?> <?= (isset($myprofile)) ? $myprofile->last_name : ''; ?> </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12  m-t-20">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Profile Picture</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <input type="file" id="profile" name="profile" class="form-control" accept=".jpg,.jpeg,.png">
                                    <small class="form-text text-muted">Add a photo to personalize your account</small>
                                    <span id="errorprofile" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Profile</h5>
                            <small>Please fill in your registrant details:</small>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-2 form-group">
                                    <input type="text" name="first_name" id="first_name"  value="<?= (isset($myprofile)) ? $myprofile->first_name : ''; ?>" placeholder="First Name" class="form-control input-lg">
                                    <span id="errorfirst_name" style="color:red"></span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <input type="text" name="last_name" id="last_name" value="<?= (isset($myprofile)) ? $myprofile->last_name : ''; ?>" placeholder="Last Name" class="form-control input-lg">
                                    <span id="errorlast_name" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="email" name="email" id="email" value="<?= (isset($myprofile)) ? $myprofile->email : ''; ?>" readonly placeholder="Email" class="form-control input-lg">
                                    <span id="erroremail" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" name="title" id="title" value="<?= (isset($myprofile)) ? $myprofile->title : ''; ?>" placeholder="Title" class="form-control input-lg">
                                    <span id="errorspecialty" style="color:red"></span>
                                </div>
                                <div class="col-md-2 form-group">
                                    <select class="form-control input-lg" id="job_type" name="job_type">
                                        <option value="Accounting & Finance" <?=($myprofile->job_type && $myprofile->job_type == 'Accounting & Finance')?'selected':''?>>Accounting & Finance</option>
                                        <option value="Corp Dev & Strategy" <?=($myprofile->job_type && $myprofile->job_type == 'Corp Dev & Strategy')?'selected':''?>>Corp Dev & Strategy</option>
                                        <option value="Engineering" <?=($myprofile->job_type && $myprofile->job_type == 'Engineering')?'selected':''?>>Engineering</option>
                                        <option value="Executive Staff" <?=($myprofile->job_type && $myprofile->job_type == 'Executive Staff & Finance')?'selected':''?>>Executive Staff</option>
                                        <option value="HR & Learning" <?=($myprofile->job_type && $myprofile->job_type == 'HR & Learning')?'selected':''?>>HR & Learning</option>
                                        <option value="Marketing" <?=($myprofile->job_type && $myprofile->job_type == 'Marketing')?'selected':''?>>Marketing</option>
                                        <option value="Operations & IT" <?=($myprofile->job_type && $myprofile->job_type == 'Operations & IT')?'selected':''?>>Operations & IT</option>
                                        <option value="Product Management" <?=($myprofile->job_type && $myprofile->job_type == 'Product Management')?'selected':''?>>Product Management</option>
                                        <option value="Sales" <?=($myprofile->job_type && $myprofile->job_type == 'Sales')?'selected':''?>>Sales</option>
                                        <option value="Sales Engineering" <?=($myprofile->job_type && $myprofile->job_type == 'Sales Engineering')?'selected':''?>>Sales Engineering</option>
                                        <option value="SDR" <?=($myprofile->job_type && $myprofile->job_type == 'SDR')?'selected':''?>>SDR</option>
                                        <option value="Support" <?=($myprofile->job_type && $myprofile->job_type == 'Support')?'selected':''?>>Support</option>

                                        <optgroup label="___">
                                            <option value="Other" <?=($myprofile->job_type && $myprofile->job_type == 'Other')?'selected':''?>>Other</option>
                                        </optgroup>
                                    </select>
                                    <span id="errordegree" style="color:red"></span>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 m-t-20">
<!--                            <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Address</h5>-->
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <select id="region" name="region" class="form-control">
                                        <option value="Americas" <?=($myprofile->region && $myprofile->region == 'Americas')?'selected':''?>>Americas</option>
                                        <option value="APJ" <?=($myprofile->region && $myprofile->region == 'APJ')?'selected':''?>>APJ</option>
                                        <option value="EMEA" <?=($myprofile->region && $myprofile->region == 'EMEA')?'selected':''?>>EMEA</option>
                                        <option value="Global" <?=($myprofile->region && $myprofile->region == 'Global')?'selected':''?>>Global</option>
                                        <option value="Other" <?=($myprofile->region && $myprofile->region == 'Other' || $myprofile->region == null)?'selected':''?>>Other</option>
                                    </select>
                                    <span id="errorcountry" style="color:red"></span>
                                </div>
                                <div class="col-md-3 form-group">
                                    <input type="text" value="<?= (isset($myprofile)) ? $myprofile->phone : ''; ?>" placeholder="Cell Phone" name="cell_phone" id="cell_phone" class="form-control input-lg">
                                    <span id="errorcell_phone" style="color:red"></span>
                                </div>
                            </div>
                        </div>
                        <!--                        <div class="col-md-12  m-t-20">
                                                    <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Upload vCard</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group col-md-3">
                                                            <input type="file" id="upload_vcard" name="upload_vcard" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12  m-t-20">
                                                    <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Social Accounts</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="col-md-4 form-group">
                                                            <div class="col-md-1">
                                                                <i class="fa fa-twitter" style="font-size: 25px; margin-top: 8px;"></i>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <input type="text" value="<?= (isset($myprofile)) ? $myprofile->twitter_id : ''; ?>" placeholder="Twitter" id="twitter" name="twitter" class="form-control input-lg">
                                                                <span id="errortwitter" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4 form-group">
                                                            <div class="col-md-1">
                                                                <i class="fa fa-facebook" style="font-size: 25px; margin-top: 8px;"></i>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <input type="text" value="<?= (isset($myprofile)) ? $myprofile->facebook_id : ''; ?>" placeholder="Facebook" id="facebook" name="facebook" class="form-control input-lg">
                                                                <span id="errorfacebook" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="col-md-4 form-group">
                                                            <div class="col-md-1">
                                                                <i class="fa fa-instagram" style="font-size: 25px; margin-top: 8px;"></i>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <input type="text" value="<?= (isset($myprofile)) ? $myprofile->instagram_id : ''; ?>" placeholder="Instagram" id="instagram" name="instagram" class="form-control input-lg">
                                                                <span id="errorinstagram" style="color:red"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12  m-t-20">
                                                    <h5 style="padding-bottom: 4px; border-bottom: 2px solid #ebebeb">Membership Details</h5>
                                                </div>
                                                <div class="row">
                                                   <div class="col-md-12">
                                                        <div class="form-group col-md-12">
                                                            <label class="custom-control custom-checkbox m-0">
                                                                <input type="checkbox" name="terms" id="terms" class="custom-control-input">
                                                                <span class="form-text text-muted">I am currently a member of this organization</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 m-t-20">
                                                        <div class="form-group col-md-12">
                                                            <small class="form-text text-muted"><?php
                        if (!empty($cms_details)) {
                            echo $cms_details->description;
                        }
                        ?></small>
                                                        </div>
                                                    </div>
                                                </div>-->
                        <input type="hidden" name="cust_id" id="cust_id"  value="<?= (isset($myprofile)) ? $myprofile->cust_id : ''; ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-12 form-group">
                                    <button class="btn btn-primary" id="update_user" type="submit">Submit</button>
                                    <button type="button" class="btn btn-danger m-l-10">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function () {

//        $('#terms').click(function () {
//            if ($(this).is(':checked')) {
//                $('#update_user').removeAttr('disabled');
//            } else {
//                $('#update_user').attr('disabled', 'disabled');
//            }
//        });

        $("#update_user").on("click", function () {
            if ($("#first_name").val().trim() == "")
            {
                $("#errorfirst_name").text("Enter First Name").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#last_name").val().trim() == "") {
                $("#errorlast_name").text("Enter Last Name").fadeIn('slow').fadeOut(5000);
                return false;
            } else if ($("#email").val().trim() == "") {
                $("#erroremail").text("Enter Email").fadeIn('slow').fadeOut(5000);
                return false;
            } else {
                return true; //submit form
            }
            return false; //Prevent form to submitting
        });


        if(getParameters().status == 'success')
        {
            Swal.fire(
                'Done!',
                'Profile has been updated!',
                'success'
            )
        }
    });
</script>
