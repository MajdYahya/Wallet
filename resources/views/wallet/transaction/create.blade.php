@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <form id="paramsForm" name="paramsForm" action="">
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="Amount in JOD" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control type" id="type" name="type" required>
                                    <option selected disabled>Expanse or Income?</option>
                                    <option value="expanse">Expanse</option>
                                    <option value="income">Income</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control category" id="categories" name="categories" required>

                                </select>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary" id="save-btn">
                                    Save
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="application/javascript">
        var SITEURL = '{{ env('APP_URL') }}';

        $(document).ready(function() {

            var incomeCategories = @json($incomeCategories);
            var expanseCategories = @json($expanseCategories);
            // import Swal from 'sweetalert2';


            $('.type').on('change', function() {
                //  alert( this.value );
                var categories;
                if (this.value == "expanse") {
                    categories = expanseCategories;
                } else if (this.value == "income") {
                    categories = incomeCategories;
                }
                // categories.forEach(addCategoriesOptions);
                len = categories.length;
                var options = "";
                for (var i = 0; i < len; i++) {
                    options += `<option value="` + categories[i].id + `">` + categories[i].name +
                        `</option>`
                }
                console.log(options);
                $("#categories").empty();
                $("#categories").append(options)



            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }



            });
            $("#save-btn").unbind('click').bind('click', function() {});

            $("#save-btn").on("click").click(function(e) {
                this.disabled = true;

                form = $('#paramsForm').serialize();

                $.ajax({
                    data: form,
                    url: SITEURL + "/transactions/add",
                    type: "POST",
                    //dataType: 'json',
                    beforeSend: function(msg) {
                        // alert("befor");
                        $("#save-btn").addClass("disabled");
                    },
                    success: function(data) {
                        swal({
                                title: "Saved",
                                text: "Your updates has been saved",
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        text: "Ok",
                                        value: true,
                                        visible: true,
                                        className: "",
                                        closeModal: false
                                    }
                                }
                            })
                            .then((isConfirm) => {
                                if (isConfirm) {
                                    window.location.replace(SITEURL + '/transactions/')
                                }
                            });

                        $("#save-btn").removeClass("disabled");




                    },
                    error: function(data) {
                        console.error('Error:', data.responseText);
                        swal({
                            title: "Error",
                            text: "Your updates was canceled",
                            timer: 2000,
                            icon: "error"
                        });
                        //$('#btn-save').html('Save Changes');
                        $("#save-btn").removeClass("disabled");

                    }
                });

            });

        });

    </script>


@endsection
