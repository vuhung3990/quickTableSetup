<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage</title>

        <!-- bootstrap -->
        <script type="text/javascript" src="<?php echo URL::asset('assets/js/jquery-1.11.1.min.js'); ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('assets/css/bootstrap.min.css'); ?>"/>
        <script type="text/javascript" src="<?php echo URL::asset('assets/js/bootstrap.min.js'); ?>"></script>

        <!-- data table -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('assets/css/jquery-ui.min.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo URL::asset('assets/css/dataTables.jqueryui.css'); ?>"/>
        <script type="text/javascript" src="<?php echo URL::asset('assets/js/jquery.dataTables.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo URL::asset('assets/js/dataTables.jqueryui.js'); ?>"></script>

        <!-- my custom code-->
        <script type="text/javascript">
            $(function() {
                $('#table_main').dataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{URL::to('test');}}",
                    "lengthMenu": [[5, 50, 100, 200], [5, 50, 100, 200]]           // number of page
                });

                // -----------------SELECT ROW----------------------
                var table = $('#example').DataTable();
                $('#example tbody').on('click', 'tr', function() {
                    if ($(this).hasClass('selected')) {
                        $(this).removeClass('selected');
                    }
                    else {
                        table.$('tr.selected').removeClass('selected');
                        $(this).addClass('selected');
                    }
                }); // --------------END SELECT ROW-----------------

                // custom button delete of selected
                $('#button').click(function() {
                    table.row('.selected').remove().draw(false);
                });
            });
        </script>
    </head>
    <body>
        <!-- full table data -->
        <div class="table-responsive" style="margin-top: 10px; margin-left: 5px;margin-right: 5px;">
            <table id="table_main" class="display cell-border hover" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FROM</th>
                        <th>AUTHOR</th>
                        <th>TITLE</th>
                        <th>DESCRIPTION</th>
                        <th>THUMB</th>
                        <th>DURATION</th>
                        <th>LIKE</th>
                        <th>TYPE</th>
                        <th>UPLOAD_AT</th>
                        <th>CREATE_AT</th>
                    </tr>
                </thead>
            </table>
        </div>
    </body>
</html>
