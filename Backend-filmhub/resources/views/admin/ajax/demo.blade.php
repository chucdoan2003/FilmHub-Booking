<!-- resources/views/movies/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">  <!-- CSRF Token -->
    <title>Thêm Phim</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Thêm jQuery -->
</head>
<body>

    <h2>Thêm Phim Mới</h2>

    <form id="movie-form">
        <label for="name">Datetime:</label>
        <input type="date" id="datetime" name="name" required><br><br>

      

        <button type="submit">Thêm Phim</button>
    </form>

    <div id="response-message"></div> <!-- Nơi hiển thị phản hồi -->

    <script>
        $(document).ready(function () {
            // Xử lý sự kiện submit form
            $(document).on('change', function(){
                let datetime= $('#datetime').val()
                console.log("Datetime đã chọn:", datetime); 
                $.ajax({
                    url: "{{ route('showtimes.getAPI') }}",  // Route Laravel
                    type: 'POST',
                    data: {
                        datetime: datetime
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                    },
                    success: function (response) {
                        let a =""
                        for (let index = 0; index < response.data.length; index++) {
                            a+="<p>"+ response.data[index].movie_id + "</p>"
                        }
                        $('#response-message').html('<p>' + a + '</p>');
                        $('#movie-form')[0].reset();  // Reset form sau khi thêm thành công
                    },
                    error: function (xhr) {
                        alert('Có lỗi xảy ra. Vui lòng thử lại.');
                    }
                });
            })
            
        });
    </script>

</body>
</html>
