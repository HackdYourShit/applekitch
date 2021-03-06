<div class="profile-sidebar">
	<div class="profile-img">
		<?php if(!empty($user_data['profile_img']) && $user_data['profile_img']!==''){ ?>
            <img src="<?php echo $user_data['profile_img']; ?>" alt="" class="admin_edit_img_preview">
		<?php } else { ?>
		<img src="<?php echo base_url('/assets/images/noimg.png'); ?>">
        <?php } ?>
	</div>
	<div class="profile-display-name"><?php echo $user_data['fname']; ?> <?php echo $user_data['lname'] ?></div>
</div>
<div class="logged-in-usermenus">
	<ul>
        <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-tachometer" aria-hidden="true"></i>
                Dashboard</a></li>
		<li><a href="<?php echo base_url('manage-profile'); ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Manage Profile</a></li>
		<?php if($user_data['role'] != 3) { ?>
		<li><a href="<?php echo base_url('membership-plan'); ?>"><i class="fa fa-bookmark fa-fw" aria-hidden="true"></i> Membership Plans</a></li>
		<li><a href="<?php echo base_url('children'); ?>"><i class="fa fa-child" aria-hidden="true"></i> Children</a></li>
        <?php } ?>
        <?php if(isUserType('Parent')==true || isUserType('Teacher')==true || isUserType('School')==true){ ?>
            <li><a href="<?php echo base_url('childcertificate'); ?>"><i class="fa fa-certificate fa-fw" aria-hidden="true"></i> Certificates center</a></li>
        <?php } elseif (isUserType('Student')) { ?>
            <li><a href="<?php echo base_url('certificates'); ?>"><i class="fa fa-certificate fa-fw" aria-hidden="true"></i> Certificates center</a></li>
        <?php } ?>

		<?php if(isUserType('Parent')==true || isUserType('Teacher')==true || isUserType('School')==true){ ?>
            <li><a href="<?php echo base_url('childaward'); ?>"><i class="fa fa-trophy fa-fw" aria-hidden="true"></i> Awards</a></li>
		<?php } elseif (isUserType('Student')) { ?>
            <li><a href="<?php echo base_url('awards'); ?>"><i class="fa fa-trophy fa-fw" aria-hidden="true"></i> Awards</a></li>
		<?php } ?>

            <li class="dropdown"><a href=""><i class="fa fa-pie-chart" aria-hidden="true"></i> Analytics &nbsp;<i class="fa fa-caret-down"></i></a>
                <ul class="dropdown_list">
                    <li><a href="<?php echo base_url('dashboard/usage'); ?>">Usage</a></li>
                    <li><a href="<?php echo base_url('dashboard/troublespot'); ?>">Trouble Spots</a></li>
                    <li><a href="<?php echo base_url('dashboard/scorechart'); ?>">Score</a></li>
                    <li><a href="<?php echo base_url('dashboard/questionlog'); ?>">Questions</a></li>
                    <li><a href="<?php echo base_url('dashboard/progress'); ?>">Progress</a></li>
                </ul>
            </li>
        <?php if (isUserType('Student')) { ?>
            <li><a href="<?php echo base_url('share'); ?>"><i class="fa fa-share-alt"></i>  Share with friends</a></li>
        <?php } ?>
        <li><a href="<?php echo base_url('favourite-worksheet'); ?>"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Favourite Worksheet</a></li>
		<li><a href="<?php echo base_url('/login/user_logout'); ?>"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
	</ul>
</div>
<script>
    jQuery('.logged-in-usermenus ul > li.dropdown > a').on('click', function (e) {
        e.preventDefault();
        var this_element = jQuery(this);
        this_element.parent().find('ul').slideToggle();
    });
</script>