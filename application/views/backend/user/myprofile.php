<!-- Page header -->
<div class="page-header page-header-default">
<div class="page-header-content">
    <div class="page-title">
        <h4><span class="text-semibold">Edit User</span></h4>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li>Main</li>
        <li class="active">My Profile</li>
    </ul>
</div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">My Profile</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <?php if (validation_errors()) : ?>
                <div class="alert flash-alert alert-warning">
                    <?=validation_errors();?>
                </div>
            <?php endif; ?>
            <?=$this->session->flashdata('message');?>
            <?=form_open($url_post, ['method' => 'post']);?>
                <input type="hidden" name="id" value="<?=$row->id;?>">
                <input type="hidden" name="is_active" value="<?=$row->is_active;?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" value="<?=set_value('email', $row->email);?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" value="<?=set_value('username', $row->username);?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?=form_close();?>
        </div>
    </div>

</div>
<!-- /content area -->