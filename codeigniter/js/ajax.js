$(document).ready(function() {
  
    $('.cancel').hide();
    $('.save').hide();

     $(document).on("click",".edit", function(){
        var id = $(this).attr("data-id");
        var url = $(this).attr("data-url") + "/" + id;
        $('.save[data-id='+id+']').show();
        $('.cancel[data-id='+id+']').show();
        $('#form').addClass('form');
        $(this).hide();
        edit_user(url);
    })

     $(document).on('click',".delete", function() {
        var id = $(this).attr("data-id");
        var url = $(this).attr("data-url") + "/" + id;
        delete_user(url);
     });

     $(document).on('click', '.save', function() {
        var id = $(this).attr("data-id");
         var url = $(this).attr('data-url') + "/" + id;
         save(url);
     });

     $(document).on('click', ".cancel", function() {
        $('#form').hide();
        $('.save').hide();
        $('.cancel').hide();
        $('.edit').show();
     });

     $(".search").on('keyup', function() {
        var url = $(this).attr("data-url");
        search_sort(url,0);
        
     });

     $('.filter').change(function(event) {
         var url = $(this).attr("data-url");
         search_sort(url,0);
     });

     $('.0:nth-child(2)').addClass('active');

     $(document).on('click', '#pagination li', function() {
        var page = $(this).attr("class");
        var url = $('#pagination').attr('data-url');
        search_sort(url,page);
     });

    $('#form').hide();


});

    function edit_user(url) {
        $('#form')[0].reset();

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="firstName"]').val(data.firstName);
                $('[name="lastName"]').val(data.lastName);
                $('[name="email"]').val(data.email);

                $('#form').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }

        });
    }

     function save(url) {
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
              $('#form').hide();
              location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });

    }

    function delete_user(url) {
        if (confirm("Are you sure delete this data?")) {
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                success: function(data) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                }
            });

        }
    }

    function search_sort(url, page) {
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: { 
                search: $(".search").val(),
                page: page,
                sort: $('.filter').val()
            },
            success: function(data) {
                var html = '';
                html += '<table border="1">';
                html += '<tr>';
                    html += '<th>ID</th>';
                    html += '<th>FirstName</th>';
                    html += '<th>LastName</th>';
                    html += '<th>Email</th>';
                    html += '<th>Edit</th>';
                    html += '<th>Delete</th>';
                html += '</tr>';

                $.each(data['data'], function(key, item) {
                    var id = item[0];
                    html += '<tr>';
                        html += '<td>';
                        html += item[0];
                        html += '</td>';

                        html += '<td>';
                        html += item[1];
                        html += '</td>';

                        html += '<td>';
                        html += item[2];
                        html += '</td>';

                        html += '<td>';
                        html += item[3];
                        html += '</td>';

                        html += '<td>';
                        html += '<button class="edit" data-id="'+id+'" data-url="http://localhost/codeigniter/index.php/user/ajax_edit/">';
                        html += 'Edit';
                        html += "</button>"
                        html += '<button class="save" style="display: none;" data-id="'+id+'" data-url="http://localhost/codeigniter/index.php/user/user_update/">';
                        html += 'Save';
                        html += "</button>";
                        html += '<button class="cancel" style="display: none;" data-id"'+id+'">';
                        html += 'Cancel';
                        html += '</button>';
                        html += '</td>';

                        html += '<td>';
                        html += '<button class="delete" data-id="'+id+'" data-url="http://localhost/codeigniter/index.php/user/user_delete/">';
                        html += 'Delete';
                        html += "</button>"
                        html += '</td>';
                        html += '</tr>';

                
                });
                html += '</table>';
                $('#table').html(html);

                //Tinh toan ajax de hien thi cac the phan trang

                var numOfPage = Math.ceil(data['result_search_filter'] / 5);
                var paging = '';
                if (numOfPage < 2) {
                    $("#pagination").html(paging);
                }
                else {
                    var number_page = 1;
                    paging += '<ul>';
                        paging += '<li class="0">First</li>';

                        for (var index = 0, number_page = 1; index < numOfPage * 5; index += 5, number_page++) {
                            paging += '<li class="'+index+'">'+number_page+'</li>';
                        }

                        var numOfPage = numOfPage * 5 - 5;

                        paging += '<li class="'+numOfPage+'">Last</li>';

                    paging += "</ul>";
                    $("#pagination").html(paging);
                }
                
            }
        });
    }
