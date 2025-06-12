<h1>🍜 Itachi Spicy Noodles - Web kinh doanh và quản lý món mì cay</h1>

<p>Chào mừng bạn đến với dự án <strong>Itachi Spicy Noodles</strong>! Đây là hệ thống giúp bạn quản lý và thưởng thức các món mì cay một cách trọn vẹn nhất. Hãy làm theo hướng dẫn dưới đây để cài đặt và chạy dự án.</p>

<h2>🚀 Bắt đầu nào!</h2>

<h3>1. Tạo Database</h3>

<p>Đầu tiên, hãy tạo một database mới trên MySQL của bạn với tên:</p>

<pre><code>itachi_spicy_noodles</code></pre>

<h3>2. Import Database</h3>

<p>Sau khi tạo xong, import file <code>itachi_spicy_noodles.sql</code> vào database <code>itachi_spicy_noodles</code> bạn vừa tạo:</p>
<ul>
    <li>Mở <strong>phpMyAdmin</strong> hoặc một công cụ quản lý database khác.</li>
    <li>Chọn database <code>itachi_spicy_noodles</code>.</li>
    <li>Vào tab <strong>Import</strong> và chọn file <code>itachi_spicy_noodles.sql</code>.</li>
    <li>Nhấn <strong>Go</strong> để import dữ liệu.</li>
</ul>

<h3>3. Cấu hình file <code>.env</code></h3>

<p>Cập nhật thông tin cấu hình trong file <code>.env</code> của dự án để kết nối đúng với database:</p>

<pre><code>DB_DATABASE=itachi_spicy_noodles
DB_USERNAME=your_db_username      # Thay bằng username MySQL của bạn
DB_PASSWORD=your_db_password      # Thay bằng password MySQL của bạn
</code></pre>

<p><strong>Lưu ý:</strong> Đảm bảo rằng bạn đã khởi động MySQL trong XAMPP hoặc dịch vụ MySQL cục bộ của bạn.</p>

<h3>4. Đăng nhập tài khoản</h3>

<h4>Tài khoản người dùng (User)</h4>
<p>Sử dụng thông tin dưới đây để đăng nhập:</p>
<ul>
    <li><strong>Username:</strong> <code>user</code></li>
    <li><strong>Password:</strong> <code>123</code></li>
</ul>

<h4>Tài khoản quản trị (Admin)</h4>
<p>Để truy cập trang quản trị, thêm <code>/admin</code> vào đường dẫn host của bạn. Ví dụ: <code>http://localhost/itachi_spicy_noodles/admin</code>.</p>
<ul>
    <li><strong>Username:</strong> <code>admin</code></li>
    <li><strong>Password:</strong> <code>admin</code></li>
</ul>

<hr>

<h3>🛠️ Các bước bổ sung (Nếu có)</h3>
<ul>
    <li>Nếu cần cài đặt các thư viện PHP, hãy chạy lệnh <code>composer install</code>.</li>
    <li>Khởi động lại server sau khi cấu hình <code>.env</code>.</li>
</ul>

<hr>

<h3>🎉 Hoàn tất</h3>

<p>Bây giờ, bạn đã sẵn sàng để thưởng thức và quản lý <strong>Itachi Spicy Noodles</strong>! Hãy tận hưởng và cảm nhận sự thú vị của món mì cay nhé! 🍲</p>

<hr>

<h3>📞 Hỗ trợ</h3>

<p>Nếu bạn gặp bất kỳ vấn đề nào trong quá trình cài đặt, đừng ngần ngại liên hệ với chúng tôi qua email hoặc tạo issue trên GitHub. Chúc bạn thành công!</p>
<h2>HOW TO INSTALL</h2>
- composer install
- Chỉnh sửa .env: cp .env.example .env
- Tạo ket: php artisan key:generate
- Run: php artisan serve