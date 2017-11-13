<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><span class="text-semibold">Home Section</span></h4>
        </div>
    </div>

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li class="active"><i class="icon-home2 position-left"></i> Home Section</li>
        </ul>
    </div>
</div>
<!-- /page header -->

<!-- Content area -->
<div class="content">
    <!-- Simple panel -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Simple panel</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div id="upload_error" style="margin-top:10px;display:none"></div>
            <input type="file" name="image" class="file-input">
        </div>
    </div>
    <!-- /simple panel -->


    <!-- Table -->
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">Basic table</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            Starter pages include the most basic components that may help you start your development process - basic grid example, panel, table and form layouts with standard components. Nothing extra.
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Eugene</td>
                        <td>Kopyov</td>
                        <td>@Kopyov</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Victoria</td>
                        <td>Baker</td>
                        <td>@Vicky</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>James</td>
                        <td>Alexander</td>
                        <td>@Alex</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Franklin</td>
                        <td>Morrison</td>
                        <td>@Frank</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /table -->


    <!-- Grid -->
    <div class="row">
        <div class="col-md-6">

            <!-- Horizontal form -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Horizontal form</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" action="#">
                        <div class="form-group">
                            <label class="control-label col-lg-2">Text input</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Password</label>
                            <div class="col-lg-10">
                                <input type="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Select</label>
                            <div class="col-lg-10">
                                <select name="select" class="form-control">
                                    <option value="opt1">Basic select</option>
                                    <option value="opt2">Option 2</option>
                                    <option value="opt3">Option 3</option>
                                    <option value="opt4">Option 4</option>
                                    <option value="opt5">Option 5</option>
                                    <option value="opt6">Option 6</option>
                                    <option value="opt7">Option 7</option>
                                    <option value="opt8">Option 8</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Textarea</label>
                            <div class="col-lg-10">
                                <textarea rows="5" cols="5" class="form-control" placeholder="Default textarea"></textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /horizotal form -->

        </div>

        <div class="col-md-6">

            <!-- Vertical form -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Vertical form</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    <form action="#">
                        <div class="form-group">
                            <label>Text input</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Select</label>
                            <select name="select" class="form-control">
                                <option value="opt1">Basic select</option>
                                <option value="opt2">Option 2</option>
                                <option value="opt3">Option 3</option>
                                <option value="opt4">Option 4</option>
                                <option value="opt5">Option 5</option>
                                <option value="opt6">Option 6</option>
                                <option value="opt7">Option 7</option>
                                <option value="opt8">Option 8</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Textarea</label>
                            <textarea rows="4" cols="4" class="form-control" placeholder="Default textarea"></textarea>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Submit form <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /vertical form -->

        </div>
    </div>
    <!-- /grid -->

</div>
<!-- /content area -->