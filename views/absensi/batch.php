<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>webrocom php training in mumbai</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/css/material-fullpalette.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Webrocom php training | <small>Codeigniter batch insert tutorial</small></h2>
            <p><a class="btn btn-primary btn-lg" href="http://webrocom.net/">Learn more</a> Author: <a href="https://www.facebook.com/webrocom.learn?ref=tn_tnmn">webrocom admin</a></p>
        </div>
        <div class="row jumbotron">
            <form method="POST" action="" id="frm_submit">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Journey Details</legend>
                        <!-- Text input-->
                        <table style="width: 100%" class="table">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Passenger</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Ticket No.</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="table-details">
                                <tr id="row1" class="jdr1">
                                    <td><span class="btn btn-sm btn-default">1</span><input type="hidden" value="6437" name="count[]"></td>
                                    <td><input type="text" required="" class="form-control input-sm datepicker" placeholder="Date" name="jdate[]"></td>
                                    <td><input type="text" required="" class="form-control input-sm" placeholder="Travel by" name="jtype[]"></td>
                                    <td><input type="text" required="" data-parsley-type="number" class="form-control input-sm" placeholder="Paasenger count" name="jpassanger[]"></td>
                                    <td><input type="text" required="" class="form-control input-sm" placeholder="Depart from" name="jfrom[]"></td>
                                    <td><input type="text" required="" class="form-control input-sm" placeholder="Destination" name="jto[]"></td>
                                    <td><input type="text" required="" class="form-control input-sm" placeholder="Ticket No." name="jticket_no[]"></td>
                                    <td><input type="text" required="" data-parsley-type="digits" class="form-control input-sm" placeholder="Amount" name="jamount[]"></td>
                                </tr>
                            </tbody>
                        </table>
                        <button class="btn btn-primary btn-sm btn-add-more">Add More</button>
                        <button class="btn btn-sm btn-warning btn-remove-detail-row"><i class="glyphicon glyphicon-remove"></i></button>
                    </fieldset>
                </div>
                <div class="col-md-12">
                    <hr>
                    <input class="btn btn-success pull-right" type="submit" value="submit" name="submit">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="alert alert-dismissable alert-success" style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Data inserted successfully</strong>.
            </div>
            <div class="alert alert-dismissable alert-danger" style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>Sorry something went wrong</strong>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.3.0/js/material.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $("body").on('click', '.btn-add-more', function(e) {
                e.preventDefault();
                var $sr = ($(".jdr1").length + 1);
                var rowid = Math.random();
                var $html = '<tr class="jdr1" id="' + rowid + '">' +
                    '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="' + Math.floor((Math.random() * 10000) + 1) + '"></td>' +
                    '<td><input type="text" name="jdate[]" placeholder="Date" class="form-control input-sm datepicker"></td>' +
                    '<td><input type="text" name="jtype[]" placeholder="Travel by" class="form-control input-sm"></td>' +
                    '<td><input type="text" name="jpassanger[]" placeholder="Paasenger count" class="form-control input-sm"></td>' +
                    '<td><input type="text" name="jfrom[]" placeholder="Depart from" class="form-control input-sm"></td>' +
                    '<td><input type="text" name="jto[]" placeholder="Destination" class="form-control input-sm"></td>' +
                    '<td><input type="text" name="jticket_no[]" placeholder="Ticket No." class="form-control input-sm"></td>' +
                    '<td><input type="text" name="jamount[]" placeholder="Amount" class="form-control input-sm"></td>' +
                    '</tr>';
                $("#table-details").append($html);
            });
            $("body").on('click', '.btn-remove-detail-row', function(e) {
                e.preventDefault();
                if ($("#table-details tr:last-child").attr('id') != 'row1') {
                    $("#table-details tr:last-child").remove();
                }
            });
            $("body").on('focus', ' .datepicker', function() {
                $(this).datepicker({
                    dateFormat: "yy-mm-dd"
                });
            });
            $("#frm_submit").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?php echo base_url() ?>welcome/batchInsert',
                    type: 'POST',
                    data: $("#frm_submit").serialize()
                }).always(function(response) {
                    var r = (response.trim());
                    if (r == 1) {
                        $(".alert-success").show();
                    } else {
                        $(".alert-danger").show();
                    }
                });
            });
        });
    </script>
</body>

</html>