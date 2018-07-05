<?php
if (isset($_GET['hapus'])) {
    $queryHapus = mysqli_query($mysqli,"DELETE FROM category where category_id = '" . $_GET['hapus'] . "'");
    if ($queryHapus) {
        echo "<script> alert('Data Berhasil Dihapus'); location.href='index.php?hal=master/category/list' </script>";
        exit;
    }
}
?>
<div class="wrapper">
    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <header class="panel-heading">
                    Data KAtegori
                    <span class="tools pull-right">
                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                        <a href="javascript:;" class="fa fa-times"></a>
                    </span>
                </header>
                <div class="panel-body">
                    <div class="adv-table editable-table ">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="?hal=master/category/add">
                                    <button data-toggle="modal" class="btn btn-primary">
                                        Add New <i class="fa fa-plus"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="btn-group pull-right">
                            </div>
                        </div>
                        <div class="space15"></div>
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                            <thead>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 0;
                                $queryCategory = mysqli_query($mysqli,"SELECT * FROM category ORDER BY category_id DESC");
                                while ($rowCategory = mysqli_fetch_array($queryCategory)) {
                                    ?>
                                    <tr class="">

                                        <td><?php echo $rowCategory['category_name']; ?></td>
                                        <td><?php if ($rowCategory['category_status'] == 'Y') { ?>
                                            <button class="btn btn-success" type="submit"><i
                                                class="fa fa-check-square-o"></i> Active
                                            </button>

                                            <?php } else { ?>
                                            <button class="btn btn-danger" type="submit"><i class="fa fa-ban"></i> Not
                                                Active
                                            </button>

                                            <?php } ?></td>
                                            <td>
                                                <a href="?hal=master/category/edit&id=<?php echo $rowCategory['category_id']; ?>">
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-edit"></i>
                                                        Edit
                                                    </button>
                                                </a>
                                                <a href="?hal=master/category/list&hapus=<?php echo $rowCategory['category_id']; ?>">
                                                    <button class="btn btn-danger" type="submit" name="hapus"><i
                                                        class="fa fa-trash-o"></i> Delete
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>