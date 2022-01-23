                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



                    <div class="row">
                        <div class="col-lg">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors(); ?>
                                </div>
                            <?php endif; ?>
                            <?= $this->session->flashdata('message'); ?>

                            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#SubMenuModal">Add New SubMenu</a>

                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">title</th>
                                        <th scope="col">menu</th>
                                        <th scope="col">url</th>
                                        <th scope="col">icon</th>
                                        <th scope="col">active</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($submenu as $sm) : ?>
                                        <tr>
                                            <th scope="row"><?= $i ?></th>
                                            <td><?= $sm['title']; ?></td>
                                            <td><?= $sm['menu']; ?></td>
                                            <td><?= $sm['url']; ?></td>
                                            <td><?= $sm['icon']; ?></td>

                                            <?php if ($sm['is_active'] == 1) : ?>
                                                <td>
                                                    <p>yes</p>
                                                </td>
                                            <?php else : ?>
                                                <td>
                                                    <p>no</p>
                                                </td>
                                            <?php endif; ?>

                                            <td>
                                                <a href="" class="badge badge-sm badge-success" data-toggle="modal" data-target="#modal<?php echo $sm['id']; ?>">Edit</a>
                                                <a href="<?= base_url('menu/subMenudelete/') . $sm['id']; ?>" class="badge badge-danger" onclick="return confirm('yakin');">Delete</a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->


                <!-- modal Edit Menu -->
                <?php foreach ($submenu as $sm) : ?>
                    <div class="modal fade" id="modal<?php echo $sm['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit SubMenu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('menu/editSubMenu/') . $sm['id']; ?>" method="post">
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="menu">SubMenu title</label>
                                            <input type="text" class="form-control" id="title" name="title" value="<?php echo $sm['title']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="menu_id">Select Menu</label>
                                            <select name="menu_id" id="menu_id" class="form-control">
                                                <option value="<?= $sm['menu_id']; ?>"><?= $sm['menu']; ?></option>
                                                <?php foreach ($menu as $m) :   ?>
                                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                                <?php endforeach; ?>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="url">SubMenu Url</label>
                                            <input type="text" class="form-control" id="url" name="url" value="<?php echo $sm['url']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="icon">Submenu Icon</label>
                                            <input type="text" class="form-control" id="icon" name="icon" value="<?php echo $sm['icon']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                                <label class="form-check-label" for="is_active">
                                                    Active?
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <!-- end modal Edit Menu -->

                <!-- Modal Insert -->

                <!-- Modal -->
                <div class="modal fade" id="SubMenuModal" tabindex="-1" aria-labelledby="SubMenuModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="SubMenuModalLabel">Add New SubMenu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="" <?= base_url('menu/submenu') ?> method="POST">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu Title">
                                    </div>
                                    <div class="form-group">
                                        <select name="menu_id" id="menu_id" class="form-control">
                                            <option value="">Select Menu</option>
                                            <?php foreach ($menu as $m) :   ?>
                                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                                            <label class="form-check-label" for="is_active">
                                                Active?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>