<!DOCTYPE html>
<html lang="en">

<head>
    <title>NFC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.css" rel="stylesheet" />
    <style>
        #frm-add-user label.error{
            color:red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h4 style="text-align: center;">Pairing NFC Curl</h4>
        <div class="panel panel-primary">
            <div class="panel-heading">Pairing NFC</div>
            <div class="panel-body">
                <form class="form-horizontal" action="javascript:void(0)" id="frm-add-user">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Id:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="ran_id" placeholder="Enter Id" name="ran_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>

</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Validation library file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
<!-- Sweetalert library file -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.2/dist/sweetalert2.min.js"></script>

<script>
    $(function() {

        // Adding form validation
        $('#frm-add-user').validate();

        // Ajax form submission with image
        $('#frm-add-user').on('submit', function(e) {

            e.preventDefault();

            var formData = new FormData(this);
            func1(formData);
            // OR var formData = $(this).serialize();

            //We can add more values to form data
            //formData.append("key", "value");
        });

     

        function func1(formData) {
            $.ajax({
                url: "<?= site_url('save-user') ?>",
                type: "POST",
                cache: false,
                data: formData,
                processData: false,
                contentType: false,
                dataType: "JSON",
                success: function(data) { /* other stuff */
                    //var ya =JSON.parse(JSON.stringify(data))
                    //alert(JSON.stringify(data));
                    func2(data);
                }
            });
        }

        function func2(data) {
            var urlya = (JSON.stringify(data));
            var jsonObj = JSON.parse(urlya);
           $.ajax({
                url: jsonObj['url1'],
                type: "GET",
                cache: false,
                processData: false,
                contentType: false,
                success: function(data) { /* other stuff */
                    //var ya =JSON.parse(JSON.stringify(data))
                    //alert(JSON.stringify(data));
                    func3(data,jsonObj['ran_id']);
                }
            });
        }

        function func3(dataya,ran_id) {
            $.ajax({
                url: "<?= site_url('save-user3') ?>",
                type: "POST",
                data: { username: dataya,id: ran_id },
                success: function(response) { /* other stuff */
                    //var ya =JSON.parse(JSON.stringify(data))
                    //alert(JSON.stringify(data));
                    var urlya = (JSON.stringify(response));
                    var jsonObj = JSON.parse(urlya);
                    //console.log(jsonObj['a'] + " | " + jsonObj['rida']);
                    func4(response);
                }
            });
        }

        function func4(datt){
            var urlya = (JSON.stringify(datt));
                    var jsonObj = JSON.parse(urlya);
                    $.ajax({
                        url: jsonObj['url2']+jsonObj['rida'],
                type: "POST",
                cache: false,
                processData: false,
                contentType: false,
                
                success: function(responseD) { /* other stuff */
                    //var ya =JSON.parse(JSON.stringify(data))
                    //alert(JSON.stringify(data));
                    console.log(responseD);
                }
            });
        }

        // AJAX LOCAL

        
    });
</script>