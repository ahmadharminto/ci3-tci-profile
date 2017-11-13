<!-- Page header -->
<div class="page-header page-header-default">
<div class="page-header-content">
    <div class="page-title">
        <h4><span class="text-semibold">Users</span></h4>
    </div>
</div>

<div class="breadcrumb-line">
    <ul class="breadcrumb">
        <li><i class="icon-cogs position-left"></i> Config</li>
        <li class="active">Users</li>
    </ul>
    <ul class="breadcrumb-elements">
        <li><a href="<?=$url_add;?>"><i class="icon-user-plus position-left"></i> Add</a></li>
    </ul>
</div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">List Users</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <?=form_open($url_home, ['method' => 'get']);?>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search..." value="<?=$data_filter['keyword'];?>">
                            <div class="form-control-feedback"><i class="icon-search4 text-size-base"></i></div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            <?=form_close();?>

            <div class="table-responsive">
                <?=$this->session->flashdata('message');?>
                <table class="table" id="ut-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Is Active</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th class="text-right">#</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /content area -->