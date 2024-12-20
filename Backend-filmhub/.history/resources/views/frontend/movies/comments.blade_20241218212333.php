<style>
    .comment-box {
        width: 80%;
        margin: 20px auto;
        text-align: center;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .star-rating {
        display: flex;
        justify-content: center;
        margin-bottom: 15px;
        gap: 5px;
    }

    .star-rating label:hover~label {
        color: grey;
        /* Giữ màu mặc định cho sao bên phải */
    }

    .star-rating {
        direction: rtl;
        /* Căn chỉnh sao từ trái qua phải */
        display: flex;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        font-size: 30px;
        color: #ddd;
        cursor: pointer;
        transition: 0.3s;
    }

    .star-rating input:checked~label {
        color: #ffc107;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #ffc107;
    }

    .comment-input {
        width: 90%;
        height: 100px;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        font-size: 16px;
        resize: none;
    }

    .comment-input:focus {
        border-color: #80bdff;
        outline: none;
    }

    .btn {
        margin-top: 15px;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .star-rating-comments {
        font-size: 20px;
        /* Kích thước sao */
        color: grey;
        direction: ltl;
        /* Màu mặc định cho sao */
    }

    .star .filled {
        color: gold;
        /* Màu vàng cho sao đã được đánh giá */
    }
</style>
<div class="comment-form mt-4 w-75 mx-auto">
    <h1 class="text-center">Bình luận</h1>
    <form class="" action="{{ route('comments.store', ['movie_id' => $movie->movie_id]) }}" method="POST">
        @csrf
        <div class="comment-box">
            <div class="d-flex mb-1">
                <img src="{{ Auth::user()->avatar ?? '' }}" alt="Avatar" style="margin-left: 50px" class="rounded-circle"
                    width="50" height="50">
                <!-- Star Rating -->
                <div class="star-rating">
                    <input type="radio" name="rating" id="star5" value="5"><label for="star5"
                        title="Amazing">★</label>
                    <input type="radio" name="rating" id="star4" value="4"><label for="star4"
                        title="Good">★</label>
                    <input type="radio" name="rating" id="star3" value="3"><label for="star3"
                        title="Okay">★</label>
                    <input type="radio" name="rating" id="star2" value="2"><label for="star2"
                        title="Poor">★</label>
                    <input type="radio" name="rating" id="star1" value="1"><label for="star1"
                        title="Terrible">★</label>
                </div>
            </div>
            @error('rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <!-- Comment Box -->
            <textarea class="comment-input" placeholder="What is your view?" name="comment" id="comment"></textarea>
            @error('comment')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <!-- Submit Button -->
            <br>
            <button type="submit" class="btn btn-success" id="submit-comment">Send</button>
        </div>
    </form>
</div>
<div class="comments-section w-75 mx-auto mb-5">
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Thông báo',
                text: "{{ session('error') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <!-- Danh sách bình luận -->
    <div id="comments-list">
        @foreach ($comments as $comment)
            <div class="card mt-2 comment-item">
                <div class="card-body d-flex">
                    <!-- Hiển thị ảnh đại diện -->
                    <img src="{{ $comment->user->avatar ?? 'default-avatar.png' }}" alt="Avatar"
                        class="rounded-circle me-3" width="50" height="50">

                    <div>
                        <!-- Tên người dùng -->
                        <h6 class="fw-bold text-primary">{{ $comment->user->name }}</h6>
                        <!-- Ngày tạo -->
                        <p class="text-muted small">{{ $comment->created_at->format('d/m/Y H:i') }}</p>

                        <!-- Hiển thị đánh giá sao -->
                        <div class="star-rating" style="direction: ltr;">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="fa {{ $i <= $comment->rating ? 'fa-star' : 'fa-star-o' }}"
                                    style="color: #f39c12;"></span>
                            @endfor

                        </div>

                        <!-- Nội dung bình luận -->
                        <p>{{ $comment->comment }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Controls phân trang -->
    <div id="pagination-controls" class="mt-3 d-flex justify-content-center align-items-center">
        <button id="prev" class="btn btn-secondary" onclick="changePage('prev')">Trang trước</button>

        <!-- Số trang hiện tại -->
        <span id="current-page" class="mx-3 mt-3">Trang 1</span>

        <button id="next" class="btn btn-secondary" onclick="changePage('next')">Trang sau</button>
    </div>
</div>

<script>
    const commentsPerPage = 5; // Số bình luận mỗi trang
    let currentPage = 1; // Trang hiện tại

    // Hàm hiển thị bình luận cho trang hiện tại
    function showComments(page) {
        const comments = document.querySelectorAll('.comment-item');
        const start = (page - 1) * commentsPerPage; // Tính vị trí bắt đầu
        const end = start + commentsPerPage; // Tính vị trí kết thúc

        // Ẩn tất cả bình luận
        comments.forEach(comment => comment.style.display = 'none');

        // Hiển thị các bình luận cho trang hiện tại
        for (let i = start; i < end && i < comments.length; i++) {
            comments[i].style.display = 'block';
        }

        // Cập nhật trang hiện tại
        document.getElementById('current-page').innerText = `Trang ${page}`;

        // Kiểm tra nếu còn trang tiếp theo
        if (end >= comments.length) {
            document.getElementById('next').disabled = true; // Vô hiệu hóa nút "Trang sau"
        } else {
            document.getElementById('next').disabled = false; // Bật nút "Trang sau"
        }

        // Kiểm tra nếu còn trang trước
        if (page === 1) {
            document.getElementById('prev').disabled = true; // Vô hiệu hóa nút "Trang trước"
        } else {
            document.getElementById('prev').disabled = false; // Bật nút "Trang trước"
        }
    }

    // Hàm xử lý chuyển trang
    function changePage(direction) {
        if (direction === 'next') {
            currentPage++;
        } else if (direction === 'prev') {
            currentPage--;
        }
        showComments(currentPage); // Hiển thị bình luận cho trang mới
    }

    // Hiển thị bình luận cho trang đầu tiên khi tải trang
    showComments(currentPage);
</script>
